<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLessonSectionsOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_sections_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_section_id')->index();
            $table->string('label', 255);
            $table->string('type', 255);
            $table->tinyInteger('is_valid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
