<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 25/02/18
 * Time: 19:30
 */

namespace App\Libraries\REC;

use Session;
use Redirect;
use Log;
use URL;


class UIMessage {

    public static function get()
    {
        // obtine mesajul din sesiune
        $message_array = Session::get('uimessage');

        // return empty daca nu are mesaj de afisat
        if(	!is_array($message_array) ||
            !isset($message_array['message']
            )) return "";

        // formeaza stringul html si returneaza-l
        $html = '<div class="alert alert-'.$message_array['type'].'"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message_array['message'].'</div>';

        return $html;
    }

    // $type poate fi
    //    info
    //    success
    //    danger
    //
    // $message poate fi string sau array
    public static function set($type = "info", $message="")
    {
        if( is_array($message) )
        {
            // daca mesajul e transmis sub forma unui array, imbraca fiecare element in <p>-uri
            $message_str = "<p>" . implode("</p><p>", $message) . "</p>";
        }
        else
        {
            $message_str = (string) $message;
        }

        // pune mesajul in sesiune
        Session::flash( 'uimessage', array(
            'type' => $type,
            'message' => $message_str
        ));
    }

    // permite afisarea la cerere a unor mesaje formatate, similare celor afisate automat din sesiune
    // lipseste butonul de close
    public static function format(  $type = "info", $message = "", $close_button = false )
    {
        if( is_array($message) )
        {
            // daca mesajul e transmis sub forma unui array, imbraca fiecare element in <p>-uri
            $message_str = "<p>" . implode("</p><p>", $message) . "</p>";
        }
        else
        {
            $message_str = (string) $message;
        }

        // include butonul de close?
        $close_button_html = $close_button ? '<button type="button" class="close" data-dismiss="alert">&times;</button>' : '';

        // formeaza stringul html si returneaza-l
        $html = '<div class="alert alert-'.$type.'">'.$close_button_html.$message_str.'</div>';

        return $html;
    }
}