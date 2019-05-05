<?php


namespace App\Libraries\UserProgressStatus;

use App\LessonSection;
use App\UserToLessonSection;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserLessonsStatus
{
    public static function getStatus(int $user_id, int $lesson_id, $floor_rounded = true)
    {
        if(!$user_id || !$lesson_id)
        {
            return null;
        }

        //get all the sections completed be user for the lesson
        $user_sections = UserToLessonSection::join('lessons_sections', 'lessons_sections.id', '=', 'users_to_lessons_sections.lesson_section_id')
            ->where('lessons_sections.is_public',1)
            ->where('lessons_sections.type','quiz')
            ->where('lessons_sections.lesson_id', $lesson_id)
            ->where('users_to_lessons_sections.user_id', $user_id)
            ->get()
            ->count();


        //get all the sections from the lesson
        $all_sections = LessonSection::where('lessons_sections.lesson_id', $lesson_id)
            ->where('lessons_sections.is_public',1)
            ->where('lessons_sections.type','quiz')
            ->get()
            ->count();

        if($all_sections == 0 || $user_sections == 0)
        {
            $completion_percentage = 0;
        }
        else
        {
            $completion_percentage = ($user_sections*100)/$all_sections;
        }

        //get percentage
        if($floor_rounded)
        {
            $completion_percentage = (int)$completion_percentage;
        }

        return $completion_percentage;

    }

    public static function addStatusToLessons($lessons)
    {
        $user = Sentinel::getUser();

        if(!$user)
        {
            foreach ($lessons as $lesson)
            {
                $lesson->completion_status = null;
            }

            return $lessons;
        }

        foreach ($lessons as $lesson)
        {
            $lesson->completion_status = self::getStatus($user->id, $lesson->id);
        }

        return $lessons;
    }

}