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
}


