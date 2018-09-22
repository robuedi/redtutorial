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

        //Media Library
        Route::get('/media-library/', 'MediaLibraryController@index');
        Route::get('/media-library/add', 'MediaLibraryController@add');
        Route::post('/media-library/upload', 'MediaLibraryController@upload');
        Route::get('/media-library/delete/{id}', 'MediaLibraryController@delete');
        Route::get('/media-library/popup_browse', 'MediaLibraryController@popup_browse');
        Route::get('/media-library/popup_upload', 'MediaLibraryController@popup_upload');
        Route::get('/media-library/download/{id}', 'MediaLibraryController@download');
        Route::get('/media-library/ckeditor', 'MediaLibraryController@ckeditor');

        //User Profile
        Route::get('/user-profile', 'UserProfileController@edit');
        Route::post('/user-profile', 'UserProfileController@update');

        //Configuration - Theme
        Route::get('/configuration/theme', 'ConfigurationController@editUserTheme');

        //User Management
        Route::resource('/user-management', 'UsersManagement');

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