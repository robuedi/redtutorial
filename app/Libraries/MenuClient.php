<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 22/09/18
 * Time: 19:14
 */

namespace App\Libraries;


use App\Libraries\CoursesHierarchy\CoursesHierarchyFactory;
use Log;

class MenuClient
{
    private static $menu_items = [];
    private static $items_index = 0;
    private static $children_counter = [];
    private static $ending_needed = 0;

    public static function getMenu()
    {
        $hierarchy_object = CoursesHierarchyFactory::createHierarchyObject('client');
        $hierarchy_list = $hierarchy_object->getHierarchyList();

        //process array to make it in one dimension
        array_walk_recursive($hierarchy_list, array(__CLASS__, "addItem"));

        return self::$menu_items;
    }

    public static function addItem($value, $key)
    {
//        if(in_array($key, ['clear_name', 'has_children', 'type', 'parent_id']))
//        {
            self::$menu_items[self::$items_index][$key] = $value;

            if($key === 'parent_id')
            {
                self::$items_index++;
            }
//        }

    }

    public static function setChildrenCounter($children_number)
    {
        //add new counter
        if($children_number > 0)
            self::$children_counter[] = $children_number;
    }

    public static function countChildren()
    {
        $array_size = count(self::$children_counter);
        self::$ending_needed = 0;
        if($array_size)
        {
            //check if we are at the last element
            if(self::$children_counter[$array_size-1] === 1){
                //remove queue counter
                array_pop(self::$children_counter);

                self::$ending_needed = 1;

                //proccess any other previous counters
                $array_size = count(self::$children_counter);
                for($i = 0; $i < $array_size; $i++) {
                    if(self::$children_counter[$i] == 1)
                    {
                        self::$ending_needed++;
                        self::$children_counter[$i]--;
                    }
                }

                self::$children_counter = array_filter(self::$children_counter);

            }

            //continue to decrease counter
            $arr_new_size = count(self::$children_counter);
            if($arr_new_size)
                self::$children_counter[$arr_new_size-1]--;
        }
    }

    public static function getEndingsNeeded()
    {
        return self::$ending_needed;
    }



}