<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/welcome', function () {
    return view('welcome');
});


// Admin
Route::group(array('namespace' => 'admin', 'prefix' => 'admin'), function(){

    //Authentication
    Route::get('/', 'AuthenticationController@login');
    Route::post('/login', 'AuthenticationController@doLogin');
    Route::get('/logout', 'AuthenticationController@logout');

    //Require authentication
    Route::group(array('middleware' => 'admin_section'), function()
    {
        Route::get('/dashboard', 'DashboardController@index');
        Route::resource('/courses', 'CoursesController');
        Route::resource('/chapters', 'ChaptersController');
        Route::resource('/lessons', 'LessonsController');
    });

});

Route::get('/testing', 'TestingController@index');

/*

Route::get('/html', function() {
    return App::make('CoursesController')->course('html');
});
*/

Route::get('/{section_slug}', function($section_slug) {

    $sections_slugs = \App\Models\Testing::getSectionsURL();

    if ( in_array($section_slug, $sections_slugs) ){
        $controller = new \App\Http\Controllers\CoursesController();
        return $controller->getSection($section_slug);
    }

});


Route::get('/{section_slug}/{course}', function($section_slug, $course) {

    $courses_slugs = \App\Models\Testing::getCoursesURL();

    if ( in_array($course, $courses_slugs) ){
        $controller = new \App\Http\Controllers\CoursesController();
        return $controller->getCourse($course);
    }


//    else{
//        Section::get()
//         if  slug = section {
//
//            return App::make('CoursesController')->section($section)
//        };
//    }

});


/*
 * OBS
 * encode white spaces url, encode urls
 *
 * */

/*
 * learn-html-tutorial/beginners/heading-page
 *
 *
 *
 *
 * */