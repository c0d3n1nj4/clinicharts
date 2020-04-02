<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {

		$table->increments(id);
		$table->string('first_name',100)->nullable()->default('NULL');
		$table->string('middle_name',100)->nullable()->default('NULL');
		$table->string('last_name',100)->nullable()->default('NULL');
		$table->string('gender',1)->nullable()->default('NULL');
		$table->date('birth_date')->nullable()->default('NULL');
		$table->string('address')->nullable()->default('NULL');
		$table->string('school',100)->nullable()->default('NULL');
		$table->string('father_name',100)->nullable()->default('NULL');
		$table->string('mother_name',100)->nullable()->default('NULL');
		$table->string('contact_num',50)->nullable()->default('NULL');
		$table->integer('blood_types_id',11)->nullable()->default('NULL');
		$table->integer('insurance_id',11)->nullable()->default('NULL');
		$table->string('picture',50)->nullable()->default('NULL');
		$table->datetime('deleted_at')->nullable()->default('NULL');
		$table->datetime('created_at')->nullable()->default('NULL');
		$table->datetime('updated_at')->nullable()->default('NULL');
		$table->primary('id');

        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}