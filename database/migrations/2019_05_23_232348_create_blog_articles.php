<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('meta_description')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('is_public')->default(0)->index();
            $table->tinyInteger('is_draft')->default(1);
            $table->string('slug', 100)->nullable();
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
        Schema::dropIfExists('blog_articles');
    }
}
