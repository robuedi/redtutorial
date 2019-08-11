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

        $chapter_seo_clean = false;

        //set courses
        foreach($courses as $course)
        {
            Sitemap::setItem('/'.$course->slug, 0.6);
            if($course->slug == 'php-tutorial')
            {
                Sitemap::setItem('/tutorial-php', 0.1);
                Sitemap::setItem('/tutorial/php', 0.1);
            }

            //set chapters
            foreach ($course->publicChapters as $chapter)
            {
                if($chapter->slug === 'Arrays')
                {
                   $chapter_seo_clean = true;
                }

                if(!$chapter_seo_clean)
                {
                    Sitemap::setItem('/'.$course->slug.'/'.$chapter->slug, 0.1);
                    if($course->slug == 'php-tutorial')
                    {
                        Sitemap::setItem('/tutorial-php/'.$chapter->slug, 0.1);
                        Sitemap::setItem('/tutorial/php/'.$chapter->slug, 0.1);
                    }  
                }
                
                //set lessons
                foreach ($chapter->publicLessons as $lesson)
                {
                    Sitemap::setItem('/'.$course->slug.'/'.$chapter->slug.'/'.$lesson->slug, 1);
                    if($course->slug == 'php-tutorial'&&!$chapter_seo_clean)
                    {
                        Sitemap::setItem('/tutorial-php/'.$chapter->slug.'/'.$lesson->slug, 0.1);
                        Sitemap::setItem('/tutorial/php/'.$chapter->slug.'/'.$lesson->slug,0.1);
                    }

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