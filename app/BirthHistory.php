<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirthHistory extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'birth_history';	
	
	protected $fillable = [	'preterm',
													'full_term',
													'nsd',
													'cs',
													'birth_weight',
													'bw_percentile',
													'birth_head_circumference',
													'bhc_percentile',
													'birth_length',
													'bl_percentile',
													'birth_chest_circumference',
													'bcc_percentile',
													'birth_abdominal_circumference',
													'patients_id'
												];
}