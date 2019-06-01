<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Sitemap
{
    private static $sitemap = [];
    private static $root_url = '';

    public static function setItem($url, $priority = null)
    {
        //check url
        if (!$url) {
            return;
        }

        self::$sitemap[] = [
            'url'           => self::getRootUrl() . $url,
            'priority'      => $priority ?? 0.5
        ];
    }

    private static function getRootUrl()
    {
        if(self::$root_url)
        {
            return self::$root_url;
        }

        self::$root_url = Request::root();
        return self::$root_url;
    }

    public static function getSitemap()
    {
        return self::$sitemap;
    }
}