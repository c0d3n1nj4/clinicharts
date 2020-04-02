<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {

		$table->increments(id);
		$table->date('date_of_visit')->nullable()->default('NULL');
		$table->integer('age',11)->nullable()->default('NULL');
		$table->string('temperature',10)->nullable()->default('NULL');
		$table->string('temperature_type',1)->nullable()->default('NULL');
		$table->string('weight',10)->nullable()->default('NULL');
		$table->string('weight_type',10)->nullable()->default('NULL');
		$table->string('height',10)->nullable()->default('NULL');
		$table->string('height_type',10)->nullable()->default('NULL');
		$table->string('complaints')->nullable()->default('NULL');
		$table->string('physician_findings')->nullable()->default('NULL');
		$table->string('treatment')->nullable()->default('NULL');
		$table->float('charge')->nullable()->default('NULL');
		$table->integer('patients_id',11);
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary(['id','patients_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
}