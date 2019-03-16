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
use Sentinel;


class HomeController extends Controller
{
    function index()
    {

        $courses = Course::whereIn('status', [1,2])
                    ->select('id','name', 'slug', 'description', 'status')
                    ->get();

        $user = Sentinel::getUser();
        //add progress
        if($user)
        {
            foreach ($courses as $course)
            {
                if($course->status == 2)
                    continue;

                $course->completion_status = Course::getChapterCompletionStatus($course->id, $user->id);
            }
        }

        $meta['keywords'] = 'PHP, SQL, JavaScript, design patterns, SOLID principles';
        $meta['description'] = 'Learn programing, design patterns, SOLID principles';

        return View::make('home', [
            'meta'              => $meta,
            'courses'           => $courses,
            'hide_all_tutorials'  => true
        ]);
    }
}