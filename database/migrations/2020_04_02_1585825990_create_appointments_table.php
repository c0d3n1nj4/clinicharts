<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

		$table->increments(id);
		$table->text('event');
		$table->string('start',100)->nullable()->default('NULL');
		$table->string('end',100)->nullable()->default('NULL');
		$table->string('importance',20)->nullable()->default('NULL');
		$table->integer('patients_id',11)->nullable()->default('NULL');
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}