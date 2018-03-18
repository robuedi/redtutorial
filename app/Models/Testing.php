<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 26/02/18
 * Time: 21:31
 */

namespace App\Models;


class Testing
{
    static function getSections()
    {
        $courses = ['learn-html-tutorial' => 'HTML', 'learn-css-tutorial' => 'CSS', 'learn-js-javascript-tutorial' => 'JavaScript', 'learn-php-tutorial' => 'PHP'];

        return $courses;
    }

    static function getSectionsURL()
    {
        $courses = ['learn-html-tutorial', 'learn-css-tutorial', 'learn-js-javascript-tutorial', 'learn-php-javascript-tutorial'];

        return $courses;
    }

    static function getCourses()
    {
        $courses = ['main-header' => 'Main header', 'pages-titles' => 'Page titles', 'scripting' => 'Adding Scripting'];

        return $courses;
    }

    static function getCoursesURL()
    {
        $courses = ['main-header', 'pages-titles', 'scripting'];

        return $courses;
    }
}