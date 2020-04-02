<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinesTable extends Migration
{
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {

		$table->increments(id);
		$table->string('name')->nullable()->default('NULL');
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccines');
    }
}