<?php

namespace App\Http\Controllers\admin;

use App\Chapter;
use App\Libraries\CoursesHierarchy\CoursesHierarchyFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Libraries\Listing;
use App\Course;
use Validator;
use View;
use App\Libraries\UIMessage;
use App\Http\Controllers\Controller;
use Log;
use Redirect;

class ChaptersController extends Controller
{

    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "co.id, co.name, c.name as course_name, co.is_public, co.is_draft, co.created_at, co.updated_at, co.order_weight",

            'body' => "FROM chapters co
                        INNER JOIN courses c ON co.course_id = c.id
                        WHERE (1) {filters}",

            'filters' => array(
                'name' => "AND co.name LIKE '%{name}%'",
                'is_public' => "AND co.is_public = {is_public}",
                'is_draft' => "AND co.is_draft = {is_draft}",
                'course' => "AND co.course_id = {course}",
                'slug' => "AND co.slug = '%{slug}%'"
            ),

            'sortables' => array(
                'co.name'           => '',
                'co.is_public'      => '',
                'co.is_draft'       => '',
                'co.created_at'     => '',
                'co.updated_at'     => '',
                'c.name'            => '',
                'co.order_weight'   => 'asc'
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        //get hierarchy
        //without chapters
        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $hierarchy_item->setChapters([]);
        $curses_hierarchy = $hierarchy_item->getHierarchyList();

        // display
        return View::make('_admin.chapters.index', array(
            'curses_hierarchy'  => json_encode($curses_hierarchy),
            'results'           => $results,
            'listing'           => $listing
        ));
    }

    function create()
    {
        $new_chapter = new Chapter();

        //by default is draft
        $new_chapter->is_draft = 1;

        //get current max order;
        $max_order_number = Chapter::max('order_weight');

        $new_chapter->order_weight = (int)$max_order_number+1;

        //get hierarchy
        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');

        //get map hierarchy
        //add back chapters
        $hierarchy_item->setDefaultAdminLessons();
        $curses_hierarchy_map = $hierarchy_item->getHierarchyList();

        //get input hierarchy
        $hierarchy_item->setChapters([]);
        $curses_hierarchy = $hierarchy_item->getHierarchyList();

        return View::make('_admin.chapters.create_edit', [
            'chapter'               => $new_chapter,
            'curses_hierarchy'      => json_encode($curses_hierarchy),
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map)
        ]);
    }

    function edit($id)
    {
        $chapter = Chapter::findOrFail($id);

        //get hierarchy
        $hierarchy_item = CoursesHierarchyFactory::createHierarchyObject('admin');
        $hierarchy_item->setDefaultAdminLessons();
        $hierarchy_item->setPointingID($id.'chapter');
        $curses_hierarchy_map = $hierarchy_item->getHierarchyList();


        //get input hierarchy
        $hierarchy_item->setChapters([]);
        $curses_hierarchy = $hierarchy_item->getHierarchyList();

        return View::make('_admin.chapters.create_edit', [
            'chapter'               => $chapter,
            'curses_hierarchy'      => json_encode($curses_hierarchy),
            'curses_hierarchy_map'  => json_encode($curses_hierarchy_map)
        ]);
    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'name'                  => 'required',
            'order_weight'          => 'required',
            'course_id'             => 'required|integer',
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
            //save course
            $chapter = new Chapter();
            $chapter->name          = $request->input('name');
            $chapter->description   = $request->input('description');
            $chapter->is_public     = $request->input('is_public') ? 1 : 0;
            $chapter->order_weight  = $request->input('order_weight');
            $chapter->course_id     = $request->input('course_id');

            if($request->input('enabled_slug_edit')){
                $chapter->slug          = $request->input('slug');
            }
            $chapter->save();

            //send user back
            UIMessage::set('success', "Course created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/chapters/'.$chapter->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/chapters/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/chapters'); //redirect to listing

        }
    }

    function update($id, Request $request)
    {
        $chapter = Chapter::findOrFail($id);

        // validate
        $rules = array(
            'name'                  => 'required',
            'order_weight'          => 'required',
            'course_id'             => 'required|integer',
        );

        //if not draft and no slug
        $messages = [];
        if(
            //is not draft and no slug input and no slug saved
            (
                (empty($request->input('slug'))&& empty($chapter->slug))
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
            $chapter->name = $request->input('name');
            $chapter->description = $request->input('description');
            $chapter->is_public = $request->input('is_public') ? 1 : 0;
            $chapter->is_draft = $request->input('is_draft') ? 1 : 0;
            $chapter->order_weight = $request->input('order_weight');
            $chapter->course_id = $request->input('course_id');
            if($request->input('enabled_slug_edit')){
                $chapter->slug          = $request->input('slug');
            }
            $chapter->save();

            //send user back
            UIMessage::set('success', "Chapter updated successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/chapters/'.$chapter->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/chapters/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/chapters'); //redirect to listing
        }

    }

    public function destroy($id)
    {
        $chapter = Chapter::find($id);

        //check if exist
        if(!$chapter)
            abort(404);

        //check if chapters or lessons linked with the chapter
        $linked_chapters = Chapter::where('course_id', $id)
            ->count();

        $linked_lesson = Lesson::where('course_id', $id)
            ->count();

        //check
        if($linked_chapters || $linked_lesson)
        {
            $warning = 'There are chapter(s) and lesson(s) linked to the chapter.';
            if($linked_chapters && !$linked_lesson)
            {
                $warning = 'There is a chapter(s) already linked to the chapter';
            }
            elseif($linked_lesson)
            {
                $warning = 'There is a lesson(s) already linked to the chapter';
            }

            UIMessage::set('warning', $warning);
            return redirect()->back();
        }

        //delete chapter
        $course_id = $chapter->course_id;
        $chapter->delete();

        //update weight
        $chapters = Chapter::where('course_id', $course_id)
            ->orderBy('order_weight')
            ->get();

        $i = 1;
        foreach ($chapters as $chapter)
        {
            $chapter->order_weight = $i;
            $chapter->update();
            $i++;
        }

        // still here? delete the field
        UIMessage::set('success', "Chapter deleted successfully. Order weight updated.");

        return redirect(config('app.admin_route').'/chapters');
    }

}


















