<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use URL;

class Course extends Model
{
    protected $table = 'courses';

    static function getHierarchicalList($name_key_only = true)
    {
        $courses    = self::whereNull('parent_id')
                        ->orderBy('order_weight')
                        ->get();

        $chapters   = self::whereNotNull('parent_id')
                        ->orderBy('order_weight')
                        ->get()->groupBy('parent_id');

        $hierarchical_list = [];
        foreach($courses as $key => $course)
        {
            $parent_level = '';
            $children = self::getChapterChildren($chapters, $course->id, $parent_level);


            $hierarchical_list[] = [
                'id'            => $course->id.'',
                'name'          => ($key+1).'. '.$course->name,
                'clear_name'    => $course->name,
                'children'      => $children,
                'link'          => URL::to('/admin/courses/'.$course->id.'/edit'),
                'is_public'     => $course->is_public,
                'is_draft'      => $course->is_draft,
            ];
        }

        return $hierarchical_list;
    }

    private static function getChapterChildren(&$chapters, $id, &$parent_level)
    {
        $children = [];
        if(isset($chapters[$id]))
        {
            foreach ($chapters[$id] as $key => $child)
            {
                $child_level = $key+1;
                $inherit_level = $parent_level.$child_level.'. ';
                $grandchildren = self::getChapterChildren($chapters, $child->id, $inherit_level);

                $children[] = [
                    'id'            => $child->id,
                    'name'          => $inherit_level.$child->name,
                    'clear_name'    => $child->name,
                    'children'      => $grandchildren,
                    'is_public'     => $child->is_public,
                    'is_draft'     => $child->is_draft,
                    'link'          => URL::to('/admin/chapters/'.$child->id.'/edit')
                ];
            }
        }

        return $children;
    }
}


