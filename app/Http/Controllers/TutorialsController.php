<?php

namespace App\Http\Controllers;


use App\Chapter;
use App\LessonSection;
use App\LessonSectionOption;
use View;
use App\Course;
use App\Lesson;
use DB;
use Illuminate\Support\Facades\Log;
use App\MediaFileToItem;
use Sentinel;

class TutorialsController extends Controller
{
    public function index()
    {
        return View::make('tutorials.index');
    }

    public function showChapters(string $course_slug)
    {
        //get the course
        $course = Course::where('slug', $course_slug)
                    ->where('is_public', 1)
                    ->firstOrFail();

        //get chapters
        $chapters = Chapter::join('lessons', 'chapters.id', '=', 'lessons.chapter_id')
                        ->where('chapters.course_id', $course->id)
                        ->where('chapters.is_public', 1)
                        ->where('lessons.is_public', 1)
                        ->whereNotNull('chapters.slug')
                        ->groupBy('chapters.id')
                        ->selectRaw('chapters.id, chapters.name, chapters.slug, COUNT(lessons.id) AS lessons_number')
                        ->orderBy('chapters.order_weight')
                        ->get();

        $chapters = Chapter::addCurrentUserCompletionStatus($chapters);

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $course->id)
            ->where('item_type', 'course')
            ->first();

        //set meta
        $meta['keywords'] = 'course, learn, '.$course->name;
        $meta['description'] = 'Learn '.$course->name;

        return View::make('tutorials.chapters', [
            'course'        => $course,
            'meta'          => $meta,
            'course_id'     => $course->id,
            'chapters'      => $chapters,
            'course_image'  => $course_image
        ]);
    }

    public function showLessons(string $course_slug, string $chapter_slug)
    {

        //get the chapter
        $lesson_info = DB::table('courses as co')
                    ->join('chapters as ch', 'co.id', '=', 'ch.course_id')
                    ->where('co.slug', $course_slug)
                    ->where('ch.slug', $chapter_slug)
                    ->where('co.is_public', 1)
                    ->where('ch.is_public', 1)
                    ->selectRaw('co.id as course_id, co.name as course_name, ch.id as chapter_id, co.slug as course_slug, ch.name as chapter_name, ch.description as chapter_description, ch.slug as chapter_slug')
                    ->first();

        //return 404 if not found
        if(!$lesson_info)
        {
            abort(404);
        }

        //get chapters
        $lessons = Lesson::where('chapter_id', $lesson_info->chapter_id)
            ->where('is_public', 1)
            ->whereNotNull('slug')
            ->orderBy('order_weight')
            ->get();

        //set index
        $lesson_i       = 1;
        $lesson_count   = count($lessons);
        foreach ($lessons as $lesson)
        {
            $lesson->index = $lesson_i.'/'.$lesson_count;
            $lesson_i++;
        }

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $lesson_info->course_id)
            ->where('item_type', 'course')
            ->first();

        //set meta
        $meta['keywords'] = 'course, learn, '.$lesson_info->course_name.' '.$lesson_info->chapter_name;
        $meta['description'] = 'Learn '.$lesson_info->course_name.' - '.$lesson_info->chapter_name;

        return View::make('tutorials.lessons', [
            'chapter'   => $lesson_info,
            'meta'      => $meta,
            'course_id' => $lesson_info->course_id,
            'lessons'   => $lessons,
            'course_image'   => $course_image
        ]);
    }

    public function showLessonContent(string $course_slug, string $chapter_slug, string $lesson_slug)
    {
        //get the lesson
        $lesson = DB::table('courses as co')
                ->join('chapters as ch', 'co.id', '=', 'ch.course_id')
                ->join('lessons as le', 'ch.id', '=', 'le.chapter_id')
                ->where('co.slug', $course_slug)
                ->where('ch.slug', $chapter_slug)
                ->where('le.slug', $lesson_slug)
                ->where('co.is_public', 1)
                ->where('ch.is_public', 1)
                ->where('le.is_public', 1)
                ->selectRaw('co.id as course_id, co.name as course_name, co.slug as course_slag, ch.name as chapter_name, ch.slug as chapter_slag, le.chapter_id as chapter_id, le.order_weight as lesson_order, le.id as lesson_id, le.name as lesson_name, le.description as lesson_description')
                ->first();

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
        $next_lesson = Lesson::where('lessons.order_weight', '>', $lesson->lesson_order)
                        ->where('lessons.chapter_id', $lesson->chapter_id)
                        ->where('lessons.is_public',1)
                        ->join('lessons_sections', 'lessons_sections.lesson_id', '=', 'lessons.id')
                        ->where('lessons_sections.is_public', 1)
                        ->orderBy('lessons.order_weight')
                        ->first();

        //next lesson slug
        $next_slug = '';
        if($next_lesson)
            $next_slug = $next_lesson->slug;

        //get image
        $course_image = MediaFileToItem::join('media_files', 'media_files_to_items.file_id', '=', 'media_files.id')
            ->where('item_id', $lesson->course_id)
            ->where('item_type', 'course')
            ->first();

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
            'course_image'   => $course_image
        ]);
    }

}