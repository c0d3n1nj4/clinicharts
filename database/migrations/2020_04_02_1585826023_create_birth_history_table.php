<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('birth_history', function (Blueprint $table) {

		$table->increments(id);
		$table->integer('preterm',1)->default('0');
		$table->integer('full_term',1)->default('0');
		$table->integer('nsd',1)->default('0');
		$table->integer('cs',1)->default('0');
		$table->string('birth_weight',50)->nullable()->default('NULL');
		$table->string('bw_percentile',10)->nullable()->default('NULL');
		$table->string('birth_head_circumference',50)->nullable()->default('NULL');
		$table->string('bhc_percentile',10)->nullable()->default('NULL');
		$table->string('birth_length',50)->nullable()->default('NULL');
		$table->string('bl_percentile',10)->nullable()->default('NULL');
		$table->string('birth_chest_circumference',50)->nullable()->default('NULL');
		$table->string('bcc_percentile',10)->nullable()->default('NULL');
		$table->string('birth_abdominal_circumference',50)->nullable()->default('NULL');
		$table->integer('patients_id',11);
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary(['id','patients_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('birth_history');
    }
}