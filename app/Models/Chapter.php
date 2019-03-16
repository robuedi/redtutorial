<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use URL;
use Illuminate\Support\Collection;
use Sentinel;

class Chapter extends Model
{
    protected $table = 'chapters';

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id','id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id', 'id');
    }

    public function  publicLessons()
    {
        return $this->lessons()->where('is_public', 1);
    }

    public static function addCurrentUserCompletionStatus(int $user_id, Collection $chapters, bool $floor_rounded_percentage = true) : Collection
    {
        //check if we have chapters
        if($chapters->isNotEmpty())
        {
            //get ids
            $chapters_ids = (clone $chapters)->pluck('id');

            //get lessons
            $lessons = Lesson::whereIn('chapter_id', $chapters_ids)
                ->where('is_public', 1)
                ->select('id', 'chapter_id')
                ->get();

            //check if we have lessons
            if ($lessons) {
                //get lesson_sections
                $lessons_sections = LessonSection::whereIn('lesson_id', (clone $lessons)->pluck('id'))
                    ->where('is_public', 1)
                    ->select('id', 'lesson_id')
                    ->where('type', 'quiz')
                    ->get()
                    ->groupBy('lesson_id');
            }

            //group lessons by chapter
            $lessons = $lessons->groupBy('chapter_id');

            //get user's achived sections
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
                    $chapter_lesson_section += ($lessons_sections[$lesson->id])->pluck('id')->toArray();
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

