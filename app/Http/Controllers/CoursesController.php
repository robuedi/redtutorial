<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 18/03/18
 * Time: 21:27
 */

namespace App\Http\Controllers;

use View;
use App\Models\Testing;

class CoursesController extends Controller
{
    public function getSection($slug){

        $sections = Testing::getSections();
        $courses = Testing::getCourses();

        $meta = [
            'description' => 'Learn HTML'
        ];

        return View::make('course.main', ['meta' => $meta, 'title' => 'Testing', 'sections' => $sections, 'courses' => $courses, 'section' => $sections[$slug]]);
    }

    public function getCourse($slug){

        $sections = Testing::getSections();
        $courses = Testing::getCourses();

        return View::make('testing', ['title' => 'Testing', 'sections' => $sections, 'courses' => $courses, 'section' => $courses[$slug]]);
    }
}