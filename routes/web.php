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

Route::get('/', function () {
    return view('welcome');
});


/* Admin */
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
    });

});
