<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 24/02/18
 * Time: 14:18
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Libraries\REC\Listing;
use App\Course;
use Validator;
use View;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Libraries\REC\UIMessage;

class CoursesController extends Controller
{

    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "co.id, co.name, co.is_public, co.is_draft, co.created_at, co.updated_at, co.order_weight, co.slug",

            'body' => "FROM courses co
                        WHERE parent_id IS NULL {filters}",

            'filters' => array(
                'name' => "AND name LIKE '%{name}%'",
                'is_draft' => "AND is_draft = {is_draft}",
                'is_public' => "AND is_public = {is_public}"
            ),

            'sortables' => array(
                'name'         => '',
                'is_public'     => '',
                'is_draft'     => '',
                'created_at'    => '',
                'updated_at'    => '',
                'order_weight'  => 'asc'
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.courses.index', array(
            'results' => $results,
            'listing' => $listing,
        ));
    }

    function create()
    {
        $new_course = new Course();
        //get current max order;
        $max_order_number = Course::whereNull('parent_id')->max('order_weight');
        $new_course->order_weight = (int)$max_order_number+1;
        $new_course->is_draft = 1;

        return View::make('_admin.courses.create_edit', ['course' => $new_course]);
    }

    function edit($id)
    {
        //get course
        $course = Course::where('id', $id)->whereNull('parent_id')
                    ->first();

        //check if exist
        if(!$course)
            abort(404);

        return View::make('_admin.courses.create_edit', ['course' => $course]);
    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required',
            'slug'         => 'required|max:100'
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
            if($request->input('enabled_slug_edit')){
                $course->slug          = $request->input('slug');
            }
            $course->level = 0;
            $course->parent_id = null;
            $course->save();

            //send user back
            UIMessage::set('success', "Course created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect('admin/courses/'.$course->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect('admin/courses/create'); // save and add new
            else
                return redirect('admin/courses'); //redirect to listing

        }
    }

    function update($id, Request $request)
    {
        $course = Course::findOrFail($id);

        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required',
            'slug'         => 'required|max:100'
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
            if($request->input('enabled_slug_edit')){
                $course->slug          = $request->input('slug');
            }
            $course->save();

            //send user back
            UIMessage::set('success', 'Course updated successfully.');
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect('admin/courses/'.$course->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect('admin/courses/create'); // save and add new
            else
                return redirect('admin/courses'); //redirect to listing
        }

    }

    public function destroy($id)
    {
        $course = Course::where('id', $id)->whereNull('parent_id')
            ->first();

        //check if exist
        if(!$course)
            abort(404);

        //check if chapters or lessons linked with the course
        $linked_chapters = Course::where('parent_id', $id)
                                ->count();

        $linked_lesson = Lesson::where('course_id', $id)
                                ->count();

        //check
        if($linked_chapters || $linked_lesson)
        {
            $warning = 'There are chapter(s) and lesson(s) linked to the course.';
            if($linked_chapters && !$linked_lesson)
            {
                $warning = 'There is a chapter(s) already linked to the course';
            }
            elseif($linked_lesson)
            {
                $warning = 'There is a lesson(s) already linked to the course';
            }

            UIMessage::set('warning', $warning);
            return redirect()->back();
        }

        //delete course
        $course->delete();

        //update weight
        $courses = Course::whereNull('parent_id')
                            ->orderBy('order_weight')
                            ->get();

        $i = 1;
        foreach ($courses as $course)
        {
            $course->order_weight = $i;
            $course->update();
            $i++;
        }

        // still here? delete the field
        UIMessage::set('success', "Course deleted successfully. Order weight updated.");

        return redirect('admin/courses');
    }

}


















