<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 20/11/18
 * Time: 20:32
 */

namespace App\Libraries;


class MediaFilesToItemLib
{
    private $item_type;
    private $item_id;
    private $item_types = ['course', 'dashboard'];

    public function __construct($item_type, $item_id)
    {
        //check item type permitted
        if(!in_array($item_type, $this->item_types))
        {
            return false;
        }

        $this->item_type    = $item_type;
        $this->item_id      = $item_id;

    }

    public function save($file_id)
    {
        

    }


}