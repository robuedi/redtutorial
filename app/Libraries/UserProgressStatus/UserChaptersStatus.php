<?php


namespace App\Libraries\UserProgressStatus;


use App\Lesson;
use App\LessonSection;
use App\UserToLessonSection;
use Illuminate\Support\Collection;

class UserChaptersStatus
{
    public static function addCurrentUserStatus(int $user_id, Collection $chapters, bool $floor_rounded_percentage = true) : Collection
    {
        //check if we have chapters
        if($chapters->isNotEmpty())
        {
            //get ids
            $chapters_ids = (clone $chapters)->pluck('id');

            //get lessons
            $lessons = Lesson::getPublicLessonByChaptersIDs($chapters_ids);

            //check if we have lessons
            $lessons_sections = [];
            if ($lessons) {
                //get lesson_sections
                $lessons_sections = LessonSection::getPublicLessonsSectionsByLessonsIDs((clone $lessons)->pluck('id'));
            }

            //group lessons by chapter
            $lessons = $lessons->groupBy('chapter_id');

            //get user's completed sections
            $sections_to_user = UserToLessonSection::where('user_id', $user_id)
                ->select('lesson_section_id')
                ->get()
                ->pluck('lesson_section_id')
                ->toArray();

            //if not sections just add a default value
            if(!$sections_to_user)
            {
                $chapters = $chapters->map(function ($item) {
                    $item->completion_percentage = 0;
                    return $item;
                });

                return $chapters;
            }

            //get percentage of completion per chapter
            $chapters = $chapters->map(function ($item) use (&$lessons, &$lessons_sections, &$sections_to_user, &$floor_rounded_percentage) {

                //get lessons
                if (!isset($lessons[$item->id]))
                    return $item;

                //get lessons from chapter, loop them
                $chapter_lesson_section = [];
                foreach ($lessons[$item->id] as $lesson) {
                    //check if we have lesson sections
                    if (!isset($lessons_sections[$lesson->id]))
                        continue;

                    //add sections to chapters list
                    $sections_ids = ($lessons_sections[$lesson->id])->pluck('id')->toArray();
                    $chapter_lesson_section = array_unique(array_merge($sections_ids, $chapter_lesson_section));
                }

                //uncompleted sections by user
                $uncompleted_sections = array_intersect($chapter_lesson_section, $sections_to_user);
                if(!$uncompleted_sections)
                {
                    //completed chapter
                    $item->completion_percentage = 0;
                }
                else
                {
                    //percentage of completion
                    $item->completion_percentage = (int)((count($uncompleted_sections)*100)/count($chapter_lesson_section));
                }

                //check if rounded value
                if($floor_rounded_percentage)
                {
                    $item->completion_percentage = (int)$item->completion_percentage;
                }

                return $item;
            });

        }

        return $chapters;
    }
}