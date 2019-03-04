<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 02/06/18
 * Time: 08:53
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\LessonSection;
use App\Libraries\Listing;
use View;
use App\Lesson;
use App\Course;
use App\Chapter;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Libraries\UIMessage;
use Redirect;
use App\Libraries\CoursesHierarchy\CoursesHierarchyFactory;


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
                'name'      => "AND name LIKE '%{name}%'",
                'is_public' => "AND is_public = {is_public}",
                'chapter' => "AND chapter_id = {chapter}"
            ),

            'sortables' => array(
                'name'          => '',
                'is_public'     => '',
                'created_at'    => '',
                'updated_at'    => '',
                'order_weight'  => 'asc'
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        //get chapters
        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $curses_hierarchy = $hierarchy_item->getHierarchyList();

        // display
        return View::make('_admin.lessons.index', array(
            'results'           => $results,
            'listing'           => $listing,
            'curses_hierarchy'  => json_encode($curses_hierarchy)
        ));
    }

    public function create()
    {
        $new_lesson = new Lesson();

        //get current max order;
        $max_order_number = Lesson::max('order_weight');
        $new_lesson->order_weight = (int)$max_order_number+1;
        $new_lesson->is_draft = 1;

        $courses = Course::get();
        $chapters = Chapter::get();

        //get map hierarchy

        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $curses_hierarchy = $hierarchy_item->getHierarchyList();
        $hierarchy_item->setDefaultAdminLessons();
        $curses_hierarchy_map = $hierarchy_item->getHierarchyList();

        return View::make('_admin.lessons.create_edit', [
            'lesson'        => $new_lesson,
            'courses'       => $courses,
            'chapters'      => $chapters,
            'curses_hierarchy'      => json_encode($curses_hierarchy),
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map),
            'lesson_sections'       => [],
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
        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $curses_hierarchy = $hierarchy_item->getHierarchyList();
        $hierarchy_item->setDefaultAdminLessons();
        $hierarchy_item->setPointingID($id.'lesson');
        $curses_hierarchy_map = $hierarchy_item->getHierarchyList();

        //get lesson sections
        $lesson_sections = LessonSection::where('lesson_id', $lesson->id)
                            ->orderBy('order_weight')
                            ->get();

        return View::make('_admin.lessons.create_edit', [
            'lesson'                => $lesson,
            'lesson_sections'       => $lesson_sections,
            'curses_hierarchy'      => json_encode($curses_hierarchy),
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map)
        ]);

    }

    function update($id, Request $request)
    {
        $lesson = Lesson::findOrFail($id);

        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required',
        );

        //if not draft and no slug
        $messages = [];
        if(
            //is not draft and no slug input and no slug saved
            (
                (empty($request->input('slug'))&& empty($lesson->slug))
                ||
                (empty($request->input('slug'))&& $request->input('enabled_slug_edit'))
            )
            && !$request->input('is_draft')
        )
        {
            $rules['slug'] = 'required|max:100';
            $messages['slug.required']  = 'Field slug required if not draft';
        }

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save course
            $lesson->name           = $request->input('name');
            $lesson->description    = $request->input('description');
            $lesson->is_public      = $request->input('is_public') ? 1 : 0;
            $lesson->order_weight   = $request->input('order_weight');
            if($request->input('enabled_slug_edit')){
                $lesson->slug       = $request->input('slug');
            }
            $lesson->chapter_id = $request->input('chapter_id');
            $lesson->save();

            //send user back
            UIMessage::set('success', 'Lesson updated successfully.');
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/lessons/'.$lesson->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/lessons/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/lessons'); //redirect to listing
        }

    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'name'        => 'required',
            'order_weight' => 'required',
            'slug'         => 'required|max:100'
        );

        //if not draft and slug is empty
        if( empty($request->input('slug')) && !$request->input('is_draft') ){
            $rules['slug'] = 'required|max:100';
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return redirect()->back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save lesson
            $lesson = new Lesson();
            $lesson->name           = $request->input('name');
            $lesson->description    = $request->input('description');
            $lesson->is_public      = $request->input('is_public') ? 1 : 0;
            $lesson->order_weight   = $request->input('order_weight');
            if($request->input('enabled_slug_edit')){
                $lesson->slug       = $request->input('slug');
            }
            $lesson->chapter_id = $request->input('chapter_id');
            $lesson->save();

            //send user back
            UIMessage::set('success', "Lesson created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/lessons/'.$lesson->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/lessons/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/lessons'); //redirect to listing

        }
    }

    public function destroy($id)
    {
        $lesson = Lesson::where('id', $id)
                    ->first();

        //check if exist
        if(!$lesson)
            abort(404);


        //check
        if($lesson->is_public === 1)
        {
            UIMessage::set('warning', 'The lesson is public, so it is still in use.');
            return redirect()->back();
        }

        //get parent id
        $chapter_id = $lesson->chapter_id;

        //delete lesson
        $lesson->delete();

        //update weight, get lessons
        $lessons = Lesson::where('chapter_id', $chapter_id)
            ->orderBy('order_weight')
            ->get();

        $i = 1;
        foreach ($lessons as $lesson)
        {
            $lesson->order_weight = $i;
            $lesson->update();
            $i++;
        }

        // still here? delete the field
        UIMessage::set('success', "Lesson deleted successfully. Order weight updated.");

        return redirect(config('app.admin_route').'/lessons');
    }
}