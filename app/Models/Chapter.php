<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use URL;

class Chapter extends Model
{
    protected $table = 'chapters';

    public function course()
    {
        return $this->belongsTo(Course::class, 'parent_id','id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'parent_id', 'id');
    }
}

