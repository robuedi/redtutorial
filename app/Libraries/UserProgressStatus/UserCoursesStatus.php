<?php


namespace App\Libraries\UserProgressStatus;


use App\Course;
use App\LessonSection;
use App\UserToLessonSection;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserCoursesStatus
{
    public static function getStatus(int $course_id, int $user_id, bool $floor_rounded = true)
    {
        if(!$course_id || !$user_id)
        {
            return null;
        }

        //get all the sections completed be user for the course
        $user_sections = UserToLessonSection::join('lessons_sections', 'lessons_sections.id', '=', 'users_to_lessons_sections.lesson_section_id')
            ->join('lessons', 'lessons.id', '=', 'lessons_sections.lesson_id')
            ->join('chapters', 'chapters.id', '=', 'lessons.chapter_id')
            ->join('courses', 'courses.id', '=', 'chapters.course_id')
            ->where('lessons_sections.is_public',1)
            ->where('lessons_sections.type','quiz')
            ->where('lessons.is_public',1)
            ->where('chapters.is_public',1)
            ->where('courses.status',1)
            ->where('courses.id', $course_id)
            ->where('users_to_lessons_sections.user_id', $user_id)
            ->get()
            ->count();


        //get all the sections from course
        $all_sections = LessonSection::join('lessons', 'lessons.id', '=', 'lessons_sections.lesson_id')
            ->join('chapters', 'chapters.id', '=', 'lessons.chapter_id')
            ->join('courses', 'courses.id', '=', 'chapters.course_id')
            ->where('lessons_sections.is_public',1)
            ->where('lessons_sections.type','quiz')
            ->where('lessons.is_public',1)
            ->where('chapters.is_public',1)
            ->where('courses.status',1)
            ->where('courses.id', $course_id)
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

    public static function getCurrentUserCoursesStatus()
    {

        $user = Sentinel::getUser();

        if(!$user)
        {
            return collect([]);
        }

        $courses = Course::where('status', 1)
            ->get();

        foreach ($courses as $course)
        {
            $course->completion_percentage = self::getStatus($course->id, $user->id);
        }

        return $courses ?? collect([]);
    }
}