<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 09/11/18
 * Time: 18:44
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class LessonSection extends Model
{
    protected $table = 'lessons_sections';

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'lesson_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(LessonSectionOption::class, 'lesson_section_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'users_to_lessons_sections', 'lesson_section_id', 'user_id');
    }

    public static function getPublicLessonsSectionsByLessonsIDs($lessons_ids)
    {
        return self::whereIn('lesson_id', $lessons_ids)
            ->where('is_public', 1)
            ->select('id', 'lesson_id')
            ->where('type', 'quiz')
            ->get()
            ->groupBy('lesson_id');
    }
}