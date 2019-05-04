<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 16/03/19
 * Time: 17:51
 */

namespace App\Http\Controllers;

use App\Rules\Captcha;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;
use View;
use Sentinel;
use Illuminate\Http\Request;
use Validator;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\Redirect;
use Log;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

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
            'g-recaptcha-response'=>new Captcha()
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
            $user = Sentinel::register($new_user);
            $user->save();

            // assign user to  role
            $role->users()->attach($user);

            //create reset code
            $activation = Activation::create($user);

            //make activation url
            $activation_url = $request->root().'/user/activate-account/'.$user->id.'/'.$activation->code;

            //send email reset code
            Mail::send('emails.activate_account', ['activation_url' => $activation_url, 'user' => $user], function ($m) use ($user) {
                $m->from('no-reply@redtutorial.com', config('app.name'));

                $m->to($user->email, $user->first_name.''.$user->last_name)->subject('Activate Account');
            });

            //show feedback
            return view('user.msg', [
                'title' => 'Email Confirmation',
                'msg'   => ' We just <strong>sent an email</strong> to confirm your email address, you can check your <strong>Inbox.</strong> <br/><br/>Please take notice that sometimes it may take <strong>couple of minutes for the email to arrive</strong>.'
            ]);
        }
    }

    public function activateAccount(Request $request)
    {
        // validate
        $rules = [];

        $messages = [];
        $fail_message = 'There have been problems in activating your account. Try again later and if it still doesn\'t work contact us at <a class="link" href="mailto:contact@redtutorial.com">contact@redtutorial.com</a>.';

        //check if we got the codes
        if (empty($request->user_id) || empty($request->activation_code))
        {
            $rules['valid_request']      = 'request_invalid';

            //set thr message
            $messages['valid_request.request_invalid'] = $fail_message;
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            //get the user
            $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findById($request->user_id);

            //user not found
            if(!$user)
            {
                //show feedback
                return view('user.msg', [
                    'title' => 'Email Confirmation Failed',
                    'msg'   =>  $fail_message
                ]);
            }


            //activate user
            if (Activation::complete($user, $request->activation_code))
            {
                //display sign in section
                $request->session()->flash('sign-in', true);

                UIMessage::set('success', "Your account has been activated.");
                return Redirect::to('/user/sign-in');
            }
            else
            {
                //show feedback
                return view('user.msg', [
                    'title' => 'Email Confirmation Failed',
                    'msg'   =>  $fail_message
                ]);
            }
        }
    }
}

