<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 13:30
 */

namespace App\Libraries\CoursesHierarchy;

use App\Course;
use App\Libraries;
use Illuminate\Support\Facades\Log;
use App\Lesson;

class CoursesHierarchyFactory implements ICoursesHierarchyFactory
{
    public static function createHierarchyObject(string $type) : ICoursesHierarchy
    {
        if ($type == 'admin')
        {
            //courses
            $courses = Course::whereNull('parent_id')
                ->orderBy('order_weight')
                ->get();

            //chapters
            $chapters = Course::whereNotNull('parent_id')
                ->orderBy('order_weight')
                ->get()->groupBy('parent_id');

            //lessons
            $lessons = [];

            return new CoursesHierarchyAdmin($courses, $chapters, $lessons);
        }
        elseif ($type == 'client')
        {
            //courses
            $courses = Course::whereNull('parent_id')
                ->where('is_public',1)
                ->where('is_draft',0)
                ->orderBy('order_weight')
                ->get();

            //chapters
            $chapters = Course::whereNotNull('parent_id')
                ->where('is_public',1)
                ->where('is_draft',0)
                ->orderBy('order_weight')
                ->get()->groupBy('parent_id');

            //lessons
            $lessons = Lesson::whereNotNull('parent_id')
                ->orderBy('order_weight')
                ->where('is_public',1)
                ->where('is_draft',0)
                ->get()->groupBy('parent_id');

            $courses_hierarchy = new CoursesHierarchyClient($courses, $chapters, $lessons);

            return $courses_hierarchy;
        }
        else
        {
            return new CoursesHierarchy([],[],[]);
        }
    }
}