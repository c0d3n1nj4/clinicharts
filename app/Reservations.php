<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'reservations';	
	
	protected $fillable = ['priority',
												'status',
												'patients_id'
											];	
}