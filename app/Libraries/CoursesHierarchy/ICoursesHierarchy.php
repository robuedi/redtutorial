<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 14:37
 */

namespace App\Libraries\CoursesHierarchy;


interface ICoursesHierarchy
{
    public function getHierarchyList() : array;
}