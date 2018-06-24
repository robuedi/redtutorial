<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 04/02/18
 * Time: 14:25
 */

namespace App\Http\Controllers\admin;

use View;
use App\Http\Controllers\Controller;
use App\Course;
use App\Lesson;
use Log;

class DashboardController extends Controller
{
    function index()
    {
        //Courses
        $public_courses = Course::whereNull('parent_id')
                    ->selectRaw('COUNT(id) as public')
                    ->where('is_public', 1)
                    ->first();

        $draft_courses = Course::whereNull('parent_id')
                    ->selectRaw('COUNT(id) as draft')
                    ->where('is_draft', 1)
                    ->first();

        $total_courses = Course::whereNull('parent_id')
                    ->selectRaw('COUNT(id) as total')
                    ->first();

        //Chapters
        $public_chapters = Course::whereNotNull('parent_id')
                    ->selectRaw('COUNT(id) as public')
                    ->where('is_public', 1)
                    ->first();

        $draft_chapters = Course::whereNotNull('parent_id')
                    ->selectRaw('COUNT(id) as draft')
                    ->where('is_draft', 1)
                    ->first();

        $total_chapters = Course::whereNotNull('parent_id')
                    ->selectRaw('COUNT(id) as total')
                    ->first();

        //Lessons
        $public_lessons = Lesson::selectRaw('COUNT(id) as public')
                    ->where('is_public', 1)
                    ->first();

        $draft_lessons = Lesson::selectRaw('COUNT(id) as draft')
                    ->where('is_draft', 1)
                    ->first();

        $total_lessons = Lesson::selectRaw('COUNT(id) as total')
                    ->first();

        //get hierarchy
        $curses_hierarchy_map = Course::getHierarchicalList(null, true);

        Log::info($curses_hierarchy_map);

        return View::make('_admin.dashboard.index', [
            'public_courses'    => $public_courses->public,
            'draft_courses'     => $draft_courses->draft,
            'total_courses'     => $total_courses->total,
            'public_chapters'   => $public_chapters->public,
            'draft_chapters'    => $draft_chapters->draft,
            'total_chapters'    => $total_chapters->total,
            'public_lessons'    => $public_lessons->public,
            'draft_lessons'     => $draft_lessons->draft,
            'total_lessons'     => $total_lessons->total,
            'curses_hierarchy_map' => json_encode($curses_hierarchy_map)

        ]);
    }
}