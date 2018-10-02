<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 19:20
 */

namespace App\Libraries\CoursesHierarchy;

use App\Lesson;
use Illuminate\Support\Facades\Log;
use URL;

class CoursesHierarchyClient extends CoursesHierarchy
{

    protected function setCourseData(&$key, &$course, &$children)
    {
        $data = [
            'clear_name'    => $course->name,
            'has_children'  => count($children),
            'type'          => 'course',
            'url_path'      => $course->slug,
            'parent_id'     => 0,
            'children'      => $children
        ];

        return $data;
    }

    protected function setChapterData(&$chapter, &$children)
    {

        $data = [
            'clear_name'    => $chapter->name,
            'has_children'  => count($children),
            'type'          => 'chapter',
            'url_path'      => $chapter->parent->slug.'/'.$chapter->slug,
            'parent_id'     => $chapter->parent->id,
            'children'      => $children
        ];

        return $data;
    }

    protected function setLessonData(&$lesson)
    {

        $data = [
            'clear_name'    => $lesson->name,
            'has_children'  => 0,
            'type'          => 'lesson',
            'url_path'      => $lesson->parent->parent->slug.'/'.$lesson->parent->slug.'/'.$lesson->slug,
            'parent_id'     => $lesson->parent->id,
            'children'      => [], //lessons don't have children, they are endpoints
        ];

        return $data;
    }
}