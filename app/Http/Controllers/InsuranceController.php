<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Insurance;

class InsuranceController extends Controller
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
		$Insurance = Insurance::get()->toArray();
		
	  return view('insurance/index', [
			'Insurance' => $Insurance
		]);			
	}
	
	/**
   * Get all existing insurance
	 * 
   * @params $request
	 * @return json
   */	
	public function get_existing_insurance(Request $request)	{
		$insuranceAll = Insurance::get()->toArray();
		$output = [];
		
		foreach ($insuranceAll as $ia) {
			$actions = "<a href='#' class='btn btn-danger btn-delete-insurance' data-id='".$ia['id']."'>Delete</a>&nbsp;<a href='#' class='btn btn-info btn-update-insurance' data-toggle='modal' data-target='#update-insurance-modal' data-id='".$ia['id']."' data-insurance-name='".$ia['name']."'>Edit</a>";
			
			$output['data'][] = [
				'name' => $ia['name'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}		

	/**
	 * Insert new insurance record
	 * 
	 * @return void
	 */
	public function insert_insurance(Request $request)
	{
		Insurance::create([
										'name' => $request->input('new-insurance')
									]);
		
		return back()->with('success', "New Insurance Record saved.");						
	}		
	
	/**
	 * Update insurance record
	 * 
	 * @return void
	 */
	public function update_insurance(Request $request)
	{
		Insurance::where('id', $request->input('id'))->update(['name' => $request->input('insurance-name')]);
		
		return back()->with('success', "Insurance Record updated.");	
	}		
	
	/**
	 * Delete insurance record
	 * 
	 * @return void
	 */
	public function delete_insurance(Request $request)
	{
		Insurance::where('id', $request->input('id'))->delete();
	}		
}
