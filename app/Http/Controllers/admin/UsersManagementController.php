<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 04/08/18
 * Time: 00:54
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use View;
use App\Libraries\Listing;
use App\Models\Role;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Validator;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Log;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class UsersManagementController extends Controller
{
    public function index($type)
    {
        //check permissions
        $current_user = Sentinel::getUser();
        if(!$current_user->hasAccess('user.'.$type.'.view'))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        //check role;
        $role = Role::where('slug', $type)->first();

        if(!$role)
        {
            UIMessage::set('warning', 'User type not found');
            return redirect()->back();
        }

        $user_type = $role->slug;

        // settings
        $query_data = array(

            'fields' => "u.id, u.first_name, a.completed as activation_status, u.last_name, u.email, u.created_at, u.updated_at, l.last_login_date",

            'body' => "FROM users u
                        INNER JOIN role_users ru ON u.id = ru.user_id
                        INNER JOIN roles r ON ru.role_id = r.id
                        LEFT JOIN activations a ON u.id = a.user_id
                        LEFT JOIN (
                                    SELECT user_id, MAX(login_date) as last_login_date FROM logins GROUP BY user_id
                                    ) l ON u.id = l.user_id
                        WHERE r.slug = '$user_type' {filters}",

            'filters' => array(
                'u.first_name' => "AND name LIKE '%{name}%'",
            ),

            'sortables' => array(
                'first_name'          => 'asc',
                'last_login_date' => '',
                'created_at'    => '',
                'updated_at'    => '',
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.users_management.index', array(
            'results' => $results,
            'listing' => $listing,
            'type' => $type,
        ));
    }

    public function edit(string $type, $id)
    {
        //check permission
        $current_user = Sentinel::getUser();
        if(!$current_user->hasAccess(['user.'.$type.'.edit']))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        //get user
        $user = User::findOrFail($id);

        //get role
        $sentinel_user = Sentinel::findById($user->id);

        if(!$sentinel_user)
        {
            UIMessage::set('warning', 'User not found');
            return redirect()->back();
        }

        //check permission
        if($sentinel_user->roles[0]->slug !== $type)
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        $user->role = $sentinel_user->roles[0]->slug;

        return View::make('_admin.users_management.edit_create', [
            'user'  => $user
        ]);


    }

    public function update($id, Request $request)
    {
        // get user
        $sentinel_user = Sentinel::findById($id);

        //current user permission
        $current_user = Sentinel::getUser();
        if(!($current_user->hasAccess(['user.'.$sentinel_user->roles[0]->slug.'.edit'])))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        if(!$sentinel_user)
        {
            UIMessage::set('warning', 'User not found');
            return redirect()->back();
        }

        $password = $request->input('password');

        // validate
        $rules = array(
            'first_name'       =>'required|min:2',
            'last_name'        =>'required|min:2',
            'email'            =>'required|email',
            'second_email'     =>'nullable|email',
        );


        if($sentinel_user->roles[0]->slug !== 'admin'){
            $rules['email'] ='required|email';
            $rules['second_email'] ='nullable|email';
        }

        if ( ! empty($password))
        {
            $rules['password'] = 'confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            // user in database
            $user = User::find($sentinel_user->id);

            // set new fields values
            $user->first_name   = $request->input('first_name');
            $user->last_name    = $request->input('last_name');

            //if not admin
            if($sentinel_user->roles[0]->slug !== 'admin')
            {
                $user->email        = $request->input('email');
                $user->second_email = $request->input('second_email');
                $user->phone        = $request->input('phone');

                if ( ! empty($password))
                {
                    //update password
                    $credentials = ['password' => $password];
                    Sentinel::update($sentinel_user, $credentials);
                }
            }

            // save the user in database
            $user->save();

            UIMessage::set('success', "The user was updated successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/users-management/'.$request->input('role').'/'.$sentinel_user->id.'/edit');
            }
            else
                return redirect(config('app.admin_route').'/users-management/'.$request->input('role')); //redirect to listing
        }

    }

    public function store(Request $request)
    {
        //current user permission
        $current_user = Sentinel::getUser();
        if(!($current_user->hasAccess(['user.'.$request->input('role').'.create'])))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        // validate
        $rules = array(
            'first_name'       =>'required|min:2',
            'last_name'        =>'required|min:2',
            'email'            =>'required|email|unique:users,email',
            'second_email'     =>'nullable|email',
            'password'         =>'confirmed|min:6',
            'role'             =>'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {

            // get role
            $role          = Sentinel::findRoleBySlug($request->input('role'));

            if(!$role)
            {

                UIMessage::set('danger', "The user was created successfully.");
                return redirect()->back();
            }

            //set user
            $new_user = [
                'first_name'    =>  $request->input('first_name'),
                'last_name'     =>  $request->input('last_name'),
                'email'         =>  $request->input('email'),
                'second_email'  =>  $request->input('second_email'),
                'phone'         =>  $request->input('phone'),
                'password'      =>  $request->input('password'),
            ];

            //register and activate
            $sentinel_user = Sentinel::registerAndActivate($new_user);
            $sentinel_user->save();

            // assign user to  role
            $role->users()->attach($sentinel_user);

            UIMessage::set('success', "The user was created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/users-management/'.$request->input('role').'/'.$sentinel_user->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/users-management/'.$request->input('role').'/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/users-management/'.$request->input('role')); //redirect to listing
        }
    }

    public function create(string $type)
    {
        //check permissions
        $current_user = Sentinel::getUser();
        if(!($current_user->hasAccess(['user.'.$type.'.create'])))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        //create user
        $new_user = new User();

        //check role;
        $role = Role::where('slug', $type)->first();

        if(!$role)
        {
            UIMessage::set('warning', 'User type not found');
            return redirect()->back();
        }

        $new_user->role = $role->slug;

        return View::make('_admin.users_management.edit_create', [
            'user'  => $new_user
        ]);
    }

    public function destroy($id)
    {
        //check permissions
        $current_user = Sentinel::getUser();
        $sentinel_user = Sentinel::findById($id);
        if(!($current_user->hasAccess(['user.'.$sentinel_user->roles[0]->slug.'.delete'])))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        //delete user
        $user_type = $sentinel_user->roles[0]->slug;
        $sentinel_user->delete();

        UIMessage::set('success', 'User deleted successfully.');
        return redirect(config('app.admin_route').'/users-management/'.$user_type);

    }

    public function toggleActivation($id)
    {

        //check permissions
        $current_user = Sentinel::getUser();
        $sentinel_user = Sentinel::findById($id);
        if(!($current_user->hasAccess(['user.'.$sentinel_user->roles[0]->slug.'.deactivate_user'])))
        {
            UIMessage::set('warning', 'Permission denied');
            return redirect()->back();
        }

        //toggle activation user
        $activation = Activation::exists($sentinel_user);
        if($activation||Activation::completed($sentinel_user))
        {
            //deactivate
            if($activation && $activation->completed === false)
            {
                Activation::complete($sentinel_user, $activation->code);
            }
            Activation::remove($sentinel_user);

            UIMessage::set('success', 'User deactivated successfully.');
            return redirect()->back();
        }
        else
        {
            //activate
            $activation = Activation::create($sentinel_user);
//            Activation::complete($sentinel_user,$activation->code);

            UIMessage::set('success', 'User activated successfully.');
            return redirect()->back();
        }

    }

}