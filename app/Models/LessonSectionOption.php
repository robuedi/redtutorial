<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 09/11/18
 * Time: 21:57
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonSectionOption extends Model
{
    protected $table = 'lessons_sections_options';

    public function lessonSection()
    {
        return $this->belongsTo(LessonSection::class, 'lesson_section_id', 'id')->whereType('quiz');
    }
}


