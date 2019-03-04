<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterChaptersLessonsParentIdToCourseIdChapterId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapters', function(Blueprint $table) {
            $table->renameColumn('parent_id', 'course_id');
        });


        Schema::table('lessons', function(Blueprint $table) {
            $table->renameColumn('parent_id', 'chapter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapters', function(Blueprint $table) {
            $table->renameColumn('course_id', 'parent_id');
        });


        Schema::table('lessons', function(Blueprint $table) {
            $table->renameColumn('chapter_id', 'parent_id');
        });
    }
}
