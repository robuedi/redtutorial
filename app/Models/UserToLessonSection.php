<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 13/03/19
 * Time: 01:12
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Log;

class UserToLessonSection extends Model
{
    protected $table = 'users_to_lessons_sections';

    public static function getUserLastCompletedSectionIDForLesson($lesson_section_ids)
    {
        $user = Sentinel::getUser();

        if(!$user||!$lesson_section_ids)
        {
            return null;
        }

        $last_section = self::join('lessons_sections', 'users_to_lessons_sections.lesson_section_id', '=', 'lessons_sections.id')
            ->whereIn('lessons_sections.id', $lesson_section_ids)
            ->where('users_to_lessons_sections.user_id', $user->id)
            ->orderBy('lessons_sections.order_weight', 'desc')
            ->select('lessons_sections.id as last_section_id')
            ->first();

        if($last_section)
        {
            return $last_section->last_section_id;
        }
        else
        {
            return null;
        }
    }

    public static function checkSectionsStatus($sections_ids, $sections)
    {
        //get last completed
        $last_completed_section = self::getUserLastCompletedSectionIDForLesson($sections_ids);

        //check if we have a completed one
        if($last_completed_section)
        {
            $completed_checked = false;
            $make_active = false;
            foreach ($sections as $section)
            {
                //check if completed
                if($last_completed_section == $section->id)
                {
                    //make the next text section active because we passed already this quiz
                    $section->completion_status = 2;
                    $completed_checked = true;
                    $make_active = true;
                }
                else if($make_active)
                {
                    $section->completion_status = 1;
                    $make_active = false;
                }
                //check if before the one completed
                else if(!$completed_checked)
                {
                    $section->completion_status = 2;
                }
                else
                {
                    $section->completion_status = 0;

                }


            }

            //if all completed make the first active
            $last_section = $sections->last();
            if($last_section->completion_status == 2)
            {
                $first_section = $sections->first();
                $first_section->completion_status = 1;
            }
        }
        else
        {
            $index = 0;
            foreach ($sections as $section)
            {
                $section->completion_status = ($index == 0) ? 1 : 0;

                $index++;
            }
        }

        return $sections;

    }
}