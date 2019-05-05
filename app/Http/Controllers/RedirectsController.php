<?php


namespace App\Http\Controllers;


class RedirectsController
{

}
//Old Redirect Tutorials
Route::get('/{tutorial_label}/{course_slag}', 'RedirectsController@showChapters')->where('tutorial_label', '^tutorial$');
Route::get('/{tutorial_label}/{course_slag}/{chapter_slag}', 'RedirectsController@showLessons')->where('tutorial_label', '^tutorial$');
Route::get('/{tutorial_label}/{course_slag}/{chapter_slag}/{lesson_slag}', 'RedirectsController@showLessonContent')->where('tutorial_label', '^tutorial$');
