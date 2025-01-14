<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lessonsSections()
    {
        return $this->belongsToMany(LessonSection::class,'users_to_lessons_sections', 'user_id', 'lesson_section_id');
    }

}
