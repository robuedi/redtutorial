<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 04/02/18
 * Time: 14:25
 */

namespace App\Http\Controllers\admin;

use View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    function index(){
        return View::make('admin.dashboard.index');
    }
}