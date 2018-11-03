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

    public function setChapters($chapters){
        $this->chapters = $chapters;
    }

    public function setCourses($courses){
        $this->courses = $courses;
    }

    public function getLessons(){
        return $this->lessons;
    }

    public function getChapters(){
        return $this->chapters;
    }

    public function getCourses(){
        return $this->courses;
    }

    public function getHierarchyList() : array
    {
        $hierarchical_list = [];
        //loop courses
        foreach($this->courses as $key => $course)
        {
            $parent_level = '';
            //check course children (go into recursive function)
            $children = $this->getChapterChildren( $course, $parent_level);

            //add new course and it's children
            $hierarchical_list[] = $this->setCourseData($key, $course, $children);
        }

        return $hierarchical_list;
    }

    private function getChapterChildren(&$parent, &$parent_level)
    {
        $children = [];
        //check if parent has chapter children
        if(isset($this->chapters[$parent->id]))
        {
            //loop chapter children
            foreach ($this->chapters[$parent->id] as $key => $child)
            {
                $child_level = $key+1;
                $inherit_level = $parent_level.$child_level.'. ';
                $child->parent = $parent;

                //check if has also has children
                $grandchildren = $this->getChapterChildren($child, $inherit_level);

                $child->inherit_level = $inherit_level;

                //save chapters data and it's children
                $children[] = $this->setChapterData($child, $grandchildren);
            }
        }

        //check if parent has lesson children
        if(isset($this->lessons[$parent->id]))
        {
            //loop lesson children
            foreach ($this->lessons[$parent->id] as $key => $child)
            {
                //save lesson data
                $child->parent = $parent;
                $children[] = $this->setLessonData($child);
            }
        }

        return $children;
    }

    protected function setCourseData(&$key, &$course, &$children)
    {
        $data = [
            'index'     => $key,
            'name'      => $course->name,
            'children'  => $children
        ];

        return $data;
    }

    protected function setChapterData(&$chapter, &$children)
    {
        $data = [
            'name'      => $chapter->name,
            'children'  => $children
        ];

        return $data;
    }

    protected function setLessonData(&$lesson)
    {
        $data = [
            'name'      => $lesson,
        ];

        return $data;
    }

}