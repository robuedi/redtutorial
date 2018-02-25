<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 25/02/18
 * Time: 21:01
 */

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use View;

class ListingController extends Controller
{
    //some general setting for controllers with listing, edit ... with REST
    protected $section_name_sg;
    protected $section_name_pl;

    public function __construct ($section_name_sg, $section_name_pl){
        $this->section_name_sg = $section_name_sg;
        $this->section_name_pl = $section_name_pl;
        View::share('section_obj_name_sg', $section_name_sg);
        View::share('section_obj_name_pl', $section_name_pl);
    }
}