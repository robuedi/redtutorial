<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'parent_id', 'id');
    }

    public function lessonSections()
    {
        return $this->hasMany(LessonSection::class, 'lesson_id', 'id');
    }
}