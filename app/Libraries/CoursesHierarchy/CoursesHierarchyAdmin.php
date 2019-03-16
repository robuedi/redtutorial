<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 14:13
 */

namespace App\Libraries\CoursesHierarchy;

use App\Lesson;
use URL;

class CoursesHierarchyAdmin extends CoursesHierarchy implements ICoursesHierarchy
{
    public function setDefaultAdminLessons(){
        $lessons = Lesson::whereNotNull('chapter_id')
            ->orderBy('order_weight')
            ->get()->groupBy('chapter_id');

        $this->setLessons($lessons);
    }

    protected function setCourseData(&$key, &$course, &$children)
    {
        $data = [
            'id'            => $course->id.'',
            'name'          => ($key+1).'. '.$course->name,
            'clear_name'    => $course->name,
            'type'          => 'course',
            'parent_id'     => 0,
            'link'          => URL::to(config('app.admin_route').'/courses/'.$course->id.'/edit'),
            'is_public'     => $course->status,
            'is_draft'      => $course->is_draft,
            'pointing_id'   => (string)$this->pointing_id === (string)$course->id.'course' ? 1 : 0,
            'children'      => $children
        ];

        return $data;
    }

    protected function setChapterData(&$chapter, &$children)
    {
        $data = [
            'id'            => $chapter->id,
            'name'          => $chapter->inherit_level.$chapter->name,
            'clear_name'    => $chapter->name,
            'type'          => 'chapter',
            'parent_id'     => $chapter->course_id,
            'is_public'     => $chapter->is_public,
            'is_draft'      => $chapter->is_draft,
            'link'          => URL::to(config('app.admin_route').'/chapters/'.$chapter->id.'/edit'),
            'pointing_id'   => (string)$this->pointing_id === (string)$chapter->id.'chapter' ? 1 : 0,
            'children'      => $children,
        ];

        return $data;
    }

    protected function setLessonData(&$lesson)
    {
        $data = [
            'id'            => $lesson->id,
            'name'          => $lesson->name,
            'clear_name'    => $lesson->name,
            'type'          => 'lesson',
            'parent_id'     => $lesson->chapter_id,
            'is_public'     => $lesson->is_public,
            'is_draft'      => $lesson->is_draft,
            'link'          => URL::to(config('app.admin_route').'/lessons/'.$lesson->id.'/edit'),
            'pointing_id'   => (string)$this->pointing_id === (string)$lesson->id.'lesson' ? 1 : 0,
            'children'      => [], //lessons don't have children, they are endpoints
        ];

        return $data;
    }
}