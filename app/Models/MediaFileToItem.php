<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 20/11/18
 * Time: 20:15
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaFileToItem extends Model
{
    protected $table      = 'media_files_to_items';

    public static function getCourseImage($course_id)
    {
        if(empty($course_id))
        {
            return null;


        }

        return self::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $course_id)
            ->where('item_type', 'course')
            ->first();
    }


    public static function getCourseImageURL($course_id)
    {
        $image = self::getCourseImage($course_id);

        if(!$image)
        {
            return null;
        }

        return $image->url;
    }
}
