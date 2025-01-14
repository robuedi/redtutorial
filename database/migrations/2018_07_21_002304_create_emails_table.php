<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('from_address',255)->index();
            $table->text('to_address');
            $table->text('cc_address')->nullable();
            $table->text('bcc_address')->nullable();
            $table->string('email_subject',255);
            $table->longtext('email_content');
            $table->longText('email_attachment')->nullable();
            $table->enum('sent_success', array('yes', 'no'));
            $table->dateTime('sent_date');
            $table->integer('retries');
            $table->text('mailer_internal_id')->nullable();
            $table->text('mailer_last_response')->nullable();
            $table->dateTime('skip_check_date')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
