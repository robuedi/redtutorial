<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 11/02/18
 * Time: 18:00
 */

namespace App\Http\Controllers;

use View;
use App\Http\Controllers\Controller;
use Sentinel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Login;
use Session;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Libraries\UIMessage;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;

class UserSignInController extends Controller
{
    public function index(Request $request)
    {
        //check if sign in active
        $sign_in = $request->session()->get('sign-in');

        //check if redirect back after register/sign-in
        if($request->get('return') === 'true')
        {
            $request->session()->flash('return-back-to', url()->previous());
        }

        //check if user is logged in as client
        try {

            if (Sentinel::check())
                return Redirect::intended('/');
            else
                return View::make('user.sign_in_or_register', ['sign_in' => $sign_in]);

        } catch (NotActivatedException $e) {

            UIMessage::set('danger', 'Account not activated.');
            return View::make('user.sign_in_or_register',  ['sign_in' => true]);

        }
    }

    public function doSignIn(Request $request)
    {
        try {
            $input = Input::all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $remember = (bool)Input::get('remember', false);

            if (Sentinel::authenticate(Input::all(), $remember)) {
                /// inserez in BD si in sesiune login_id

                // if we are here, that means it's a successful login
                $new_login                = new Login;
                $new_login->user_id       = Sentinel::getUser()->id;
                $new_login->login_date    = date('Y-m-d H:i:s');
                $new_login->login_success = 1;
                $new_login->login_ip      = $request->ip();
                $new_login->browser       = $request->server('HTTP_USER_AGENT');
                $new_login->save();

                $login_history_id = $new_login->login_id;

                // store in session the current login history id
                Session::put('login_history_id', $login_history_id);

                //TODO redirect user to his previous location
                $return_to = $request->session()->get('return-back-to');
                if($return_to)
                {
                    return \redirect($return_to);
                }
                else
                {
                    return \redirect('/');
                }
//                return Redirect::intended('/');
            }

            $errors = 'Invalid login or password.';
        } catch (NotActivatedException $e) {
            $errors = 'Account is not activated!';
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();

            $errors = "Your account is blocked for {$delay} second(s).";
        }

        //display sign in section
        $request->session()->flash('sign-in', true);

        //show errors
        UIMessage::set('danger', $errors);
        return Redirect::back()->withInput($request->only('email'))->withErrors($errors);
    }

    function logout()
    {
        Sentinel::logout();

        $login_history_id = Session::get('login_history_id');

        // make sure the session contains something
        if ($login_history_id) {
            $login = Login::find($login_history_id);

            // only update the logout date if the record is found
            if ($login) {
                $login->logout_date = date('Y-m-d H:i:s');
                $login->save();
            }
        }

        //TODO redirect user to his previous location
        return Redirect::to('/');
    }
}