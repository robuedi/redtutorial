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

    public function publicLessonSections()
    {
        return $this->lessonSections()->where('is_public',1);
    }

    public function scopePublicLessons($query)
    {
        return $query->where('is_public', 1)
            ->whereNotNull('slug')
            ->orderBy('order_weight');
    }

    public static function getPublicLessonsByChapter($chapter_id)
    {
        if(!$chapter_id)
        {
            return collect([]);
        }

        return self::where('chapter_id', $chapter_id)
            ->where('is_public', 1)
            ->whereNotNull('slug')
            ->orderBy('order_weight')
            ->get();
    }
}