<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 04/02/18
 * Time: 14:25
 */

namespace App\Http\Controllers\admin;

use App\Chapter;
use View;
use App\Http\Controllers\Controller;
use App\Course;
use App\Lesson;
use Log;
use App\Libraries\CoursesHierarchy\CoursesHierarchyFactory;

class DashboardController extends Controller
{
    function index()
    {
        //Courses
        $public_courses = Course::selectRaw('COUNT(id) as public')
                    ->where('status', 1)
                    ->first();

        $draft_courses = Course::selectRaw('COUNT(id) as draft')
                    ->where('status', 1)
                    ->first();

        $total_courses = Course::selectRaw('COUNT(id) as total')
                    ->first();

        //Chapters
        $public_chapters = Chapter::selectRaw('COUNT(id) as public')
                    ->where('is_public', 1)
                    ->first();

        $draft_chapters = Chapter::selectRaw('COUNT(id) as draft')
                    ->where('is_draft', 1)
                    ->first();

        $total_chapters = Chapter::selectRaw('COUNT(id) as total')
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

        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $hierarchy_item->setDefaultAdminLessons();
        $curses_hierarchy_map = $hierarchy_item->getHierarchyList();

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