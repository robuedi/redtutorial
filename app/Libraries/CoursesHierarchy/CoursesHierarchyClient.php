<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 19:20
 */

namespace App\Libraries\CoursesHierarchy;

use App\Lesson;

class CoursesHierarchyClient extends CoursesHierarchy
{
    public function setDefaultAdminLessons(){
        $lessons = Lesson::whereNotNull('parent_id')
            ->orderBy('order_weight')
            ->get()->groupBy('parent_id');

        $this->setLessons($lessons);
    }
}