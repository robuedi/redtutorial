<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 09/10/18
 * Time: 01:13
 */

namespace App\Http\Controllers;

use App\Models\ContactMessageToUser;
use App\Rules\CustomSumVerification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\Session;
use App\Models\ContactMessage;
use Sentinel;
use Log;

class ContactController extends Controller
{
    public function index()
    {
        //verification input
        $verification_nr[0] = rand(0, 9);
        $verification_nr[1] = rand(0, 9);

        //store the key
        Session::put('contact_verification', array_sum($verification_nr));

        return View::make('contact.index', ['verification_nr' => $verification_nr]);
    }

    public function saveMessage(Request $request)
    {
        //validate response
        $rules = [
            'name'      => 'required|max:255',
            'email'     => 'required|max:255|email',
            'message'   => 'required|max:1500',
            'verification' => ['required', 'integer', 'max:255', new CustomSumVerification('Verification', Session::get('contact_verification'))]
        ];

        $validator = Validator::make(Input::all(), $rules);

        //check validation
        if($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withInput(Input::all())->withErrors($validator);
        }
        else
        {
            //save the message
            $contact_message = new ContactMessage();
            $contact_message->name = $request->name;
            $contact_message->email = $request->email;

            if(!empty($request->subject))
            {
                $contact_message->subject = $request->subject;
            }

            $contact_message->content = $request->message;
            $contact_message->save();

            //link message to admins
            $role = Sentinel::findRoleBySlug('admin');
            $users = $role->users()->with('roles')->get();

            //create the links
            foreach ($users as $user)
            {
                $message_to_user = new ContactMessageToUser();
                $message_to_user->message_id    = $contact_message->id;
                $message_to_user->user_id       = $user->id;
                $message_to_user->save();
            }

            UIMessage::set('success', 'Message sent successfully. Thank you.');
            return Redirect::back();
        }
    }

}