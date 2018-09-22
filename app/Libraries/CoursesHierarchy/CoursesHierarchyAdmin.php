<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 14:13
 */

namespace App\Libraries\CoursesHierarchy;

use App\Lesson;

class CoursesHierarchyAdmin extends CoursesHierarchy implements ICoursesHierarchy
{
    public function setDefaultAdminLessons(){
        $lessons = Lesson::whereNotNull('parent_id')
            ->orderBy('order_weight')
            ->get()->groupBy('parent_id');

        $this->setLessons($lessons);
    }
}