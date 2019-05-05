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
}

