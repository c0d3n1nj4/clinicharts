<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'visits';	
	
	protected $fillable = ['date_of_visit',
												'age',
												'temperature',
												'temperature_type',
												'weight',
												'weight_type',
												'height',
												'height_type',
												'complaints',
												'physician_findings',
												'treatment',
												'charge',
												'patients_id'
											];
}