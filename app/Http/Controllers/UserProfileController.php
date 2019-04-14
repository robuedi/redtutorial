<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 11/03/19
 * Time: 00:02
 */

namespace App\Http\Controllers;

use View;
use App\User;
use Sentinel;
use Illuminate\Http\Request;
use Validator;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\Redirect;
use Log;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class UserProfileController extends Controller
{
    public function profile()
    {
        if (Sentinel::check())
        {
            $user = Sentinel::getUser();

            //get info about courses
            $courses_started_temp = User::getUserCoursesStatus($user->id);

            //show only started
            $courses_started = [];
            foreach ($courses_started_temp as $course)
            {
                if($course->completion_percentage === 0)
                {
                    continue;
                }

                $courses_started[] = $course;
            }

//            $user = Sentry::findUserByLogin($request->input('email'));
            $user = Sentinel::findByCredentials(['login'=>$user->email]);
            $code = Reminder::create($user);
            Log::info($code);

            return View::make('user.profile', array('user' =>$user, 'courses_started' => $courses_started, 'code' => $code));
        }
        else
        {
            return redirect('/user/sign-in');
        }
    }

    public function updateProfile(Request $request)
    {
        // current user logged in
        $current_user = Sentinel::getUser();

        // validate
        $rules = array(
            'first_name'       =>'required|min:2',
            'last_name'        =>'required|min:2',
            'email'            =>'required|email|unique:users,email',
        );

        $password = $request->input('password');

        $messages = [];
        if ( ! empty($password))
        {
            $rules['password']      = 'confirmed|min:6';

            //get user pass hash
            $hasher = Sentinel::getHasher();
            $old_password = $request->get('old_password');

            //check if password match
            if (!$hasher->check($old_password, $current_user->password)) {
                $rules['old_password']      = 'invalid_password';

                //set thr message
                $messages['old_password.invalid_password'] = 'The old password is invalid.';
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

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
            $user->first_name   = $request->get('first_name');
            $user->last_name    = $request->get('last_name');
            $user->email        = $request->get('email');

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