<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Sitemap
{
    private static $sitemap = [];

    public static function setItem($url, $lastmod = null, $priority = null, $changefreq = null)
    {
        //check url
        if (!$url) {
            return;
        }

        self::$sitemap[Request::root() . $url] = [];

        //check lastmod
        //if ($lastmod) {
        //    self::$sitemap[Request::root() . $url]['lastmod'] = Carbon::createFromFormat('Y-m-d H:i:s', $lastmod)->toIso8601String();
        //}

        //set priority
        self::$sitemap[Request::root() . $url]['priority'] = $priority ?? 0.5;

        //check changefreq
        //self::$sitemap[Request::root() . $url]['changefreq'] = $changefreq ?? 'daily';
    }

    public static function getSitemap()
    {
        return self::$sitemap;
    }
}