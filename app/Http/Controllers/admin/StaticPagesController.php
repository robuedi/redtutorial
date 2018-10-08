<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 05/10/18
 * Time: 02:11
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Libraries\Listing;
use App\StaticPage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Libraries\UIMessage;


class StaticPagesController extends Controller
{

    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "id, name, slug, is_public, is_draft, created_at, updated_at",

            'body' => "FROM static_pages
                        WHERE (1) {filters}",

            'filters' => array(
                'name' => "AND name LIKE '%{name}%'",
                'slug' => "AND slug LIKE '%{slug}%'",
                'is_draft' => "AND is_draft = {is_draft}",
                'is_public' => "AND is_public = {is_public}"
            ),

            'sortables' => array(
                'name'         => '',
                'slug'         => '',
                'is_public'    => '',
                'is_draft'     => '',
                'created_at'   => '',
                'updated_at'   => 'desc',
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.static_pages.index', array(
            'results' => $results,
            'listing' => $listing,
        ));
    }

    function create()
    {
        //create new static page
        $new_page = new StaticPage();

        //set default values for new static pages
        $new_page->is_draft = 1;
        $new_page->is_public = 0;

        return View::make('_admin.static_pages.create_edit', array(
            'page' => $new_page
        ));
    }

    function edit($id)
    {
        $page = StaticPage::findOrFail($id);

        return View::make('_admin.static_pages.create_edit', array(
            'page' => $page
        ));
    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'name'              => 'required|max:255',
            'head_title'        => 'required|max:255',
            'meta_description'  => 'required|max:300',
            'slug'              => 'required|max:255',
            'heading'           => 'max:255',
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
            $page = new StaticPage();
            $page->name             = $request->input('name');
            $page->heading          = $request->input('heading');
            $page->head_title       = $request->input('head_title');
            $page->meta_description = $request->input('head_title');
            $page->content          = $request->input('content');
            $page->is_public        = $request->input('is_public') ? 1 : 0;
            $page->is_draft         = $request->input('is_draft') ? 1 : 0;
            $page->slug             = $request->input('slug');
            $page->save();

            //send user back
            UIMessage::set('success', "Page created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/static-pages/'.$page->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/static-pages/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/static-pages'); //redirect to listing
        }
    }

    function update($id, Request $request)
    {
        //get the current page
        $page = StaticPage::findOrFail($id);

        // validate
        $rules = array(
            'name'              => 'required|max:255',
            'head_title'        => 'required|max:255',
            'meta_description'  => 'required|max:300',
            'heading'           => 'max:255',
        );

        //validate slug
        $messages = [];
        if((empty($request->input('slug'))&& empty($page->slug))
            ||
            (empty($request->input('slug'))&& $request->input('enabled_slug_edit')))
        {
            $rules['slug'] = 'required|max:255';
            $messages['slug.required']  = 'Field slug is required.';
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
            $page->name             = $request->input('name');
            $page->heading          = $request->input('heading');
            $page->head_title       = $request->input('head_title');
            $page->meta_description = $request->input('head_title');
            $page->content          = $request->input('content');
            $page->is_public        = $request->input('is_public') ? 1 : 0;
            $page->is_draft         = $request->input('is_draft') ? 1 : 0;

            if($request->input('enabled_slug_edit'))
            {
                $page->slug             = $request->input('slug');
            }

            $page->save();

            //send user back
            UIMessage::set('success', "Page updated successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/static-pages/'.$page->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/static-pages/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/static-pages'); //redirect to listing
        }
    }

    function destroy($id)
    {
        $page = StaticPage::findOrFail($id);

        //check if in use
        if($page->is_public)
        {
            UIMessage::set('warning', 'Page is in use. First remove it from being public.');
            return redirect()->back();
        }

        //delete page
        $page->delete();

        UIMessage::set('success', 'Page deleted successfully.');

        return redirect(config('app.admin_route').'/static-pages');
    }
}