<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/03/18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use View;
use App\Course;

class HomeController extends Controller
{
    function index()
    {

        $courses = Course::where('is_public', 1)
                    ->whereNull('parent_id')
                    ->select('name', 'slug')
                    ->get();

        $meta['keywords'] = 'PHP, SQL, JavaScript, design patterns, SOLID principles';
        $meta['description'] = 'Learn programing, design patterns, SOLID principles';

        return View::make('home', ['meta' => $meta, 'courses' => $courses]);
    }
}