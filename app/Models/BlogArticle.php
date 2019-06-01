<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    protected $table      = 'blog_articles';


    public static function getPublicArticles()
    {
        return self::where('is_public', 1)
            ->where('title', '<>', '')
            ->where('content', '<>', '')
            ->where('slug', '<>', '')
            ->get();
    }
}