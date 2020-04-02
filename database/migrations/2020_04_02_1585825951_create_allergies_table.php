<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergiesTable extends Migration
{
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {

		$table->integer('id',11);
		$table->string('description');
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');

        });
    }

    public function down()
    {
        Schema::dropIfExists('allergies');
    }
}