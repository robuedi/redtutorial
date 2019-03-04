<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 09/11/18
 * Time: 18:44
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}