<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/03/18
 * Time: 00:03
 */

namespace App\Http\Controllers;

use App\LessonSection;
use App\Libraries\UserProgressStatus;
use App\MediaFileToItem;
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
        //add info
        foreach ($courses as $course)
        {
            //add progress
            if($course->status == 2||!$user)
                continue;

            $course->completion_status = UserProgressStatus::getCourseStatus($course->id, $user->id);
        }

        $meta['keywords'] = 'PHP, Step by step, SQL, JavaScript, design patterns, SOLID principles';
        $meta['description'] = 'Free PHP tutorial and SQL tutorial. They are step by step tutorials, clear and easy to understand, you can also track your progress through the courses.';

        return View::make('home', [
            'meta'              => $meta,
            'courses'           => $courses,
            'hide_all_tutorials'  => true
        ]);
    }
}