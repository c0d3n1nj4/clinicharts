<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->increments(id)->unsigned();
		$table->string('username');
		$table->string('email',100);
		$table->string('password');
		$table->string('firstname')->nullable()->default('NULL');
		$table->string('lastname')->nullable()->default('NULL');
		$table->integer('admin',1)->default('0');
		$table->integer('logged',1)->nullable()->default('NULL');
		$table->string('remember_token',100)->nullable()->default('NULL');
		$table->timestamp('deleted_at')->nullable()->default('NULL');
		$table->timestamp('created_at')->nullable()->default('NULL');
		$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->softDeletes();
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}