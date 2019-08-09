<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getPublicLessonsByMultipleChapters($chapters_ids)
    {
        if(!$chapters_ids)
        {
            return collect([]);
        }

        return self::whereIn('chapter_id', $chapters_ids)
            ->where('is_public', 1)
            ->whereNotNull('slug')
            ->orderBy('order_weight')
            ->get();
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

    public static function getLessonByCourseChapterLessonSlugs($course_slug, $chapter_slug, $lesson_slug)
    {
        return DB::table('courses as co')
            ->join('chapters as ch', 'co.id', '=', 'ch.course_id')
            ->join('lessons as le', 'ch.id', '=', 'le.chapter_id')
            ->where('co.slug', $course_slug)
            ->where('ch.slug', $chapter_slug)
            ->where('le.slug', $lesson_slug)
            ->where('co.status', 1)
            ->where('ch.is_public', 1)
            ->where('le.is_public', 1)
            ->selectRaw('co.id as course_id, co.name as course_name, co.slug as course_slag, ch.name as chapter_name, ch.slug as chapter_slag, le.chapter_id as chapter_id, le.order_weight as lesson_order, le.id as lesson_id, le.name as lesson_name, le.meta_description as lesson_meta_description')
            ->first();
    }

    public static function getNextLesson($lesson_order, $chapter_id)
    {
        return self::where('lessons.order_weight', '>', $lesson_order)
            ->where('lessons.chapter_id', $chapter_id)
            ->where('lessons.is_public',1)
            ->join('lessons_sections', 'lessons_sections.lesson_id', '=', 'lessons.id')
            ->where('lessons_sections.is_public', 1)
            ->orderBy('lessons.order_weight')
            ->first();
    }

    public static function getPublicLessonByChaptersIDs($chapters_ids)
    {
        return self::whereIn('chapter_id', $chapters_ids)
            ->where('is_public', 1)
            ->select('id', 'chapter_id')
            ->get();
    }
}