<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/03/18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use View;

class HomeController extends Controller
{
    function index(){

        $meta = [
            'description' => 'Learn HTML'
        ];

        return View::make('home', ['meta'=>$meta]);
    }
}