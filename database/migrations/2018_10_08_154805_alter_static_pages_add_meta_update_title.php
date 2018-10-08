<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStaticPagesAddMetaUpdateTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('static_pages', function($table) {
            $table->dropColumn('title');
            $table->string('head_title', 255)->after('heading');
            $table->string('meta_description', 300)->after('head_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('static_pages', function($table) {
            $table->string('title', 255);
            $table->dropColumn('head_title');
            $table->dropColumn('meta_description');
        });
    }
}
