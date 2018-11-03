<?php

namespace App\Http\Controllers;


use View;
use App\Course;
use DB;
use Illuminate\Support\Facades\Log;

class TutorialsController extends Controller
{
    public function index()
    {
        return View::make('tutorials.index');
    }

    public function showCourse(string $course_slug)
    {
        //get the course
        $course = Course::where('slug', $course_slug)
                    ->where('is_public', 1)
                    ->firstOrFail();

        //set meta
        $meta['keywords'] = 'course, learn, '.$course->name;
        $meta['description'] = 'Learn '.$course->name;

        return View::make('tutorials.course', [
            'course'    => $course,
            'meta'      => $meta,
            'course_id' => $course->id
        ]);
    }

    public function showChapter(string $course_slug, string $chapter_slug)
    {

        //get the chapter
        $chapter = DB::table('courses as co')
                    ->join('courses as ch', 'co.id', '=', 'ch.parent_id')
                    ->where('co.slug', $course_slug)
                    ->where('ch.slug', $chapter_slug)
                    ->where('co.is_public', 1)
                    ->where('ch.is_public', 1)
                    ->selectRaw('co.id as course_id, co.name as course_name, co.slug as course_slug, ch.name as chapter_name, ch.description as chapter_description')
                    ->first();

        //return 404 if not found
        if(!$chapter)
        {
            abort(404);
        }

        //set meta
        $meta['keywords'] = 'course, learn, '.$chapter->course_name.' '.$chapter->chapter_name;
        $meta['description'] = 'Learn '.$chapter->course_name.' - '.$chapter->chapter_name;

        return View::make('tutorials.chapter', [
            'chapter'   => $chapter,
            'meta'      => $meta,
            'course_id' => $chapter->course_id
        ]);
    }

    public function showLesson(string $course_slug, string $chapter_slug, string $lesson_slug)
    {
        //get the lesson
        $lesson = DB::table('courses as co')
                ->join('courses as ch', 'co.id', '=', 'ch.parent_id')
                ->join('lessons as le', 'ch.id', '=', 'le.parent_id')
                ->where('co.slug', $course_slug)
                ->where('ch.slug', $chapter_slug)
                ->where('le.slug', $lesson_slug)
                ->where('co.is_public', 1)
                ->where('ch.is_public', 1)
                ->where('le.is_public', 1)
                ->selectRaw('co.id as course_id, co.name as course_name, co.slug as course_slag, ch.name as chapter_name, ch.slug as chapter_slag, le.name as lesson_name, le.description as lesson_description, le.content as lesson_content')
                ->first();

        //return 404 if not found
        if(!$lesson)
        {
            abort(404);
        }

        //set meta
        $meta['keywords'] = 'course, learn, '.$lesson->course_name.' '.$lesson->chapter_name.' '.$lesson->lesson_name;
        $meta['description'] = 'Learn '.$lesson->course_name.' '.$lesson->chapter_name.':  '.$lesson->lesson_name;

        return View::make('tutorials.lesson', [
            'lesson'    => $lesson,
            'meta'      => $meta,
            'course_id' => $lesson->course_id
        ]);
    }

}