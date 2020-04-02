<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {

		$table->increments(id);
		$table->string('priority',4)->nullable()->default('NULL');
		$table->string('status',10)->nullable()->default('NULL');
		$table->integer('patients_id',11);
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary(['id','patients_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}