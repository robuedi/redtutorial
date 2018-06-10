<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Libraries\REC\Listing;
use App\Course;
use Validator;
use View;
use App\Libraries\REC\UIMessage;
use App\Http\Controllers\Controller;
use Log;

class ChaptersController extends Controller
{

    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "co.id, co.name, co.is_public, co.is_draft, co.level, co.created_at, co.updated_at, co.order_weight",

            'body' => "FROM courses co
                        WHERE parent_id IS NOT NULL {filters}",

            'filters' => array(
                'name' => "AND name LIKE '%{name}%'",
                'is_public' => "AND is_public = {is_public}",
                'is_draft' => "AND is_draft = {is_draft}",
                'level' => "AND level = {level}",
                'slug' => "AND slug = '%{slug}%'"
            ),

            'sortables' => array(
                'name'         => '',
                'is_public'     => '',
                'is_draft'      => '',
                'level'         => '',
                'created_at'    => '',
                'updated_at'    => '',
                'order_weight'  => 'asc'
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        //get chapters levels
        $levels = Course::whereNotNull('parent_id')
                        ->pluck('level');

        $courses_chapters = Course::get();



        // display
        return View::make('_admin.chapters.index', array(
            'results'   => $results,
            'levels'    => $levels,
            'listing'   => $listing
        ));
    }

    function create()
    {
        $new_course = new Course();
        //get current max order;
        $max_order_number = Course::max('order_weight');
        $new_course->order_weight = (int)$max_order_number+1;
        $courses = Course::where('is_draft', 0)->get();
        $curses_hierarchy = Course::getHierarchicalList();

        return View::make('_admin.chapters.create_edit', [
            'section_obj'       => $new_course,
            'courses'           => $courses,
            'curses_hierarchy'  => json_encode($curses_hierarchy),
            'create_action'     => true
        ]);
    }

    function edit($id)
    {
        $course = Course::findOrFail($id);
        $curses_hierarchy = Course::getHierarchicalList();
        return View::make('_admin.chapters.create_edit', [
            'section_obj'       => $course,
            'curses_hierarchy'  => json_encode($curses_hierarchy)
        ]);
    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return redirect()->back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save course
            $course = new Course();
            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->is_public = $request->input('is_public') ? 1 : 0;
            $course->order_weight = $request->input('order_weight');
            $course->save();

            //send user back
            UIMessage::set('success', "Course created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect('admin/chapters/'.$course->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect('admin/chapters/create'); // save and add new
            else
                return redirect('admin/chapters'); //redirect to listing

        }
    }

    function update($id, Request $request)
    {
        $course = Course::findOrFail($id);

        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save course
            $course->name = $request->input('name');
            $course->description = $request->input('description');
            $course->is_public = $request->input('is_public') ? 1 : 0;
            $course->order_weight = $request->input('order_weight');
            $course->save();

            //send user back
            UIMessage::set('success', ucfirst($this->section_name_sg)." updated successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect('admin/chapters/'.$course->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect('admin/chapters/create'); // save and add new
            else
                return redirect('admin/chapters'); //redirect to listing
        }

    }

    public function destroy($id)
    {
        $course = Course::find($id);

        // if the record is not found, redirect to listing with an message
        if(!$course)
        {
            UIMessage::set('warning', "Invalid course ID.");
            return redirect()->back();
        }

        //delete course
        $course->delete();

        //update weight
        $courses = Course::orderBy('order_weight')->get();
        $i = 1;
        foreach ($courses as $course)
        {
            $course->order_weight = $i;
            $course->update();
            $i++;
        }

        // still here? delete the field
        UIMessage::set('success', ucfirst($this->section_name_sg)." deleted successfully. Order weight updated.");


        return redirect('admin/chapters');
    }

}


















