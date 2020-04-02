<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {

		$table->increments(chat_id);
		$table->string('name',45)->nullable()->default('NULL');
		$table->string('message')->nullable()->default('NULL');
		$table->integer('date_sent',11)->nullable()->default('NULL');
		$table->primary('chat_id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('chat');
    }
}