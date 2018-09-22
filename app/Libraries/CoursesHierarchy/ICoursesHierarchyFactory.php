<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 12:19
 */

namespace App\Libraries\CoursesHierarchy;


use App\Libraries\CoursesHierarchy;

interface ICoursesHierarchyFactory
{
    public static function createHierarchyObject(string $type)  : ICoursesHierarchy;
}