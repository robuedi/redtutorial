<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/08/19
 * Time: 23:01
 */

namespace App\Libraries;


class StatusChecker
{
    private static $active_assigned = false;

    public static function checkStatus($percentage)
    {
        if(self::$active_assigned)
        {
            return 'inactive';
        }

        if((int)$percentage !== 100)
        {
            self::$active_assigned = true;

            return 'active';
        }
        else
        {
            return 'inactive';
        }
    }
}