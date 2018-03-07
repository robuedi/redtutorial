<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 26/02/18
 * Time: 21:20
 */

namespace App\Http\Controllers;

use View;
use App\Models\Testing;

class TestingController extends Controller
{
    public function index()
    {
        $sections = Testing::getSections();
        $courses = Testing::getCourses();


        return View::make('testing', ['title' => 'Testing', 'sections' => $sections, 'courses'=>$courses]);
    }

    public function getSection($slug){

        $sections = Testing::getSections();
        $courses = Testing::getCourses();

        return View::make('testing', ['title' => 'Testing', 'sections' => $sections, 'courses' => $courses, 'section' => $sections[$slug]]);
    }

    public function getCourse($slug){

        $sections = Testing::getSections();
        $courses = Testing::getCourses();

        return View::make('testing', ['title' => 'Testing', 'sections' => $sections, 'courses' => $courses, 'section' => $courses[$slug]]);
    }

}