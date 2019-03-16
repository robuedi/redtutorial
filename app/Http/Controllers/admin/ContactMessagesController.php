<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 07/10/18
 * Time: 23:26
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Libraries\Listing;
use App\ContactMessage;
use App\ContactMessageToUser;
use Sentinel;
use App\Libraries\UIMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContactMessagesController extends Controller
{

    public function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        //get user
        $user = Sentinel::getUser();

        if(!$user)
        {
            abort(401, 'Authentication required.');
        }

        //show/hide deleted
        $show_deleted = 'AND is_deleted = 0';
        if(Input::get('is_deleted'))
        {
            $show_deleted = 'AND is_deleted = 1';
        }

        //listing settings
        $query_data = array(

            'fields' => "cm.id, cm_u.id as msg_user_id, cm.name, cm.email, cm.content, cm.subject, cm_u.is_read, cm_u.is_flagged, cm.created_at, cm_u.updated_at",

            'body' => "FROM contact_messages cm
                       JOIN contact_messages_to_users cm_u
                        ON cm.id = cm_u.message_id
                        WHERE user_id = $user->id $show_deleted {filters}",

            'filters' => array(
                'name' => "AND name LIKE '%{name}%'",
                'email' => "AND email LIKE '%{email}%'",
                'subject' => "AND subject LIKE '%{subject}%'",
                'content' => "AND content LIKE '%{content}%'",
                'is_read' => "AND is_read = {is_read}"
            ),

            'sortables' => array(
                'name'          => '',
                'is_read'       => '',
                'created_at'    => 'desc',
                'updated_at'    => '',
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.contact_messages.index', array(
            'results' => $results,
            'listing' => $listing,
        ));
    }

    public function edit($id)
    {
        $message = ContactMessage::findOrFail($id);

        //update link
        $user = Sentinel::getUser();
        if(!$user)
        {
            abort(401, 'Authentication required.');
        }

        $message_to_user = ContactMessageToUser::where('message_id', $id)
                            ->where('user_id',$user->id)
                            ->first();

        if(!$message_to_user)
        {
            UIMessage::set('warning', 'Unauthorised action or message not found.');
            return redirect()->back();
        }

        $message_to_user->is_read = 1;
        $message_to_user->update();


        return View::make('_admin.contact_messages.view', ['message' => $message, 'message_to_user' => $message_to_user]);
    }

    public function update($id, Request $request)
    {
        //get message
        $user = Sentinel::getUser();
        $message_to_user = ContactMessageToUser::where('user_id', $user->id)
            ->where('message_id', $id)
            ->first();

        if(!$message_to_user)
        {
            UIMessage::set('warning', 'Message not found.');
            return redirect(config('app.admin_route').'/contact-messages');
        }

        //update message
        $message_to_user->is_read       = $request->input('is_public') ? 1 : 0;
        $message_to_user->is_deleted    = $request->input('is_deleted') ? 1 : 0;
        $message_to_user->is_flagged    = $request->input('is_flagged') ? 1 : 0;
        $message_to_user->update();


        //return user back
        if($message_to_user->is_deleted == 1)
        {
            UIMessage::set('success', 'Message deleted successfully.');
        }
        else
        {
            UIMessage::set('success', 'Message updated successfully.');
        }

        if (Input::get('save_and_continue') && $message_to_user->is_deleted == 0) //redirect to the same page
        {
            return redirect(config('app.admin_route').'/contact-messages/'.$id.'/edit');
        }
        else
            return redirect(config('app.admin_route').'/contact-messages'); //redirect to listing

    }

    public function destroy($id)
    {
        $user = Sentinel::getUser();
        $message_to_user = ContactMessageToUser::where('user_id', $user->id)
                            ->where('id', $id)
                            ->first();

        if(!$message_to_user)
        {
            UIMessage::set('warning', 'Message not found.');
            return redirect(config('app.admin_route').'/contact-messages');
        }

        $message_to_user->is_deleted = 1;
        $message_to_user->update();

        UIMessage::set('success', 'Message deleted successfully (soft delete).');
        return redirect(config('app.admin_route').'/contact-messages');

    }

}