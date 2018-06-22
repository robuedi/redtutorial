<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/06/18
 * Time: 08:53
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\REC\Listing;
use View;
use App\Lesson;
use App\Course;
use App\Chapter;


class LessonsController extends Controller
{

    public function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "le.id, le.name, le.is_public, le.created_at, le.updated_at, le.order_weight",

            'body' => "FROM lessons le
                        WHERE(1) {filters}",

            'filters' => array(
                'name' => "AND name LIKE '%{name}%'",
                'is_public' => "AND is_public = {is_public}"
            ),

            'sortables' => array(
                'name'          => '',
                'is_public'     => '',
                'created_at'    => '',
                'updated_at'    => 'asc'
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.lessons.index', array(
            'results' => $results,
            'listing' => $listing,
        ));
    }

    public function create()
    {
        $new_lesson = new Lesson();

        //get current max order;
        $max_order_number = Lesson::max('order_weight');
        $new_lesson->order_weight = (int)$max_order_number+1;
        $courses = Course::whereNull('parent_id')->get();
        $chapters = Course::whereNotNull('parent_id')->get();

        //get map hierarchy
        $curses_hierarchy_map = Course::getHierarchicalList(null, true);

        return View::make('_admin.lessons.create_edit', [
            'lesson'        => $new_lesson,
            'courses'       => $courses,
            'chapters'      => $chapters,
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map)
        ]);
    }

    public function edit($id)
    {
        //get lesson
        $lesson = Lesson::where('id', $id)
                    ->first();

        //check if exist
        if(!$lesson)
            abort(404);

        //get map hierarchy
        $curses_hierarchy_map = Course::getHierarchicalList($id.'lesson', true);

        return View::make('_admin.lessons.create_edit', [
            'lesson' => $lesson,
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map)
        ]);

    }

    public function update()
    {

    }

    public function store()
    {

    }

    public function destroy()
    {

    }

    public function getOrderFromParentAjax()
    {
        $response = [
            'status'    => 0,
            'message'   => 'Error'
        ];




        return Response::json($response);
    }
}