<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/03/18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use App\LessonSection;
use View;
use App\Course;
use Log;
use App\User;


class HomeController extends Controller
{
    function index()
    {

        $courses = Course::whereIn('status', [1,2])
                    ->select('name', 'slug', 'description', 'status')
                    ->get();

        $meta['keywords'] = 'PHP, SQL, JavaScript, design patterns, SOLID principles';
        $meta['description'] = 'Learn programing, design patterns, SOLID principles';

        return View::make('home', [
            'meta'              => $meta,
            'courses'           => $courses,
            'hide_all_tutorials'  => true
        ]);
    }
}