<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(array('namespace' => 'Api', 'prefix' => 'v1'), function(){
    Route::post('/tutorial/{course_slag}/{chapter_slag}/{lesson_slag}/{quiz_id}', 'TutorialsLessonsQuizzesController@validateQuiz');
});