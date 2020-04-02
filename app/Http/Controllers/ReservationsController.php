<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Patients;
use App\BloodTypes;
use App\Insurance;
use App\Reservations;

class ReservationsController extends Controller
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
	  return view('reservations/index');			
	}
	
	/**
   * Get all reservations
	 * 
   * @params $request
	 * @return json
   */	
	public function get_all_reservations() {
		$output = [];
		
		$reservationsAll = DB::select(
												DB::raw("SELECT patients.first_name, patients.middle_name, patients.last_name, patients.insurance_id, reservations.id, reservations.priority, reservations.status, reservations.updated_at 
												FROM patients, reservations 
												WHERE reservations.patients_id = patients.id ORDER BY reservations.updated_at DESC")
											);	
											
		foreach ($reservationsAll as $ra) {
			$actions = "<a href='#' class='btn btn-danger btn-delete-reservation' data-id='".$ra->id."'>Delete</a>";
			
			$output['data'][] = [
				'priority' => $ra->priority, 
				'first_name' => $ra->first_name,
				'middle_name' => $ra->middle_name,
				'last_name' => $ra->last_name,
				'status' => $ra->status,
				'insurance' => Helper::get_insurance($ra->insurance_id),
				'updated_at' => $ra->updated_at,
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}	
	
	/**
   * Get today's reservations
	 * 
   * @params $request
	 * @return json
   */	
	public function get_today_reservations(Request $request)	{
		$now = date('Y-m-d');
		$output['data'] = [];
		
		$reservationsTodayArr = DB::select(
															DB::raw("SELECT patients.first_name, patients.middle_name, patients.last_name, patients.insurance_id, reservations.id, reservations.priority, reservations.status
															FROM patients, reservations
															WHERE DATE_FORMAT(reservations.updated_at, '%Y-%m-%d') = '".$now."' 
															AND reservations.patients_id = patients.id	
															ORDER BY reservations.priority ASC")
														);	
		
		foreach ($reservationsTodayArr as $rta) {
			$btnUpdate = ($rta->status=='Waiting') ? 
				"<a href='#' class='btn btn-primary btn-update-reservation' data-id='".$rta->id."' data-status='Waiting'>Mark as Attended</a>"
				: "<button class='btn btn-success btn-update-reservation' data-id='".$rta->id."' data-status='Attended' disabled>Attended</button>";			
			
			$actions = "<a href='#' class='btn btn-danger btn-delete-reservation' data-id='".$rta->id."'>Delete</a>&nbsp;$btnUpdate";
			
			$output['data'][] = [
				'priority' => $rta->priority, 
				'first_name' => $rta->first_name,
				'middle_name' => $rta->middle_name,
				'last_name' => $rta->last_name,
				'status' => $rta->status,
				'insurance' => Helper::get_insurance($rta->insurance_id),
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);	
	}		

	/**
	 * Reserve Patient
	 *
	 * @return array
	 */
	public function reserve_patient()
	{
		$Patients = Patients::get()->toArray();
		$BloodTypes = BloodTypes::get()->toArray();
		$Insurance = Insurance::get()->toArray();
		
	  return view('patients/index', [
			'Patients' => $Patients,
			'BloodTypes' => $BloodTypes,
			'Insurance' => $Insurance,
			'reserve' => 1
		]);			
	}	

	/**
	 * Insert new reservation record
	 * 
	 * @return void
	 */
	public function insert_reservation(Request $request)
	{
		#Reservations::truncate();
		$now = date('Y-m-d');
		$maxPriorityArr = DB::select(
												DB::raw("SELECT MAX(priority) AS max FROM `reservations` WHERE DATE_FORMAT(updated_at, '%Y-%m-%d') = '$now'")
											);	
		$priority = (!empty($maxPriorityArr)) ? ($maxPriorityArr[0]->max) + 1 : 1;

		Reservations::create([
										'priority' => $priority,
										'status' => 'Waiting',
										'patients_id' => $request->input('id'),
									]);
		
		return back()->with('success', "New Patient Reservation saved.");						
	}		
	
	/**
	 * Update reservation
	 * 
	 * @return void
	 */
	public function update_reservation(Request $request)
	{
		$newStatus = ($request->input('status')=='Waiting') ? 'Attended' : 'Waiting'; 
		Reservations::where('id', $request->input('id'))->update(['status' => $newStatus]);
		
		return back()->with('success', "Patient Reservation updated.");	
	}		

	/**
	 * Delete reservation
	 * 
	 * @return void
	 */
	public function delete_reservation(Request $request)
	{
		Reservations::where('id', $request->input('id'))->delete(); 				
	}		
}