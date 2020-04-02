<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmunizationsTable extends Migration
{
    public function up()
    {
        Schema::create('immunizations', function (Blueprint $table) {

		$table->increments(id);
		$table->string('vaccines')->nullable()->default('NULL');
		$table->date('first')->nullable()->default('NULL');
		$table->date('second')->nullable()->default('NULL');
		$table->date('third')->nullable()->default('NULL');
		$table->date('booster_one')->nullable()->default('NULL');
		$table->date('booster_two')->nullable()->default('NULL');
		$table->date('booster_three')->nullable()->default('NULL');
		$table->string('other_vaccine')->nullable()->default('NULL');
		$table->string('reaction')->nullable()->default('NULL');
		$table->integer('patients_id',11);
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary(['id','patients_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('immunizations');
    }
}