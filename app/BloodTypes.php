<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodTypes extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'blood_types';	
	
	protected $fillable = ['blood_type'];
}