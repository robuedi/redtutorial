<?php

namespace App\Libraries\CoursesHierarchy;

use App\Course;
use App\Lesson;
use URL;


class CoursesHierarchy extends Course implements ICoursesHierarchy
{
    private $courses;
    private $chapters;
    private $lessons;

    //will be highlighted
    private $pointing_id = null;

    public function __construct($courses, $chapters, $lessons)
    {
        $this->courses  = $courses;
        $this->chapters = $chapters;
        $this->lessons  = $lessons;
    }

    public function setPointingID(string $pointing_id){
        $this->pointing_id = $pointing_id;
    }

    public function setLessons($lessons){
        $this->lessons = $lessons;
    }

    public function getHierarchyList() : array
    {
        //get courses
        $courses    = $this->courses;

        //get chapters
        $chapters   = $this->chapters;

        //get lessons
        $lessons    = $this->lessons;

        $pointing_id = $this->pointing_id;

        $hierarchical_list = [];
        //loop courses
        foreach($courses as $key => $course)
        {
            $parent_level = '';
            //check course children (go into recursive function)
            $children = $this->getChapterChildren($chapters, $lessons, $course->id, $parent_level, $pointing_id);

            //add new course and it's children
            $hierarchical_list[] = [
                'id'            => $course->id.'',
                'name'          => ($key+1).'. '.$course->name,
                'clear_name'    => $course->name,
                'children'      => $children,
                'link'          => URL::to('/admin/courses/'.$course->id.'/edit'),
                'is_public'     => $course->is_public,
                'is_draft'      => $course->is_draft,
                'pointing_id'   => (string)$pointing_id === (string)$course->id.'course' ? 1 : 0,
                'type'          => 'course'
            ];
        }

        return $hierarchical_list;
    }

    private function getChapterChildren(&$chapters, &$lessons, $id, &$parent_level, &$pointing_id)
    {
        $children = [];
        //check if parent has chapter children
        if(isset($chapters[$id]))
        {
            //loop chapter children
            foreach ($chapters[$id] as $key => $child)
            {
                $child_level = $key+1;
                $inherit_level = $parent_level.$child_level.'. ';
                //check if has also has children
                $grandchildren = $this->getChapterChildren($chapters,$lessons, $child->id, $inherit_level,$pointing_id);

                //save chapters data and it's children
                $children[] = [
                    'id'            => $child->id,
                    'name'          => $inherit_level.$child->name,
                    'clear_name'    => $child->name,
                    'children'      => $grandchildren,
                    'is_public'     => $child->is_public,
                    'is_draft'      => $child->is_draft,
                    'link'          => URL::to('/admin/chapters/'.$child->id.'/edit'),
                    'pointing_id'   => (string)$pointing_id === (string)$child->id.'chapter' ? 1 : 0,
                    'type'          => 'chapter'
                ];
            }
        }

        //check if parent has lesson children
        if(isset($lessons[$id]))
        {
            //loop lesson children
            foreach ($lessons[$id] as $key => $child)
            {
                //save lesson data
                $children[] = [
                    'id'            => $child->id,
                    'name'          => $child->name,
                    'clear_name'    => $child->name,
                    'children'      => [], //lessons don't have children, they are endpoints
                    'is_public'     => $child->is_public,
                    'is_draft'      => $child->is_draft,
                    'link'          => URL::to('/admin/lessons/'.$child->id.'/edit'),
                    'pointing_id'   => (string)$pointing_id === (string)$child->id.'lesson' ? 1 : 0,
                    'type'          => 'lesson'
                ];
            }
        }

        return $children;
    }

}