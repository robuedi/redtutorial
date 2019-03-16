<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 16/03/19
 * Time: 17:51
 */

namespace App\Http\Controllers;

use View;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Validator;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Log;

class UserRegisterController extends Controller
{
    public function register(Request $request)
    {

        // validate
        $rules = array(
            'first_name'       =>'required|min:2',
            'last_name'        =>'required|min:2',
            'email'            =>'required|email|unique:users,email',
            'password'         =>'confirmed|min:6',
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
            $role          = Sentinel::findRoleBySlug('client');

            //set user
            $new_user = [
                'first_name'    =>  $request->input('first_name'),
                'last_name'     =>  $request->input('last_name'),
                'email'         =>  $request->input('email'),
                'password'      =>  $request->input('password'),
            ];

            //register and activate
            $sentinel_user = Sentinel::registerAndActivate($new_user);
            $sentinel_user->save();

            // assign user to  role
            $role->users()->attach($sentinel_user);

            UIMessage::set('success', "Account created successfully.");

            return redirect('/sign-in');
        }
    }
}