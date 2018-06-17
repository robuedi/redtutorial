<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use URL;

class Course extends Model
{
    protected $table = 'courses';

    static function getHierarchicalList($pointing_id = null, $lessons_included = false)
    {
        //get courses
        $courses    = self::whereNull('parent_id')
                        ->orderBy('order_weight')
                        ->get();

        //get chapters
        $chapters   = self::whereNotNull('parent_id')
                        ->orderBy('order_weight')
                        ->get()->groupBy('parent_id');

        //get lessons
        $lessons    = [];

        //lessons also included
        if($lessons_included)
        {
            $lessons   = Lesson::whereNotNull('parent_id')
                ->orderBy('order_weight')
                ->get()->groupBy('parent_id');
        }

        $hierarchical_list = [];
        //loop courses
        foreach($courses as $key => $course)
        {
            $parent_level = '';
            //check course children (go into recursive function)
            $children = self::getChapterChildren($chapters, $lessons, $course->id, $parent_level, $pointing_id);

            //add new course and it's children
            $hierarchical_list[] = [
                'id'            => $course->id.'',
                'name'          => ($key+1).'. '.$course->name,
                'clear_name'    => $course->name,
                'children'      => $children,
                'link'          => URL::to('/admin/courses/'.$course->id.'/edit'),
                'is_public'     => $course->is_public,
                'is_draft'      => $course->is_draft,
                'pointing_id'   => $pointing_id === $course->id ? true : false,
                'type'          => 'course'
            ];
        }

        return $hierarchical_list;
    }

    private static function getChapterChildren(&$chapters, &$lessons, $id, &$parent_level, &$pointing_id)
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
                $grandchildren = self::getChapterChildren($chapters,$lessons, $child->id, $inherit_level,$pointing_id);

                //save chapters data and it's children
                $children[] = [
                    'id'            => $child->id,
                    'name'          => $inherit_level.$child->name,
                    'clear_name'    => $child->name,
                    'children'      => $grandchildren,
                    'is_public'     => $child->is_public,
                    'is_draft'      => $child->is_draft,
                    'link'          => URL::to('/admin/chapters/'.$child->id.'/edit'),
                    'pointing_id'   => $pointing_id === $child->id ? true : false,
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
                    'pointing_id'   => $pointing_id === $child->id ? true : false,
                    'type'          => 'lesson'
                ];
            }
        }

        return $children;
    }
}


