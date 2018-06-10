<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    static function getHierarchicalList($name_key_only = true){
        $courses    = self::whereNull('parent_id');
        $chapters   = self::whereNotNull('parent_id')->keyBy('parent_id');

        $hierarchical_list = [];
        foreach($courses as $course)
        {
            $hierarchical_list[$course->id] = ['title' => $course->title, 'children'=>[]];

        }
    }
}


