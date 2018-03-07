<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function(Blueprint $table)
        {
            $table->increments('id')->index();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->double('order_weight', 6, 2)->index();
            $table->tinyInteger('is_public')->default(0)->index();
            $table->string('slug', 255)->unique()->index();
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
        Schema::drop('courses');
    }
}
