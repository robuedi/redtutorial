<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 24/02/18
 * Time: 14:18
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Libraries\AdminLib\Listing;
use App\Course;
use Log;

class CoursesController extends Controller
{
    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "co.id, co.title, co.is_public, co.created_at, co.updated_at, co.order_weight",

            'body' => "FROM courses co
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
        return View::make('admin.courses.index', array(
            'results' => $results,
            'listing' => $listing,
        ));
    }

    function create()
    {
        $new_course = new Course();
        //get current max order;
        $max_order_number = Course::max('order_weight');
        $new_course->order_weight = (int)$max_order_number+1;

        return View::make('admin.courses.create_edit', ['new_course' => $new_course]);
    }

    function store(Request $request)
    {
        $new_course = new Course();
        $new_course->title = $request->input('title');
        $new_course->description = $request->input('description');
        $new_course->is_public = $request->input('is_public') ? 1 : 0;
        $new_course->order_weight = $request->input('order_weight');
        $new_course->save();

        return redirect('admin/courses');
    }

}


















