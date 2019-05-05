<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use URL;
use Illuminate\Support\Collection;
use Sentinel;

class Chapter extends Model
{
    protected $table = 'chapters';

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id','id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id', 'id');
    }

    public function  publicLessons()
    {
        return $this->lessons()->publicLessons();
    }

    public function scopePublicChapters($query)
    {
        return $query->where('is_public', 1)
            ->whereNotNull('slug')
            ->orderBy('order_weight');
    }

    public static function getChaptersByCourseID($course_id)
    {
        return self::join('lessons', 'chapters.id', '=', 'lessons.chapter_id')
            ->where('chapters.course_id', $course_id)
            ->where('chapters.is_public', 1)
            ->where('lessons.is_public', 1)
            ->whereNotNull('chapters.slug')
            ->groupBy('chapters.id')
            ->selectRaw('chapters.id, chapters.name, chapters.slug, COUNT(lessons.id) AS lessons_number')
            ->orderBy('chapters.order_weight')
            ->get();
    }
}

