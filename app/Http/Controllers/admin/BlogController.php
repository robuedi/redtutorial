<?php


namespace App\Http\Controllers\admin;


use App\BlogArticle;
use App\Http\Controllers\Controller;
use App\Libraries\Listing;
use App\Libraries\UIMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use View;

class BlogController extends Controller
{
    function index()
    {
        if ($clean_query_string = Listing::cleanQueryString())
            return redirect($clean_query_string);

        // settings
        $query_data = array(

            'fields' => "ba.*",

            'body' => "FROM blog_articles ba
                        WHERE (1) {filters}",

            'filters' => array(
                'title' => "AND ba.title LIKE '%{title}%'",
                'slug' => "AND ba.slug LIKE '%{slug}%'",
                'is_public' => "AND ba.is_public = {is_public}",
                'is_draft' => "AND ba.is_draft = {is_draft}",
            ),

            'sortables' => array(
                'ba.name'           => '',
                'ba.is_public'      => '',
                'ba.is_draft'       => '',
                'ba.created_at'     => '',
                'ba.updated_at'     => 'asc',
            )
        );

        // obtine rezultatele
        $listing = new Listing($query_data);
        $results = $listing->results();

        // display
        return View::make('_admin.blog.index', array(
            'results'           => $results,
            'listing'           => $listing
        ));
    }

    function create()
    {
        $new_article = new BlogArticle();

        //by default is draft
        $new_article->is_draft = 1;

        return View::make('_admin.blog.create_edit', [
            'article'               => $new_article,
        ]);
    }

    public function edit($id)
    {
        //get article
        $article = BlogArticle::where('id', $id)
            ->first();

        //check if exist
        if(!$article)
            abort(404);

        return View::make('_admin.blog.create_edit', [
            'article'                => $article,
        ]);

    }

    function update($id, Request $request)
    {
        $article = BlogArticle::findOrFail($id);

        // validate
        $rules = array(
            'title'        => 'required',
        );

        //if public and no slug
        $messages = [];
        if(
            //is public  and no slug input and no slug saved
            (
                (empty($request->input('slug'))&& empty($article->slug))
                ||
                (empty($request->input('slug'))&& $request->input('enabled_slug_edit'))
            )
            && $request->input('is_public')
        )
        {
            $rules['slug'] = 'required|max:100';
            $messages['slug.required']  = 'Field slug required if public';
        }

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save article
            $article->title             = $request->input('title');
            $article->meta_description  = $request->input('meta_description');
            $article->content           = $request->input('content');
            $article->is_public         = $request->input('is_public') ? 1 : 0;
            $article->is_draft          = $request->input('is_draft') ? 1 : 0;
            if($request->input('enabled_slug_edit')){
                $article->slug          = $request->input('slug');
            }
            $article->save();

            //send user back
            UIMessage::set('success', 'Article updated successfully.');
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/blog/'.$article->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/blog/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/blog'); //redirect to listing
        }

    }

    function store(Request $request)
    {
        // validate
        $rules = array(
            'title'        => 'required',
        );

        //if public and no slug
        $messages = [];
        if(
            //is public  and no slug input and no slug saved
            (empty($request->input('slug'))&& $request->input('enabled_slug_edit'))
            && $request->input('is_public')
        )
        {
            $rules['slug'] = 'required|max:100';
            $messages['slug.required']  = 'Field slug required if public';
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return redirect()->back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save article
            $article                    = new BlogArticle();
            $article->title             = $request->input('title');
            $article->meta_description  = $request->input('meta_description');
            $article->content           = $request->input('content');
            $article->is_public         = $request->input('is_public') ? 1 : 0;
            $article->is_draft          = $request->input('is_draft') ? 1 : 0;
            if($request->input('enabled_slug_edit')){
                $article->slug          = $request->input('slug');
            }
            $article->save();

            //send user back
            UIMessage::set('success', "Article created successfully.");
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/blog/'.$article->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/blog/create'); // save and add new
            else
                return redirect(config('app.admin_route').'/blog'); //redirect to listing

        }
    }

    public function destroy($id)
    {
        $article = BlogArticle::where('id', $id)
            ->first();

        //check if exist
        if(!$article)
            abort(404);


        //check
        if($article->is_public === 1)
        {
            UIMessage::set('warning', 'The article is public, so it is still in use.');
            return redirect()->back();
        }

        //delete article
        $article->delete();

        // still here? delete the field
        UIMessage::set('success', "Blog article deleted successfully.");

        return redirect(config('app.admin_route').'/blog');
    }
}