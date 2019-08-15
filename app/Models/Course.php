<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Course extends Model
{
    protected $table = 'courses';

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id', 'id');
    }

    public function publicChapters()
    {
        return $this->chapters()->publicChapters();
    }

    public static function getPageNotFoundActiveCourses()
    {
        return Course::publicCourses()
            ->select('name', 'slug')
            ->get();
    }

    public function scopePublicCourses($query)
    {
        return $query->where('status', 1)
                        ->whereNotNull('slug')
                        ->orderBy('order_weight');
    }

    public static function getPublicCourses()
    {
        return self::publicCourses()->get();
    }
}


