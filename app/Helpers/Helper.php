<?php
	/**
	 * Jace: Custom helper file
	 * https://stackoverflow.com/questions/36928919/laravel-5-2-create-common-function-for-controllers-must-use-helper/36928965
	 */
	namespace App\Helpers;
	
	use App\BloodTypes;
	use App\Insurance;
	use App\Patients;
	use App\Reservations;
	use App\Visits;
	 
	class Helper {
  
		/**
		 * Get Blood Type
		 * 
		 * @param int
		 * @return str
		 */
		public static function get_blood_type($id) {
			$bloodTypeArr = BloodTypes::select('blood_type')
																->where('id', $id)->get()->toArray();
			$bloodType = $bloodTypeArr[0]['blood_type'];		
			
			return $bloodType;
		}
		
		/**
		 * Get Insurance
		 * 
		 * @param int
		 * @return str
		 */	
		public static function get_insurance($id)
		{
			$insuranceArr = Insurance::select('name')
																->where('id', $id)->get()->toArray();
			$insurance = $insuranceArr[0]['name'];		
			
			return $insurance;
		}		
		
		/**
		 * Get Initial Reports
		 *
		 * @return array
		 */
		public static function get_initial_reports()
		{
			#$now = date('Y-m-d H:i:s');
			$now = date('Y-m-d');
			$NewPatients = Patients::where('created_at', 'like', "$now%")
									->get()
									->toArray();
			$Reservations = Reservations::where('created_at', 'like', "$now%")
									->get()
									->toArray();								
			$Visits = Visits::where('created_at', 'like', "$now%")
									->get()
									->toArray();								
			
			$totalNewPatientsToday = count($NewPatients);
			$totalPatientsToday = count($Reservations);
			$totalChargesToday = 0;
			
			foreach($Visits as $v) {
				$totalChargesToday += $v['charge'];
			}	

			return compact('totalNewPatientsToday', 'totalPatientsToday', 'totalChargesToday');			
		}		

		/**
		 * Debugging
		 *
		 * @params arr
		 * @return int
		 */
		public static function debug_me($data) {
			$file = "/homepages/29/d429450450/htdocs/cms/storage/app/jace/debug.log";	
			#file_put_contents($file, $data, FILE_APPEND);
			file_put_contents($file, $data);
		}		
		
		/**
		 * print_r()
		 */	
		public static function dd($data)
		{
			echo "<pre>";
			print_r($data);
			echo "</pre>"; 
		}		
	}	