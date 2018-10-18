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

class UsersManagementController extends Controller
{
    public function index($type)
    {
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

            'fields' => "u.id, u.first_name, u.last_name, u.email, u.created_at, u.updated_at, l.last_login_date",

            'body' => "FROM users u
                        INNER JOIN role_users ru ON u.id = ru.user_id
                        INNER JOIN roles r ON ru.role_id = r.id
                        LEFT JOIN (
                                    SELECT user_id, MAX(login_date) as last_login_date FROM logins GROUP BY user_id
                                    ) l ON u.id = l.user_id
                        WHERE r.slug = '$user_type' {filters}",

            'filters' => array(
                'u.first_name' => "AND name LIKE '%{name}%'",
            ),

            'sortables' => array(
                'name'          => 'asc',
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

    public function edit($id)
    {
        //get user
        $user = User::findOrFail($id);

        //get role
        $sentinel_user = Sentinel::findById($user->id);

        if(!$sentinel_user)
        {
            UIMessage::set('warning', 'User not found');
            return redirect()->back();
        }

        $user->role = $sentinel_user->roles[0]->slug;

        return View::make('_admin.users_management.edit_create', [
            'user'  => $user
        ]);


    }

    public function update()
    {

    }

    public function create($type)
    {
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

    public function delete()
    {

    }

}