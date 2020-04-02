<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Patients;
use App\Appointments;

class AppointmentsController extends Controller
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
		$Patients = Patients::get()->toArray();
		
	  return view('appointments/index', [
			'Patients' => $Patients
		]);			
	}
	
	/**
   * Get patients name
	 * 
   * @params $request
	 * @return json
   */	
	public function get_patients_name(Request $request)	{
		$patientsAll = Patients::get()->toArray();
		$output = [];
		
		foreach ($patientsAll as $pa) {
			$name = $pa['first_name'].' '.$pa['middle_name'].' '.$pa['last_name'];
			$action = "<a href='#' class='btn btn-success btn-add-patient-appointment' data-id='".$pa['id']."' data-name='".$name."'>Insert</a>";
			$output['data'][] = [
				'name' => $name,
				'action' => $action
			];
		}	
		
		echo json_encode($output);	
	}
	
	/**
   * Get appointments
	 * 
   * @params $request
	 * @return json
   */	
	public function get_appointments(Request $request)	{
		$appointmentsAll = Appointments::get()->toArray();
		$data = [];
		
		foreach ($appointmentsAll as $aa) {
			$data[] = [
				#"title" => $this->get_patient_info_by_id($aa['patients_id']).' - '.$aa['event'],
				"id" => $aa['id'],
				"title" => $this->get_patient_name_by_id($aa['patients_id']),
				"start" => $aa['start'],
				"event" => $aa['event'],
				"end" => $aa['end'],
				"className" => $aa['importance']
			];
		}
		
		echo json_encode($data);	
	}	

	/**
	 * Insert new appointment
	 * 
	 * @return void
	 */
	public function insert_appointment(Request $request)
	{
		Appointments::create([
			'event' => $request->input('patient-name'),
			'start' => $request->input('start'),
			'end' => $request->input('end'),
			#'importance' => $request->get('importance'),
			'importance' => '',
			'patients_id' => $request->input('patient-id'),
		]);
		
		return back()->with('success', "New Appointment Record saved.");				
	}		
	
	/**
	 * Update appointment record
	 * 
	 * @return void
	 */
	public function update_appointment(Request $request)
	{
		Appointments::where('id', $request->input('data-id'))->update([
			'event' => $request->input('event-info'),
			'patients_id' => $request->input('patient-id')
		]);
		
		return back()->with('success', "Appointment Record updated.");	
	}		
	
	/**
	 * Update appointment (start|end) record after drag
	 * 
	 * @return void
	 */
	public function update_appointment_by_drag(Request $request)
	{
		Appointments::where('id', $request->input('id'))->update([
			'start' => $request->input('start'),
			'end' => $request->input('end')
		]);
		
		echo json_encode(['success'=>'Appointment Record updated.']);	
	}	
	
	/**
	 * Delete appointment record
	 * 
	 * @return void
	 */
	public function delete_appointment(Request $request)
	{
		Appointments::where('id', $request->input('data-id'))->delete();
		
		return back()->with('success', "Appointment Record deleted.");
	}		
	
	/**
	 * Get patient name by id
	 * 
	 * @return void
	 */	
	private function get_patient_name_by_id($id) {
		$dataArr = Patients::select('first_name', 'middle_name', 'last_name')->where('id', $id)->get()->toArray();
		
		return $dataArr[0]['first_name'].' '.$dataArr[0]['middle_name'].' '.$dataArr[0]['last_name'];
	}	
}
