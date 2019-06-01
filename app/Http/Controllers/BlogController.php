<?php


namespace App\Http\Controllers;


use App\BlogArticle;
use View;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{

    public function index()
    {
        //get public blog articles
        $public_articles = BlogArticle::getPublicArticles();

        return View::make('blog.index', [
            'articles' => $public_articles
        ]);

    }

}