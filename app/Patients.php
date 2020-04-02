<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'patients';	
	
	protected $fillable = ['first_name',
												'middle_name',
												'last_name',
												'gender',
												'birth_date',
												'address',
												'school',
												'father_name',
												'mother_name',
												'contact_num',
												'blood_types_id',
												'insurance_id',
												'picture'
											];
}