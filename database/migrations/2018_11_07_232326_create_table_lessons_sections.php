<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLessonsSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->index();
            $table->string('name', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('type', 255)->index();
            $table->tinyInteger('is_public')->default(0)->index();
            $table->tinyInteger('is_draft')->default(1)->index();
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
