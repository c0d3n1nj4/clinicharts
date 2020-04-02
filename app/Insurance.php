<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'insurance';	
	
	protected $fillable = ['name'];
}