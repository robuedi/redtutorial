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

// Admin
Route::group(array('namespace' => 'admin', 'prefix' => config('app.admin_route')), function(){

    //Authentication
    Route::get('/', 'AuthenticationController@login');
    Route::post('/login', 'AuthenticationController@doLogin');
    Route::get('/logout', 'AuthenticationController@logout');

    //Require authentication
    Route::group(array('middleware' => 'admin_section'), function()
    {
        //Dashboard
        Route::get('/dashboard', 'DashboardController@index');

        //Courses
        Route::resource('/courses', 'CoursesController');

        //Chapters
        Route::resource('/chapters', 'ChaptersController');

        //Lessons
        Route::resource('/lessons', 'LessonsController');

        //Lessons Sections
        Route::get('/lesson-section/create/{parent_id}', 'LessonsSectionsController@create');
        Route::resource('/lesson-section', 'LessonsSectionsController');

        //Media Library
        Route::get('/media-library/', 'MediaLibraryController@index');
        Route::get('/media-library/add', 'MediaLibraryController@add');
        Route::get('/media-library/edit-add', 'MediaLibraryController@editAdd');
        Route::get('/media-library/add/{item_type}/{item_id}', 'MediaLibraryController@addToItem');
        Route::post('/media-library/upload', 'MediaLibraryController@upload');
        Route::post('/media-library/upload/{item_type}/{item_id}', 'MediaLibraryController@uploadToItem');
        Route::get('/media-library/delete/{id}', 'MediaLibraryController@delete');
        Route::get('/media-library/popup_browse', 'MediaLibraryController@popup_browse');
        Route::get('/media-library/popup_upload', 'MediaLibraryController@popup_upload');
        Route::get('/media-library/download/{id}', 'MediaLibraryController@download');
        Route::get('/media-library/ckeditor', 'MediaLibraryController@ckeditor');

        //User Profile
        Route::get('/user-profile', 'UserProfileController@edit');
        Route::post('/user-profile', 'UserProfileController@update');

        //User Management
        Route::get('/users-management/{type}', 'UsersManagementController@index');
        Route::get('/users-management/{type}/{id}/edit', 'UsersManagementController@edit');
        Route::get('/users-management/{type}/create', 'UsersManagementController@create');
        Route::post('/users-management', 'UsersManagementController@store');
        Route::put('/users-management/{id}', 'UsersManagementController@update');
        Route::delete('/users-management/{id}', 'UsersManagementController@destroy');
        Route::delete('/users-management/{id}/deactivate', 'UsersManagementController@toggleActivation');

        //Static Pages
        Route::resource('/static-pages', 'StaticPagesController');

        //Contact Messages
        Route::resource('/contact-messages', 'ContactMessagesController');
    });

});

//Home
Route::get('/', 'HomeController@index');

//Tutorials
Route::get('/tutorials', 'TutorialsController@index');
Route::get('/tutorial/{course_slag}', 'TutorialsController@showCourse');
Route::get('/tutorial/{course_slag}/{chapter_slag}', 'TutorialsController@showChapter');
Route::get('/tutorial/{course_slag}/{chapter_slag}/{lesson_slag}', 'TutorialsController@showLesson');

//Info pages
Route::get('/info/{url}', 'StaticPagesController@index');

//Contact Us
Route::get('/contact-us', 'ContactController@index');
Route::post('/contact-us', 'ContactController@saveMessage');

Route::get('/images/uploads/media_library/{year}/{month}/{file_name}', 'ImageController@showMediaImage')->where('year', '[0-9]{4}')->where('month', '[0-9]{2}');
Route::get('/images/assets/img/{file_name}', 'ImageController@showAssetImage');

