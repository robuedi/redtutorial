<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 13:30
 */

namespace App\Libraries\CoursesHierarchy;

use App\Chapter;
use App\Course;
use App\Libraries;
use Illuminate\Support\Facades\Log;
use App\Lesson;

class CoursesHierarchyFactory implements ICoursesHierarchyFactory
{
    public static function createHierarchyObject(string $type) : ICoursesHierarchy
    {
        //courses
        $courses = Course::orderBy('order_weight')
            ->get();

        //chapters
        $chapters = Chapter::orderBy('order_weight')
            ->get()->groupBy('course_id');

        //lessons
        $lessons = [];

        return new CoursesHierarchyAdmin($courses, $chapters, $lessons);
    }
}