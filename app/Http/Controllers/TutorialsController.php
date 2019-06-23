<?php

namespace App\Http\Controllers;


use App\Chapter;
use App\LessonSection;
use App\LessonSectionOption;
use App\Libraries\UserProgressStatus;
use App\UserToLessonSection;
use View;
use App\Course;
use App\Lesson;
use DB;
use Illuminate\Support\Facades\Log;
use App\MediaFileToItem;
use Sentinel;

class TutorialsController extends Controller
{
    public function showChapters(string $course_slug)
    {
        //get the course
        $course = Course::where('slug', $course_slug)
                    ->where('status', 1)
                    ->firstOrFail();

        //get chapters
        $chapters = Chapter::getChaptersByCourseID($course->id);

        $user = Sentinel::getUser();

        if($user)
        {
            $chapters = UserProgressStatus::addCurrentUserChaptersStatus($user->id, $chapters, false);
        }

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $course->id)
            ->where('item_type', 'course')
            ->first();

        //set meta
        $meta['keywords'] = 'course, learn, '.$course->name;
        $meta['description'] = 'Learn '.$course->name.'. ';

        //put in meta description the description or the chapters
        if(!empty($course->description))
        {
            $meta['description'] .= $course->description;
        }
        else
        {
            //add chapters
            $meta['description'] .= 'Topics of the course are: ';

            $chapters_titles = [];
            foreach ($chapters as $chapter) 
            {
                $chapters_titles[] = $chapter->name;
            } 

            $meta['description'] .= implode(', ', $chapters_titles).'.';
        }

        $meta['description'] = strip_tags($meta['description']);
        

        return View::make('tutorials.chapters', [
            'course'        => $course,
            'meta'          => $meta,
            'course_id'     => $course->id,
            'chapters'      => $chapters,
            'course_image'  => $course_image,
            'user'          => $user
        ]);
    }

    public function showLessons(string $course_slug, string $chapter_slug)
    {

        //get the chapter
        $lesson_info = DB::table('courses as co')
                    ->join('chapters as ch', 'co.id', '=', 'ch.course_id')
                    ->where('co.slug', $course_slug)
                    ->where('ch.slug', $chapter_slug)
                    ->where('co.status', 1)
                    ->where('ch.is_public', 1)
                    ->selectRaw('co.id as course_id, co.name as course_name, ch.id as chapter_id, co.slug as course_slug, ch.name as chapter_name, ch.description as chapter_description, ch.slug as chapter_slug')
                    ->first();

        //return 404 if not found
        if(!$lesson_info)
        {
            abort(404);
        }

        //get public lessons by chapter id
        $lessons = Lesson::getPublicLessonsByChapter($lesson_info->chapter_id);

        //get use status for completion
        $lessons = UserProgressStatus::addStatusToLessons($lessons);

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $lesson_info->course_id)
            ->where('item_type', 'course')
            ->first();

        //set meta
        $meta['keywords'] = 'course, learn, '.$lesson_info->course_name.' '.$lesson_info->chapter_name;
        $meta['description'] = 'Learn about '.$lesson_info->chapter_name.' in '.$lesson_info->course_name.'.';

        //add lesson names to the seo description
        $lessons_names = [];
        foreach ($lessons as $lesson) 
        {
           $lessons_names[] = $lesson->name; 
        }

        $meta['description'] .= ' In this chapter we will explain topics like: '.implode(', ', $lessons_names);

        return View::make('tutorials.lessons', [
            'chapter'       => $lesson_info,
            'meta'          => $meta,
            'course_id'     => $lesson_info->course_id,
            'lessons'       => $lessons,
            'course_image'  => $course_image,
            'user'          => Sentinel::getUser()
        ]);
    }

    public function showLessonContent(string $course_slug, string $chapter_slug, string $lesson_slug)
    {
        //get the lesson
        $lesson = Lesson::getLessonByCourseChapterLessonSlugs($course_slug, $chapter_slug, $lesson_slug);

        //return 404 if not found
        if(!$lesson)
        {
            abort(404);
        }

        //get lesson sections
        $lesson_sections_ = LessonSection::where('lesson_id', $lesson->lesson_id)
                            ->orderBy('order_weight')
                            ->where('is_public', 1);

        //get ids
        $lesson_sections_ids = $lesson_sections_->pluck('id');

        //get lessons
        $lesson_sections = $lesson_sections_->get();

        //get quizzes answers
        $quiz_answers = LessonSectionOption::whereIn('lesson_section_id', $lesson_sections_ids)
                        ->where('is_public', 1)
                        ->orderBy('order_weight')
                        ->get();

        //check we have answers
        if($quiz_answers)
        {
            $quiz_answers = $quiz_answers->groupBy('lesson_section_id')
                            ->all();
        }

        //get the next lesson
        $next_lesson = Lesson::getNextLesson($lesson->lesson_order, $lesson->chapter_id);

        //next lesson slug
        $next_slug = '';
        if($next_lesson)
            $next_slug = $next_lesson->slug;

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $lesson->course_id)
            ->where('item_type', 'course')
            ->first();

        $lesson_sections = UserToLessonSection::checkSectionsStatus($lesson_sections_ids, $lesson_sections);

        //set meta
        $meta['keywords'] = 'course, learn, '.$lesson->course_name.' '.$lesson->chapter_name.' '.$lesson->lesson_name;
        $meta['description'] = 'Learn '.$lesson->course_name.' '.$lesson->chapter_name.':  '.$lesson->lesson_name;

        return View::make('tutorials.lesson_content', [
            'lesson'            => $lesson,
            'lesson_sections'   => $lesson_sections,
            'meta'              => $meta,
            'course_id'         => $lesson->course_id,
            'next_slug'         => $next_slug,
            'quiz_answers'      => $quiz_answers,
            'course_image'      => $course_image,
            'user'              => Sentinel::getUser()
        ]);
    }

}