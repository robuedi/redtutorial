<?php


namespace App\Http\Controllers;

use App\Libraries\Sitemap;
use App\Libraries\MenuClientStatic;
use Illuminate\Support\Facades\Response;
use App\Course;

class SitemapController
{

    public function index()
    {

        //homepage
        Sitemap::setItem('/',   1);

        //courses, chapters, lessons
        $courses = Course::publicCourses()
            ->with('publicChapters')
            ->with('publicChapters.publicLessons')
            ->get();

        //set courses
        foreach($courses as $course)
        {
            Sitemap::setItem('/'.$course->slug, 0.6);

            //set chapters
            foreach ($course->publicChapters as $chapter)
            {
                Sitemap::setItem('/'.$course->slug.'/'.$chapter->slug,0.8);

                //set lessons
                foreach ($chapter->publicLessons as $lesson)
                {
                    Sitemap::setItem('/'.$course->slug.'/'.$chapter->slug.'/'.$lesson->slug,1);
                }
            }
        }

        //user urls
        Sitemap::setItem('/user/sign-in',0.5);
        Sitemap::setItem('/user/reset-password',0.2);

        //static pages
        Sitemap::setItem('/contact-us',0.4);

        //set other static pages
        foreach(MenuClientStatic::getStaticMenu() as $page)
        {
            Sitemap::setItem('/info/'.$page->slug,0.3);
        }

        //get the sitemap
        $sitemap = Sitemap::getSitemap();

        //return the XML
        return Response::view('sitemap.sitemap', [
            'sitemap' => $sitemap
        ])->header('Content-Type', 'application/xml');
    }
}