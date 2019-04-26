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
        Sitemap::setItem('/',  null, 1, 'weekly');

        //courses, chapters, lessons
        $courses = Course::publicCourses()
            ->with('publicChapters')
            ->with('publicChapters.publicLessons')
            ->get();

        //set courses
        foreach($courses as $course)
        {
            Sitemap::setItem('/tutorial/'.$course->slug, $course->updated_at, 0.6, 'hourly');

            //set chapters
            foreach ($course->publicChapters as $chapter)
            {
                Sitemap::setItem('/tutorial/'.$course->slug.'/'.$chapter->slug, $chapter->updated_at, 0.8, 'hourly');

                //set lessons
                foreach ($chapter->publicLessons as $lesson)
                {
                    Sitemap::setItem('/tutorial/'.$course->slug.'/'.$chapter->slug.'/'.$lesson->slug, $lesson->updated_at, 1, 'daily');
                }
            }
        }

        Sitemap::setItem('/user/sign-in', null, 0.5, 'weekly');
        Sitemap::setItem('/user/reset-password', null, 0.2, 'monthly');

        //static pages
        Sitemap::setItem('/contact', null, 0.4, 'monthly');

        //set other static pages
        foreach(MenuClientStatic::getStaticMenu() as $page)
        {
            Sitemap::setItem('/info/'.$page->slug, $page->updated_at, 0.3, 'monthly');
        }

        //get the sitemap
        $sitemap = Sitemap::getSitemap();

        //return the XML
        return Response::view('sitemap.sitemap', [
            'sitemap' => $sitemap
        ])->header('Content-Type', 'application/xml');
    }
}