<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesToUserAddIsDeletedIsFlagedColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_messages_to_users', function($table) {
            $table->tinyInteger('is_flagged')->default(0)->after('is_read');
            $table->tinyInteger('is_deleted')->default(0)->after('is_flagged');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_messages_to_users', function($table) {
            $table->dropColumn('is_flagged');
            $table->dropColumn('is_deleted');
        });
    }
}
