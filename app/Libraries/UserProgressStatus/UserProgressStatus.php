<?php


namespace App\Libraries;

use App\Libraries\UserProgressStatus\UserChaptersStatus;
use App\Libraries\UserProgressStatus\UserCoursesStatus;
use App\Libraries\UserProgressStatus\UserLessonsStatus;

class UserProgressStatus
{
    public static function getLessonStatus($user_id, $lesson_id, $floor_rounded = true)
    {
        return UserLessonsStatus::getStatus($user_id, $lesson_id, $floor_rounded);
    }

    public static function addStatusToLessons($lessons)
    {
        return UserLessonsStatus::addStatusToLessons($lessons);
    }

    public static function getCourseStatus($course_id, $user_id, $floor_rounded = true)
    {
        return UserCoursesStatus::getStatus($course_id, $user_id, $floor_rounded);
    }

    public static function getCurrentUserCoursesStatus()
    {
        return UserCoursesStatus::getCurrentUserCoursesStatus();
    }

    public static function addCurrentUserChaptersStatus($user_id, $chapters, $floor_rounded_percentage = true)
    {
        return UserChaptersStatus::addCurrentUserStatus($user_id, $chapters, $floor_rounded_percentage);

    }
}