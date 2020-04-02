<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immunizations extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'immunizations';	
	
	protected $fillable = [	'vaccines',
													'first',
													'second',
													'third',
													'booster_one',
													'booster_two',
													'booster_three',
													'other_vaccine',
													'reaction',
													'patients_id',
												];
}