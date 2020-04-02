<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BloodTypes;

class BloodTypesController extends Controller
{
	/**
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the landing page
	 *
	 * @return array
	 */
	public function index()
	{
		$BloodTypes = BloodTypes::get()->toArray();
		
	  return view('blood-types/index', [
			'BloodTypes' => $BloodTypes
		]);			
	}
	
	/**
   * Get all existing blood types
	 * 
   * @params $request
	 * @return json
   */	
	public function get_existing_blood_types(Request $request)	{
		$bloodTypesAll = BloodTypes::get()->toArray();
		$output = [];
		
		foreach ($bloodTypesAll as $bta) {
			$actions = "<a href='#' class='btn btn-danger btn-delete-blood-type' data-id='".$bta['id']."'>Delete</a>&nbsp;<a href='#' class='btn btn-info btn-update-blood-type' data-toggle='modal' data-target='#update-blood-type-modal' data-id='".$bta['id']."' data-blood-type='".$bta['blood_type']."'>Update</a>";
			
			$output['data'][] = [
				'blood_type' => $bta['blood_type'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}		

	/**
	 * Insert new blood type record
	 * 
	 * @return void
	 */
	public function insert_blood_type(Request $request)
	{
		BloodTypes::create([
										'blood_type' => $request->input('new-blood-type')
									]);
		
		return back()->with('success', "New Blood Type Record saved.");						
	}		
	
	/**
	 * Update blood type record
	 * 
	 * @return void
	 */
	public function update_blood_type(Request $request)
	{
		BloodTypes::where('id', $request->input('id'))->update(['blood_type' => $request->input('new-blood-type')]);
		
		return back()->with('success', "Blood Type Record updated.");	
	}		
	
	/**
	 * Delete blood type record
	 * 
	 * @return void
	 */
	public function delete_blood_type(Request $request)
	{
		BloodTypes::where('id', $request->input('id'))->delete();
	}		
}
