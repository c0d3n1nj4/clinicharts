<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccines extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'vaccines';	
	
	protected $fillable = ['name'];
}