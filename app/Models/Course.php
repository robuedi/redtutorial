<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Course extends Model
{
    protected $table = 'courses';

    static function getHierarchicalList($name_key_only = true)
    {
        $courses    = self::whereNull('parent_id')->get();
        $chapters   = self::whereNotNull('parent_id')->get()->groupBy('parent_id');

        $hierarchical_list = [];
        foreach($courses as $key => $course)
        {
            $parent_level = '';
            $children = self::getChapterChildren($chapters, $course->id, $parent_level);

            $hierarchical_list[] = (object)['id' => $course->Sid, 'name' => ($key+1).'. '.$course->name, 'children'=>$children];
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
                $inherit_level = $parent_level.'.'.$child_level;
                $grandchildren = self::getChapterChildren($chapters, $child->id, $inherit_level);

                $children[] = (object)['id' => $child->id, 'name' => $parent_level.'.'.$child_level.'. '.$child->name, 'children' => $grandchildren];
            }
        }

        return $children;
    }
}


