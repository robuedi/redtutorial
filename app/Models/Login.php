<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table      = 'logins';
    protected $primaryKey = 'login_id';
    public $timestamps    = false;
}