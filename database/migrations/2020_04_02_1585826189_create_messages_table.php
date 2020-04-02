<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

		$table->increments(message_id);
		$table->string('from',45)->nullable()->default('NULL');
		$table->string('message')->nullable()->default('NULL');
		$table->datetime('date_sent')->nullable()->default('NULL');
		$table->integer('users_user_id',11);
		$table->primary(['message_id','users_user_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}