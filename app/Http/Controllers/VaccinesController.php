<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Vaccines;

class VaccinesController extends Controller
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
		$vaccines = Vaccines::get()->toArray();
		
	  return view('vaccines/index', [
			'vaccines' => $vaccines
		]);			
	}
	
	/**
   * Get all existing vaccines
	 * 
   * @params $request
	 * @return json
   */	
	public function get_existing_vaccines(Request $request)	{
		$vaccinesAll = Vaccines::get()->toArray();
		$output['data'] = [];
		
		foreach ($vaccinesAll as $va) {
			$actions = "<a href='#' class='btn btn-danger btn-delete-vaccine' data-id='".$va['id']."'>Delete</a>&nbsp;<a href='#' class='btn btn-info btn-update-vaccine' data-toggle='modal' data-target='#update-vaccine-modal' data-id='".$va['id']."' data-name='".$va['name']."'>Update</a>";
			
			$output['data'][] = [
				'name' => $va['name'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}		

	/**
	 * Insert new vaccine record
	 * 
	 * @return void
	 */
	public function insert_vaccine(Request $request)
	{
		Vaccines::create([ 'name' => $request->input('new-vaccine') ]);
		
		return back()->with('success', "New Vaccine Record saved.");						
	}		
	
	/**
	 * Update vaccine record
	 * 
	 * @return void
	 */
	public function update_vaccine(Request $request)
	{
		Vaccines::where('id', $request->input('id'))->update(['name' => $request->input('new-vaccine')]);
		
		return back()->with('success', "Vaccine Record updated.");	
	}		
	
	/**
	 * Delete vaccine record
	 * 
	 * @return void
	 */
	public function delete_vaccine(Request $request)
	{
		Vaccines::where('id', $request->input('id'))->delete();
	}		
}
