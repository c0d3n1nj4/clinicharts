<?php
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route::group(['middleware' => ['auth']], function () { 

/* Authentications */
Route::get('/', function () {
  return view('login/index'); 
})->middleware('auth');
Auth::routes();

/* All resources */
Route::resources([
	''									=> 'DashboardController',
	'user-management'		=> 'UserManagementController',
	'patients' 					=> 'PatientsController',
	'blood-types' 			=> 'BloodTypesController',
	'allergies' 				=> 'AllergiesController',
	'reservations' 			=> 'ReservationsController',
	'insurance' 				=> 'InsuranceController',
	'vaccines' 					=> 'VaccinesController',
	'appointments' 			=> 'AppointmentsController',
	'show-reports' 			=> 'ReportsController'
]);

/* Dashboard */


/* Patients */
Route::get('/get-existing-patients', 'PatientsController@get_existing_patients');
Route::get('/patient-records/{id}', 'PatientsController@patient_records');
Route::get('/get-patient-visits', 'PatientsController@get_patient_visits');
Route::get('/get-patient-immunizations', 'PatientsController@get_patient_immunizations');
Route::post('/insert-patient', 'PatientsController@insert_patient');
Route::post('/update-patient', 'PatientsController@update_patient');
Route::post('/delete-patient', 'PatientsController@delete_patient');
Route::post('/insert-patient-visit', 'PatientsController@insert_patient_visit');
Route::post('/update-patient-visit', 'PatientsController@update_patient_visit');
Route::post('/delete-patient-visit', 'PatientsController@delete_patient_visit');
Route::post('/insert-patient-birth-history-record', 'PatientsController@insert_patient_birth_history_record');
Route::post('/update-patient-birth-history-record', 'PatientsController@update_patient_birth_history_record');
Route::post('/insert-patient-immunization-record', 'PatientsController@insert_patient_immunization_record');
Route::post('/update-patient-immunization-record', 'PatientsController@update_patient_immunization_record');
Route::post('/delete-patient-immunization', 'PatientsController@delete_patient_immunization');

/* Allergies */
Route::get('/get-existing-allergies', 'AllergiesController@get_existing_allergies');
Route::post('/insert-allergy', 'AllergiesController@insert_allergy');
Route::post('/update-allergy', 'AllergiesController@update_allergy');
Route::post('/delete-allergy', 'AllergiesController@delete_allergy');

/* Vaccines */
Route::get('/get-existing-vaccines', 'VaccinesController@get_existing_vaccines');
Route::post('/insert-vaccine', 'VaccinesController@insert_vaccine');
Route::post('/update-vaccine', 'VaccinesController@update_vaccine');
Route::post('/delete-vaccine', 'VaccinesController@delete_vaccine');

/* Blood Types */
Route::get('/get-existing-blood-types', 'BloodTypesController@get_existing_blood_types');
Route::post('/insert-blood-type', 'BloodTypesController@insert_blood_type');
Route::post('/update-blood-type', 'BloodTypesController@update_blood_type');
Route::post('/delete-blood-type', 'BloodTypesController@delete_blood_type');

/* Insurance */
Route::get('/get-existing-insurance', 'InsuranceController@get_existing_insurance');
Route::post('/insert-insurance', 'InsuranceController@insert_insurance');
Route::post('/update-insurance', 'InsuranceController@update_insurance');
Route::post('/delete-insurance', 'InsuranceController@delete_insurance');

/* Reservations */
Route::get('/get-all-reservations', 'ReservationsController@get_all_reservations');
Route::get('/get-today-reservations', 'ReservationsController@get_today_reservations');
Route::get('/reserve-patient', 'ReservationsController@reserve_patient');
Route::post('/insert-reservation', 'ReservationsController@insert_reservation');
Route::post('/delete-reservation', 'ReservationsController@delete_reservation');
Route::post('/update-reservation', 'ReservationsController@update_reservation');

/* Appointments */
Route::get('/get-patients-name', 'AppointmentsController@get_patients_name');
Route::get('/get-appointments', 'AppointmentsController@get_appointments');
Route::post('/insert-appointment', 'AppointmentsController@insert_appointment');
Route::post('/update-appointment', 'AppointmentsController@update_appointment');
Route::post('/update-appointment-by-drag', 'AppointmentsController@update_appointment_by_drag');
Route::post('/delete-appointment', 'AppointmentsController@delete_appointment');

/* Reports */
#Route::get('/show-reports', 'ReportsController@show_reports');
Route::get('/by-date/{dateRequested}', 'ReportsController@get_reports_by_date');
Route::get('/swpr', 'ReportsController@show_weekly_patients');
Route::get('/smpr', 'ReportsController@show_monthly_patients');
Route::get('/sypr', 'ReportsController@show_yearly_patients');

####### User Management
Route::get('/profile', 'ProfileController@index');
Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');

###### ERRORS
Route::get('500', function() {
  abort(500);
});

//Clear Cache facade value:
Route::get('/clear-cache', function() {
	$exitCode = Artisan::call('cache:clear');
	return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
	$exitCode = Artisan::call('optimize');
	return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
	$exitCode = Artisan::call('route:cache');
	return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
	$exitCode = Artisan::call('route:clear');
	return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
	$exitCode = Artisan::call('view:clear');
	return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
	$exitCode = Artisan::call('config:cache');
	return '<h1>Clear Config cleared</h1>';
});

Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	Artisan::call('route:cache');
	Artisan::call('route:clear');
	Artisan::call('optimize');

	return "Cleared!";
});

#});