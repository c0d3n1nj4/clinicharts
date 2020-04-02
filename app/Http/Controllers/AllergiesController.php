<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Allergies;

class AllergiesController extends Controller
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
		$Allergies = Allergies::get()->toArray();
		
	  return view('allergies/index', [
			'Allergies' => $Allergies
		]);			
	}
	
	/**
   * Get all existing allergies
	 * 
   * @params $request
	 * @return json
   */	
	public function get_existing_allergies(Request $request)	{
		$allergiesAll = Allergies::get()->toArray();
		$output = [];
		
		foreach ($allergiesAll as $aa) {
			$actions = "<a href='#' class='btn btn-danger btn-delete-allergy' data-id='".$aa['id']."'>Delete</a>&nbsp;<a href='#' class='btn btn-info btn-update-allergy' data-toggle='modal' data-target='#update-allergy-modal' data-id='".$aa['id']."' data-allergy='".$aa['description']."'>Update</a>";
			
			$output['data'][] = [
				'description' => $aa['description'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}		

	/**
	 * Insert new allergy record
	 * 
	 * @return void
	 */
	public function insert_allergy(Request $request)
	{
		Allergies::create([
										'description' => $request->input('new-allergy')
									]);
		
		return back()->with('success', "New Allergy Record saved.");						
	}		
	
	/**
	 * Update allergy record
	 * 
	 * @return void
	 */
	public function update_allergy(Request $request)
	{
		Allergies::where('id', $request->input('id'))->update(['description' => $request->input('new-allergy')]);
		
		return back()->with('success', "Allergy Record updated.");	
	}		
	
	/**
	 * Delete allergy record
	 * 
	 * @return void
	 */
	public function delete_allergy(Request $request)
	{
		Allergies::where('id', $request->input('id'))->delete();
	}		
}
