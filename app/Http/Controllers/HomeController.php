<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/03/18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use View;
use App\Models\Testing;

class HomeController extends Controller
{
    function index(){

        $meta = [
            'description' => 'Learn HTML, CSS, JavaScript, PHP'
        ];


        $sections = Testing::getSections();

        return View::make('home', ['meta'=>$meta, 'sections' => $sections]);
    }
}