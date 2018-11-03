<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 19:14
 */

namespace App\Libraries;

use App\Course;
use App\Lesson;
use Log;

class MenuClient
{

    private static $menu = null;
    private static $is_active_course = false;


    public static function getMenu(?int $top_course = null) : array
    {
        //avoid multiple callings of the queries
        if(self::$menu === null)
        {
            self::$menu = self::getMenuData($top_course);
        }

        return self::$menu;
    }

    private static function getMenuData(?int $top_course) : array
    {
        $menu = [];

        //get data
        $courses_chapters = Course::select('id', 'parent_id', 'name', 'slug')
                            ->whereNotNull('name')
                            ->whereNotNull('slug')
                            ->where('is_public', 1)
                            ->when($top_course, function ($query, $top_course) {
                                return $query->orderByRaw('id = '.$top_course.' DESC, order_weight ASC');
                            }, function ($query) {
                                return $query->orderBy('order_weight');
                            })
                            ->get();

        //avoid double query to DB - get courses/chapters by collection filter
        $courses = clone $courses_chapters;
        $courses = $courses->where('parent_id', '=', '');

        //get ids
        $courses_ids = $courses->pluck('id');

        //check if there where courses
        if(!$courses_ids)
        {
            return $menu;
        }

        //get courses
        $courses = $courses->all();

        //get chapters
        $chapters = $courses_chapters->whereIn('parent_id', $courses_ids);

        //get lessons
        if($chapters)
        {
            $chapters_ids = $chapters->pluck('id');

            //get lessons
            $lessons = Lesson::select('id', 'parent_id', 'name', 'slug')
                ->whereNotNull('name')
                ->whereNotNull('slug')
                ->whereIn('parent_id', $chapters_ids)
                ->where('is_public', 1)
                ->orderBy('order_weight')
                ->get();

            //link lessons to chapters
            if($lessons)
            {
                $lessons = $lessons->groupBy('parent_id')->all();
                foreach ($chapters as $chapter)
                {
                    if(isset($lessons[$chapter->id]))
                    {
                        $chapter->lessons = $lessons[$chapter->id];
                    }
                }
            }

            //group chapters
            $chapters = $chapters ?  $chapters->groupBy('parent_id')->all() : [];

            //make the menu
            foreach ($courses as $course)
            {

                if(isset($chapters[$course->id]))
                {
                    $course->chapters = $chapters[$course->id];
                }

                $menu[] = $course;
            }

            return $menu;

        }
        else
        {
            return $courses;
        }
    }

    //set that the current looping course is active -> in sidebar
    public static function setActiveCourse()
    {
        self::$is_active_course = true;
    }

    //check if the looping course is active -> in sidebar
    public static function checkActiveCourse()
    {
        if(self::$is_active_course)
        {
            self::$is_active_course = false;
            return true;
        }
        else
            return false;
    }
}