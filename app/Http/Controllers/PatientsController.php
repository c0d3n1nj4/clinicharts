<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Patients;
use App\BirthHistory;
use App\Immunizations;
use App\BloodTypes;
use App\Insurance;
use App\Visits;
use App\Vaccines;

class PatientsController extends Controller
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
		$BloodTypes = BloodTypes::get()->toArray();
		$Insurance = Insurance::get()->toArray();
		
	  return view('patients/index', [
			'Patients' => $Patients,
			'BloodTypes' => $BloodTypes,
			'Insurance' => $Insurance,
			'reserve' => 0
		]);			
	}
	
	/**
   * Get all existing patients
	 * 
   * @params $request
	 * @return json
   */	
	public function get_existing_patients(Request $request)	{
		$patientsAll = Patients::get()->toArray();
		$output['data'] = [];
		$now = date('Y-m-d');
		
		#$logFile = '/homepages/29/d429450450/htdocs/cms/public/debug.log';
		#file_put_contents($logFile, $request->input('showReserveButton'));
		
		foreach ($patientsAll as $pa) {
			
			$reservedArr = DB::select(
													DB::raw("SELECT status FROM `reservations` WHERE DATE_FORMAT(updated_at, '%Y-%m-%d') = '$now' AND patients_id=".$pa['id'].""));		
			
			#$ausCaseLodgementDateCreate = date_create(request()->input('aus-case-lodgement-date'));
			#$ausCaseLodgementDate = date_format($ausCaseLodgementDateCreate, "d/m/Y");			
			
			
			$avatar = "<img src='".asset("public/avatars/".$pa['picture']."")."' width='30' height='30' />";
			$name = $pa['first_name'].' '.$pa['middle_name'].' '.$pa['last_name'];
			
			$btnReserve = (!empty($reservedArr)) ? "Already Reserved" 
			: "<a href='#' class='btn btn-primary btn-reserve-patient' data-id='".$pa['id']."'>Reserve</a>";	
			
			$actions = ($request->input('showReserveButton')!=null && $request->input('showReserveButton')) 
			? "$btnReserve" 
			: "<a href='#' class='btn btn-danger btn-delete-patient' data-id='".$pa['id']."'>Delete</a>&nbsp;
			<a href='#' class='btn btn-info btn-edit-patient' data-toggle='modal' data-target='#edit-patient-modal' 
			data-id='".$pa['id']."'
			data-fname='".$pa['first_name']."'
			data-mname='".$pa['middle_name']."'
			data-lname='".$pa['last_name']."'
			data-gender='".$pa['gender']."'
			data-bdate='".$pa['birth_date']."'
			data-address='".$pa['address']."'
			data-school='".$pa['school']."'
			data-father-name='".$pa['father_name']."'
			data-mother-name='".$pa['mother_name']."'
			data-contact-num='".$pa['contact_num']."'
			data-blood-types-id='".$pa['blood_types_id']."'
			data-insurance-id='".$pa['insurance_id']."'>Edit</a>&nbsp;
			<a href='/patient-records/".$pa['id']."' class='btn btn-primary btn-patient-records'>Records</a>";
			
			$output['data'][] = [
				'avatar' => $avatar, 
				'name' => $name, 
				'gender' => $pa['gender'],
				'birth_date' => $pa['birth_date'],
				'address' => $pa['address'],
				'school' => $pa['school'],
				'father_name' => $pa['father_name'],
				'mother_name' => $pa['mother_name'],
				'contact_num' => $pa['contact_num'],
				'blood_type' => Helper::get_blood_type($pa['blood_types_id']),
				'insurance' => Helper::get_insurance($pa['insurance_id']),
				'actions' => $actions				
			];
			
			unset($reservedArr); #Reset
		}	
		
		echo json_encode($output);	
	}		
	
	/**
	 * Show patient records
	 *
	 * @return array
	 */
	public function patient_records($id)
	{
		$patient = Patients::where('id', $id)->get()->toArray();
		$birthHistory = BirthHistory::where('patients_id', $id)->get()->toArray();
		$Vaccines = Vaccines::get()->toArray();
		
		#dd($birthHistory);
		if (empty($birthHistory)) {
			$birthHistory['has_record'] = 0;
			$birthHistory[0]['id'] = $id;
			$birthHistory[0]['preterm'] = 0;
			$birthHistory[0]['full_term'] = 0;
			$birthHistory[0]['nsd'] = 0;
			$birthHistory[0]['cs'] = 0;
			$birthHistory[0]['birth_weight'] = '';
			$birthHistory[0]['bw_percentile'] = '';
			$birthHistory[0]['birth_head_circumference'] = '';
			$birthHistory[0]['bhc_percentile'] = '';
			$birthHistory[0]['birth_length'] = '';
			$birthHistory[0]['bl_percentile'] = '';
			$birthHistory[0]['birth_chest_circumference'] = '';
			$birthHistory[0]['bcc_percentile'] = '';
			$birthHistory[0]['birth_abdominal_circumference'] = '';
		} else {
			$birthHistory['has_record'] = 1;
		}	
		
	  return view('patients/records', [
			'patient' => $patient,
			'bloodType' => Helper::get_blood_type($patient[0]['blood_types_id']),
			'insurance' => Helper::get_insurance($patient[0]['insurance_id']),
			'birthHistory' => $birthHistory,
			'Vaccines' => $Vaccines
		]);			
	}	
	
	/**
	 * Insert new patient record
	 * 
	 * @return void
	 */
	public function insert_patient(Request $request)
	{
		#Patients::truncate();
		if ($request->hasFile('patient-picture')){
			$fileName = $request->file('patient-picture')->getClientOriginalName(); # Get original file name

			$request->file('patient-picture')->move(public_path('/avatars'), $fileName);
		} else {
			$fileName = ($request->input('gender')=='M') ? 'male.jpg' : 'female.jpg';
		}		
		
		Patients::create([
										'first_name' => $request->input('first_name'),
										'middle_name' => $request->input('middle_name'),
										'last_name' => $request->input('last_name'),
										'gender' => $request->input('gender'),
										'birth_date' => $request->input('birth_date'),
										'address' => $request->input('address'),
										'school' => $request->input('school'),
										'father_name' => $request->input('father_name'),
										'mother_name' => $request->input('mother_name'),
										'contact_num' => $request->input('contact_num'),								
										'blood_types_id' => $request->input('blood_types_id'),								
										'insurance_id' => $request->input('insurance_id'),								
										'picture' => $fileName	
									]);
		
		return back()->with('success', "New Patient Record saved.");						
	}		
	
	/**
	 * Update patient record
	 * 
	 * @return void
	 */
	public function update_patient(Request $request)
	{
		if ($request->hasFile('patient-picture')){
			$fileName = $request->file('patient-picture')->getClientOriginalName(); # Get original file name

			$request->file('patient-picture')->move(public_path('/avatars'), $fileName);
		} else {
			$picture = Patients::select('picture')
												->where('id', $request->input('id'))
												->get()
												->toArray();
			$fileName = $picture[0]['picture'];
		}		
		
		Patients::where('id', $request->input('id'))->update([
										'first_name' => $request->input('first_name'),
										'middle_name' => $request->input('middle_name'),
										'last_name' => $request->input('last_name'),
										'gender' => $request->input('gender'),
										'birth_date' => $request->input('birth_date'),
										'address' => $request->input('address'),
										'school' => $request->input('school'),
										'father_name' => $request->input('father_name'),
										'mother_name' => $request->input('mother_name'),
										'contact_num' => $request->input('contact_num'),			
										'blood_types_id' => $request->input('blood_types_id'),
										'insurance_id' => $request->input('insurance_id'),								
										'picture' => $fileName	
									]);
		
		return back()->with('success', "Patient Record updated.");	
	}		

	/**
	 * Delete patient
	 * 
	 * @return void
	 */
	public function delete_patient(Request $request)
	{
		Patients::where('id', $request->input('id'))->delete(); 				
	}		
	
	/**********
	 * VISITS *
	 **********/
	
	/**
	 * Get patient visits
	 *
	 * @return json
	 */
	public function get_patient_visits(Request $request)
	{
		$visits = Visits::where('patients_id', $request->input('patientId'))->orderBy('date_of_visit', 'DESC')->get()->toArray();
		$patient = Patients::where('id', $request->input('patientId'))->get()->toArray();
		$output['data'] = []; 
			
		foreach ($visits as $v) {	
			$actions = "<a href='#' class='btn btn-danger btn-delete-patient-visit' data-id='".$v['id']."'>Delete</a>&nbsp;
			<a href='#' class='btn btn-info btn-edit-patient-visit' data-toggle='modal' data-target='#edit-patient-visit-modal' 
			data-id='".$v['id']."'
			data-date-of-visit='".$v['date_of_visit']."'
			data-age='".$v['age']."'
			data-temperature='".$v['temperature']."'
			data-temperature-type='".$v['temperature_type']."'
			data-weight='".$v['weight']."'
			data-weight-type='".$v['weight_type']."'
			data-height='".$v['height']."'
			data-height-type='".$v['height_type']."'
			data-complaints='".$v['complaints']."'
			data-physician-findings='".$v['physician_findings']."'
			data-treatment='".$v['treatment']."'
			data-charge='".$v['charge']."'
			data-blood-types-id='".$patient[0]['blood_types_id']."'
			data-insurance-id='".$patient[0]['insurance_id']."'>Edit</a>";

			$output['data'][] = [
				'date_of_visit' => $v['date_of_visit'],
				'age' => $v['age'],
				'temperature' => $v['temperature'].' '.$v['temperature_type'],
				'weight' => $v['weight'].' '.$v['weight_type'],
				'height' => $v['height'].' '.$v['height_type'],
				'complaints' => $v['complaints'],
				'physician_findings' => $v['physician_findings'],
				'treatment' => $v['treatment'],
				'charge_fee' => $v['charge'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);		
	}		
	
	/**
	 * Insert new patient record
	 * 
	 * @return void
	 */
	public function insert_patient_visit(Request $request)
	{
		#Visits::truncate();	
		
		Visits::create([
										'date_of_visit' => $request->input('date_of_visit'),
										'age' => $request->input('age'),
										'temperature' => $request->input('temperature'),
										'temperature_type' => $request->input('temperature_type'),
										'weight' => $request->input('weight'),
										'weight_type' => $request->input('weight_type'),
										'height' => $request->input('height'),
										'height_type' => $request->input('height_type'),
										'complaints' => $request->input('complaints'),
										'physician_findings' => $request->input('physician_findings'),
										'treatment' => $request->input('treatment'),
										'charge' => $request->input('charge'),
										'patients_id' => $request->input('patients_id')
									]);
		
		return back()->with('success', "New Patient Visit Record saved.");						
	}		
	
	/**
	 * Update patient visit record
	 * 
	 * @return void
	 */
	public function update_patient_visit(Request $request)
	{
		Visits::where('id', $request->input('id'))->update([
									'date_of_visit' => $request->input('date_of_visit'),
									'age' => $request->input('age'),
									'temperature' => $request->input('temperature'),
									'temperature_type' => $request->input('temperature_type'),
									'weight' => $request->input('weight'),
									'weight_type' => $request->input('weight_type'),
									'height' => $request->input('height'),
									'height_type' => $request->input('height_type'),
									'complaints' => $request->input('complaints'),
									'physician_findings' => $request->input('physician_findings'),
									'treatment' => $request->input('treatment'),
									'charge' => $request->input('charge')
									]);
		
		return back()->with('success', "Patient Visit Record updated.");	
	}		
	
	/**
	 * Delete patient visit record
	 * 
	 * @return void
	 */
	public function delete_patient_visit(Request $request)
	{
		Visits::where('id', $request->input('id'))->delete(); 				
	}			

	/*****************
	 * BIRTH HISTORY *
	 *****************/
	
	/**
	 * Insert patient birth history record
	 * 
	 * @return void
	 */
	public function insert_patient_birth_history_record(Request $request)
	{
		#BirthHistory::truncate();	
		
		BirthHistory::create([
										'preterm' => ($request->input('preterm'))?$request->input('preterm'):0,
										'full_term' => ($request->input('full_term'))?$request->input('full_term'):0,
										'nsd' => ($request->input('nsd'))?$request->input('nsd'):0,
										'cs' => ($request->input('cs'))?$request->input('cs'):0,
										'birth_weight' => $request->input('birth_weight'),
										'bw_percentile' => $request->input('bw_percentile'),
										'birth_head_circumference' => $request->input('birth_head_circumference'),
										'bhc_percentile' => $request->input('bhc_percentile'),
										'birth_length' => $request->input('birth_length'),
										'bl_percentile' => $request->input('bl_percentile'),
										'birth_chest_circumference' => $request->input('birth_chest_circumference'),
										'birth_abdominal_circumference' => $request->input('birth_abdominal_circumference'),
										'bcc_percentile' => $request->input('bcc_percentile'),
										'patients_id' => $request->input('patients_id')
									]);
		
		return back()->with('success', "Patient Birth History Record saved.");						
	}		
	
	/**
	 * Update patient birth history record
	 * 
	 * @return void
	 */
	public function update_patient_birth_history_record(Request $request)
	{
		BirthHistory::where('id', $request->input('id'))->update([
										'preterm' => $request->input('preterm'),
										'full_term' => $request->input('full_term'),
										'nsd' => $request->input('nsd'),
										'cs' => $request->input('cs'),
										'birth_weight' => $request->input('birth_weight'),
										'bw_percentile' => $request->input('bw_percentile'),
										'birth_head_circumference' => $request->input('birth_head_circumference'),
										'bhc_percentile' => $request->input('bhc_percentile'),
										'birth_length' => $request->input('birth_length'),
										'bl_percentile' => $request->input('bl_percentile'),
										'birth_chest_circumference' => $request->input('birth_chest_circumference'),
										'birth_abdominal_circumference' => $request->input('birth_abdominal_circumference'),
										'bcc_percentile' => $request->input('bcc_percentile'),
									]);
		
		return back()->with('success', "Patient Birth History Record updated.");	
	}		
		
	/*****************
	 * IMMUNIZATIONS *
	 *****************/
	
	/**
	 * Get patient immunizations
	 *
	 * @return array
	 */
	public function get_patient_immunizations(Request $request)
	{
		#$immunizations = Immunizations::where('patients_id', $request->input('patientId'))->get()->toArray();
		#$patient = Patients::where('id', $request->input('patientId'))->get()->toArray();
		
		#echo serialize(public_path());
		
		$immunizations = Immunizations::where('patients_id', $request->input('patientId'))->get()->toArray();
		$patient = Patients::where('id', $request->input('patientId'))->get()->toArray();		
		
		$output['data'] = [];
			
		foreach ($immunizations as $i) {	
			$actions = "<a href='#' class='btn btn-danger btn-delete-patient-immunization' data-id='".$i['id']."'>Delete</a>&nbsp;
			<a href='#' class='btn btn-info btn-edit-patient-immunization' data-toggle='modal' data-target='#edit-patient-immunization-modal' 
			data-id='".$i['id']."'
			data-vaccines='".$i['vaccines']."'
			data-first='".$i['first']."'
			data-second='".$i['second']."'
			data-third='".$i['third']."'
			data-booster-one='".$i['booster_one']."'
			data-booster-two='".$i['booster_two']."'
			data-booster-three='".$i['booster_three']."'
			data-other-vaccine='".$i['other_vaccine']."'
			data-reaction='".$i['reaction']."'>Edit</a>";
			
			$vaccinesDB = Vaccines::select('name')->whereIn('id', explode(',', $i['vaccines']))->get()->toArray();
			
			$vaccinesArr = [];
			foreach($vaccinesDB as $va) {
				foreach($va as $v) {
					$vaccinesArr[] = $v;
				}	
			}
			
			$vaccines = implode(', ', $vaccinesArr);
			
			$output['data'][] = [
				'vaccines' => $vaccines,
				'first' => $i['first'],
				'second' => $i['second'],
				'third' => $i['third'],
				'booster_one' => $i['booster_one'],
				'booster_two' => $i['booster_two'],
				'booster_three' => $i['booster_three'],
				'other_vaccine' => $i['other_vaccine'],
				'reaction' => $i['reaction'],
				'actions' => $actions				
			];
		}	
		
		echo json_encode($output);		
	}		
	
	/**
	 * Insert patient immunization record
	 * 
	 * @return void
	 */
	public function insert_patient_immunization_record(Request $request)
	{
		#Immunizations::truncate();	
		
		$vaccines = implode(',', $request->input('vaccines'));
		
		Immunizations::create([
										'vaccines' => $vaccines,
										'first' => $request->input('first'),
										'second' => $request->input('second'),
										'third' => $request->input('third'),
										'booster_one' => $request->input('booster_one'),
										'booster_two' => $request->input('booster_two'),
										'booster_three' => $request->input('booster_three'),
										'other_vaccine' => $request->input('other_vaccine'),
										'reaction' => $request->input('reaction'),
										'patients_id' => $request->input('patients_id')
									]);
		
		return back()->with('success', "Patient Immunization Record saved.");						
	}		
	
	/**
	 * Update patient immunization record
	 * 
	 * @return void
	 */
	public function update_patient_immunization_record(Request $request)
	{
		$vaccines = implode(',', $request->input('vaccines'));
		
		Immunizations::where('id', $request->input('id'))->update([
										'vaccines' => $vaccines,
										'first' => $request->input('first'),
										'second' => $request->input('second'),
										'third' => $request->input('third'),
										'booster_one' => $request->input('booster_one'),
										'booster_two' => $request->input('booster_two'),
										'booster_three' => $request->input('booster_three'),
										'other_vaccine' => $request->input('other_vaccine'),
										'reaction' => $request->input('reaction')
									]);
		
		return back()->with('success', "Patient Immunization Record updated.");	
	}	

	/**
	 * Delete patient immunization record
	 * 
	 * @return void
	 */
	public function delete_patient_immunization(Request $request)
	{
		Immunizations::where('id', $request->input('id'))->delete(); 				
	}			
}