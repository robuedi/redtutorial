<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 25/02/18
 * Time: 18:23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table      = 'logins';
    protected $primaryKey = 'login_id';
    public $timestamps    = false;
}