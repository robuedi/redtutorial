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


class LessonsController extends Controller
{

    public function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "le.id, le.title, le.is_public, le.created_at, le.updated_at, le.order_weight",

            'body' => "FROM lessons le
                        WHERE(1) {filters}",

            'filters' => array(
                'title' => "AND title LIKE '%{title}%'",
                'is_public' => "AND is_public = {is_public}"
            ),

            'sortables' => array(
                'title'         => '',
                'is_public'     => '',
                'created_at'    => '',
                'updated_at'    => '',
                'order_weight'  => 'asc'
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
        $courses = Course::where('is_draft', 0)->get();
        $chapters = Chapter::where('is_draft', 0)->get();

        return View::make('_admin.lessons.create_edit', [
            'main_object'   => $new_lesson,
            'courses'       => $courses,
            'chapters'      => $chapters,
            'create_action' => true
        ]);
    }

    public function edit()
    {

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
}