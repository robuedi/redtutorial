<?php


namespace App\Http\Controllers;

use App\Libraries\UIMessage;
use Illuminate\Http\Request;
use Validator;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserResetPasswordController extends Controller
{
    public function index()
    {
        return view('user.reset_password.index');
    }

    public function sendResetEmail(Request $request)
    {
        // validate
        $rules = array(
            'email'            =>'required|email',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            //get the user
            $user = Sentinel::findByCredentials(['login' => $request->email]);

            //check if we have a user with that email
            if($user)
            {
                //create reset code
                $reset_reminder = Reminder::create($user);

                //make reset url
                $reset_url = $request->root().'/user/reset-password/'.$user->id.'/'.$reset_reminder->code;

                //send email reset code
                Mail::send('emails.reset_password', ['reset_url' => $reset_url, 'user' => $user], function ($m) use ($user) {
                    $m->from('no-reply@redtutorial.com', config('app.name'));

                    $m->to($user->email, $user->first_name.''.$user->last_name)->subject('Password Reset');
                });
            }

            return view('user.msg', [
                'title' => 'Reset Password',
                'msg'   => ' We just <strong>sent an email</strong> to your account, if we found it. <br/><br/>Please take notice that sometimes it may take <strong>couple of minutes for the email to arrive</strong>.'
            ]);
        }

    }

    public function getResetPassword(Request $request)
    {
        //show reset form
        return view('user.reset_password.reset', [
            'user_id'       => $request->user_id,
            'reset_code'    => $request->reset_code
        ]);
    }

    public function resetPassword(Request $request)
    {
        // validate
        $rules = array(
            'password'       =>'confirmed|min:6',
        );

        $messages = [];
        $fail_message = 'There have been problems in your request. Try again later and if it still doesn\'t work contact us at <a class="link" href="mailto:contact@redtutorial.com">contact@redtutorial.com</a>.';

        //check if we got the codes
        if (empty($request->code_one) || empty($request->code_two))
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
            $user = Sentinel::findById($request->code_one);

            //user not found
            if(!$user)
            {
                UIMessage::set('danger', $fail_message);
                return Redirect::back();
            }

            //check and update code
            if ($reminder = Reminder::complete($user, $request->code_two, $request->password))
            {
                UIMessage::set('success', "Your profile was updated successfully.");
                return Redirect::to('/user/sign-in');
            }
            else
            {
                //fail
                UIMessage::set('danger', $fail_message);
                return Redirect::back();
            }

            //clean all expired reminder codes
            Reminder::removeExpired();
        }
    }

}