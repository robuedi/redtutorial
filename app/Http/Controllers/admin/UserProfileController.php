<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use View;
use Log;
use Login;
use Illuminate\Http\Request;
use Sentinel;
use Session;
use Validator;
use Redirect;
use App\Libraries\UIMessage;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use App\User;
use Illuminate\Support\Facades\Input;

class UserProfileController extends Controller {

    public function edit()
    {
        $user = Sentinel::getUser();

        return View::make('_admin.user_profile.edit', array('user' =>$user));
    }

    public function update(Request $request)
    {
        // current user logged in
        $current_user = Sentinel::getUser();

        $password = $request->input('password');

        // validate
        $rules = array(
            'first_name'       =>'required|min:2',
            'last_name'        =>'required|min:2',
            'email'            =>'required|email',
            'second_email'     =>'nullable|email',
        );

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
            $user = User::find($current_user->id);

            // set new fields values
            $user->first_name   = $request->input('first_name');
            $user->last_name    = $request->input('last_name');
            $user->email        = $request->input('email');
            $user->second_email = $request->input('second_email');
            $user->phone        = $request->input('phone');


            // save the user in database
            $user->save();

            if ( ! empty($password))
            {
                //update password
                $credentials = ['password' => $password];
                Sentinel::update($current_user, $credentials);
            }
            UIMessage::set('success', "Your profile was updated successfully.");
            return Redirect::back();
        }
    }
}
