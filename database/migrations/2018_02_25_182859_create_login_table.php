<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('logins');

        Schema::create('logins', function(Blueprint $table)
        {
            $table->increments('login_id');
            $table->integer('user_id')->index();
            $table->string('login_ip', 30)->index();
            $table->dateTime('login_date');
            $table->tinyInteger('login_success')->default(0);
            $table->dateTime('logout_date')->nullable();
            $table->string('browser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logins');
    }
}
