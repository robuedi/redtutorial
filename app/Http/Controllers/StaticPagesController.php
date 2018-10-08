<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 08/10/18
 * Time: 17:49
 */

namespace App\Http\Controllers;

use App\StaticPage;
use Illuminate\Support\Facades\View;

class StaticPagesController extends Controller
{
    public function index($url)
    {
        //get page
        $static_page = StaticPage::where('slug', $url)
                        ->where('is_public', 1)
                        ->first();

        //check if we have the page
        if(!$static_page)
            abort(404);

        return View::make('static_pages.index', [
            'page' => $static_page
        ]);
    }

}