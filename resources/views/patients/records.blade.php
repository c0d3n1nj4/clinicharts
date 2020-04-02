@extends('layouts.app-template')
@section('content')

<style>

</style>

<!-- Start content -->
<div class="container">
	@if(session()->has('success'))
		<div class="text-center">
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>			
		</div>
	@endif
	
	@if(session()->has('error'))
		<div class="text-center">
			<div class="alert alert-danger">
				{{ session()->get('error') }}
			</div>			
		</div>
	@endif	

	<h4 class="custom-modal-title">Patient Data</h4>
	<div class="card-box">
		<div class="row">		
			<!-- Personal Information -->	
			<div class="col-lg-6">
				<div class="portlet">
					<div class="portlet-heading bg-info">
						<h3 class="portlet-title">Personal Information</h3>
						<div class="portlet-widgets">
							<a data-toggle="collapse" data-parent="#accordion3" href="#personal-information-panel"><i class="zmdi zmdi-minus"></i></a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div id="personal-information-panel" class="panel-collapse collapse in">
						<div class="portlet-body">
							<div class="form-group">
								<div class="col-md-3">
									<img src="/public/avatars/{{$patient[0]['picture']}}" id="patient-picture" />
								</div>	
								<div class="col-md-4">
									<p><b>Name:</b> {{$patient[0]['first_name']}} {{$patient[0]['middle_name']}} {{$patient[0]['last_name']}}</p>
									<p><b>Address:</b> {{$patient[0]['address']}}</p>
									<p><b>School:</b> {{$patient[0]['school']}}</p>
									<p><b>Birth Date:</b> {{$patient[0]['birth_date']}}</p>										
									<p><b>Blood Type:</b> {{$bloodType}}</p>			
								</div>		
								<div class="col-md-4">
									<p><b>Gender:</b> {{$patient[0]['gender']}}</p>									
									<p><b>Father's Name:</b> {{$patient[0]['father_name']}}</p>
									<p><b>Mother's Name:</b> {{$patient[0]['mother_name']}}</p>
									<p><b>Contact Number:</b> {{$patient[0]['contact_num']}}</p>		
									<p><b>Insurance:</b> {{$insurance}}</p>											
								</div>	
								<div class="clearfix"></div>							
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<!-- Visits | Birth History | Vaccines -->	
			<div class="col-md-12">
				<div class="portlet">
					<div class="portlet-heading bg-primary">
						<h3 class="portlet-title">Medical Records</h3>
						<div class="portlet-widgets">
							<a data-toggle="collapse" data-parent="#accordion3" href="#medical-records-panel"><i class="zmdi zmdi-minus"></i></a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div id="medical-records-panel" class="panel-collapse collapse in">
						<div class="portlet-body">
							<div class="form-group">
								<ul class="nav nav-tabs nav-justified">
									<li role="presentation" class="active">
										<a href="#visits" id="visits-tab" role="tab" data-toggle="tab" aria-controls="visits" aria-expanded="true">Visits</a>
									</li>
									<li role="presentation">
										<a href="#birth-history" id="birth-history-tab" role="tab" data-toggle="tab" aria-controls="birth-history" aria-expanded="false">Birth History</a>
									</li>
									<li role="presentation">
										<a href="#immunization-records" id="immunization-records-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Immunization Records</a>
									</li>									
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="visits" aria-labelledby="visits-tab">
										<div class="pull-left jc-m-b-10">
											<a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-patient-visit-modal">Add New Patient Visit Record</a>
										</div>	
										<div class="clearfix"></div>
										
										<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="patient-visits-datatable" data-patient-id="{{$patient[0]['id']}}">
											<thead>
												<tr>
													<th>Date</th>
													<th>Age</th>
													<th>Temperature</th>
													<th>Weight</th>
													<th>Height</th>
													<th>Complaints</th>
													<th>Physician's Findings</th>
													<th>Treatment</th>
													<th>Charge/Fee</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Date</th>
													<th>Age</th>
													<th>Temperature</th>
													<th>Weight</th>
													<th>Height</th>
													<th>Complaints</th>
													<th>Physician's Findings</th>
													<th>Treatment</th>
													<th>Charge/Fee</th>
													<th>Actions</th>
												</tr>
											</tfoot>								
										</table>
									</div>
									<div role="tabpanel" class="tab-pane fade in" id="birth-history" aria-labelledby="birth-history-tab">
										@if ($birthHistory['has_record'])
											<div class="pull-left jc-m-b-10">
												<a href="#" class="btn btn-success" id="#update-patient-birth-history-btn" data-toggle="modal" data-target="#update-patient-birth-history-modal">Update Patient Birth History Record</a>
											</div>											
											<div class="clearfix"></div>
											
											<div class="col-md-3">
												<div class="form-group">
														<div class="checkbox checkbox-primary">
														<input type="checkbox" @if ($birthHistory[0]['preterm']) checked @endif disabled />
														<label for="preterm"> Preterm </label>
													</div>					
												</div>										
											</div>
											<div class="col-md-3">
												<div class="form-group">
														<div class="checkbox checkbox-primary">
														<input type="checkbox" @if ($birthHistory[0]['full_term']) checked @endif disabled />
														<label for="preterm"> Full Term </label>
													</div>					
												</div>											
											</div>										
											<div class="clearfix"></div>
										
											<div class="col-md-3">
												<p><b>Type of Delivery:</b></p>
											</div>
											<div class="col-md-3">
												<div class="form-group">
														<div class="checkbox checkbox-primary">
														<input type="checkbox" @if ($birthHistory[0]['nsd']) checked @endif disabled />
														<label for="preterm"> NSD </label>
													</div>					
												</div>											
											</div>	
											<div class="col-md-3">
												<div class="form-group">
														<div class="checkbox checkbox-primary">
														<input type="checkbox" @if ($birthHistory[0]['cs']) checked @endif disabled />
														<label for="preterm"> CS </label>
													</div>					
												</div>											
											</div>										
											<div class="clearfix"></div>									
											
											<div class="col-md-3">
												<p><b>Birth Weight:</b> <span>{{$birthHistory[0]['birth_weight']}}</span></p>
											</div>
											<div class="col-md-3">
												<p><b>Percentile:</b> <span>{{$birthHistory[0]['bw_percentile']}}</span> %</p>
											</div>											
											<div class="col-md-3">
												<p><b>Birth Head Circumference:</b> <span>{{$birthHistory[0]['birth_head_circumference']}}</span></p>
											</div>	

											<div class="col-md-3">
												<p><b>Percentile:</b> <span>{{$birthHistory[0]['bhc_percentile']}}</span> %</p>
											</div>											
											<div class="clearfix"></div>				

											<div class="col-md-3">
												<p><b>Birth Length:</b> <span>{{$birthHistory[0]['birth_length']}}</span></p>
											</div>
											<div class="col-md-3">
												<p><b>Percentile:</b> <span>{{$birthHistory[0]['bl_percentile']}}</span> %</p>
											</div>											
											<div class="col-md-3">
												<p><b>Birth Chest Circumference:</b> <span>{{$birthHistory[0]['birth_chest_circumference']}}</span></p>
											</div>	
											<div class="col-md-3">
												<p><b>Percentile:</b> <span>{{$birthHistory[0]['bcc_percentile']}}</span> %</p>
											</div>											
											<div class="clearfix"></div>				

											<div class="col-md-3">
												<p><b>Birth Abdominal Circumference:</b> <span>{{$birthHistory[0]['birth_abdominal_circumference']}}</span></p>
											</div>										
											<div class="clearfix"></div>			
											
										@else
											<div class="pull-left jc-m-b-10">
												<a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-patient-birth-history-modal">Add Patient Birth History Record</a>
											</div>	
											<div class="clearfix"></div>
											
											<div class="text-center">
												<div class="alert alert-danger">
													<p> No Birth Record found. </p>
												</div>			
											</div>																						
										@endif												
									</div>
									<div role="tabpanel" class="tab-pane fade in table-responsive" id="immunization-records" aria-labelledby="immunization-records-tab">
										<div class="pull-left jc-m-b-10">
											<a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-patient-immunization-modal">Add Patient Immunization Record</a>
										</div>											
										<div class="clearfix"></div>									
									
										<table id="immunization-records-datatable" class="table table-striped table-bordered table-hover dt-responsive nowrap" data-patient-id="{{$patient[0]['id']}}">
											<thead>
												<tr>
													<th rowspan="2" class="text-center" style="vertical-align: middle;">Vaccine</th>
													<th colspan="9" class="text-center">DATE</th>
												</tr>	
												<tr>
													<th>1st</th>
													<th>2nd</th>
													<th>3rd</th>
													<th>Booster 1</th>
													<th>Booster 2</th>
													<th>Booster 3</th>
													<th>Other Vaccine</th>
													<th>Reaction</th>
													<th>Actions</th>
												</tr>													
											</thead> 
											<!--
											<tbody>
												<tr>
													<td class="text-center">Vaccine</td>
													<td>1st</td>
													<td>2nd</td>
													<td>3rd</td>
													<td>Booster 1</td>
													<td>Booster 2</td>
													<td>Booster 3</td>
													<td>Other Vaccine</td>
													<td>Reaction</td>
													<td>Actions</td>
												</tr>	
											</tbody>
											-->
											<tfoot>
												<tr>
													<th rowspan="2" class="text-center" style="vertical-align: middle;">Vaccine</th>
													<th>1st</th>
													<th>2nd</th>
													<th>3rd</th>
													<th>Booster 1</th>
													<th>Booster 2</th>
													<th>Booster 3</th>
													<th>Other Vaccine</th>
													<th>Reaction</th>
													<th>Actions</th>													
												</tr>	
												<tr>
													<th colspan="9" class="text-center">DATE</th>
												</tr>	
											</tfoot> 					
										</table>
									</div>
								</div>
								<div class="clearfix"></div>							
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
		<div class="clearfix"></div>
	</div> <!-- /.card-box -->
</div> <!-- /.container -->

<div id="add-patient-visit-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Patient Visit Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('insert-patient-visit') }}">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please enter visit information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="patients_id" value="{{$patient[0]['id']}}" />
							<input type="text" class="form-control" name="age" placeholder="Age" />
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="temperature" placeholder="Temperature" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="C" name="temperature_type" checked>
								<label for="temperature_type"> C </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="F" name="temperature_type">
								<label for="temperature_type"> F </label>							
							</div>							
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="weight" placeholder="Weight" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="KG" name="weight_type" checked>
								<label for="weight_type"> KG </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="LBS" name="weight_type">
								<label for="weight_type"> LBS </label>							
							</div>							
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="height" placeholder="Height" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="INCHES" name="height_type" checked>
								<label for="height_type"> INCHES </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="CM" name="height_type">
								<label for="height_type"> CM </label>							
							</div>							
						</div>					
						<div class="form-group">
							<textarea class="form-control" name="complaints" placeholder="Complaints"></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="physician_findings" placeholder="Physician's Findings"></textarea>
						</div>						
						<div class="form-group">
							<textarea class="form-control" name="treatment" placeholder="Treatment"></textarea>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Date of Visit" id="visit-date" name="date_of_visit">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="charge" placeholder="Charge / Fee" />
						</div>	
						<div class="form-group">
							<p>Patient Blood Type: <b>{{$bloodType}}</b></p> 
						</div>													
						<div class="form-group">
							<p>Patient Insurance: <b>{{$insurance}}</b></p> 
						</div>						
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#add-patient-visit-modal -->

<div id="edit-patient-visit-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Update Patient Visit Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('update-patient-visit') }}">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please update visit information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" />
							<input type="text" class="form-control" name="age" placeholder="Age" />
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="temperature" placeholder="Temperature" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="C" id="temperature_type_c" name="temperature_type">
								<label for="temperature_type"> C </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="F" id="temperature_type_f" name="temperature_type">
								<label for="temperature_type"> F </label>							
							</div>							
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="weight" placeholder="Weight" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="KG" id="weight_type_kg" name="weight_type">
								<label for="weight_type"> KG </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="LBS" id="weight_type_lbs" name="weight_type">
								<label for="weight_type"> LBS </label>							
							</div>							
						</div>
						<div class="form-group form-inline">
							<input type="text" class="form-control" name="height" placeholder="Height" />
							<div class="radio radio-info radio-inline">
								<input type="radio" value="INCHES" id="height_type_inches" name="height_type">
								<label for="height_type"> INCHES </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="CM" id="height_type_cm" name="height_type">
								<label for="height_type"> CM </label>							
							</div>							
						</div>					
						<div class="form-group">
							<textarea class="form-control" id="complaints" name="complaints" placeholder="Complaints"></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="physician_findings" name="physician_findings" placeholder="Physician's Findings"></textarea>
						</div>						
						<div class="form-group">
							<textarea class="form-control" id="treatment" name="treatment" placeholder="Treatment"></textarea>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Date of Visit" id="visit-date-edit" name="date_of_visit">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="charge" placeholder="Charge / Fee" />
						</div>	
						<div class="form-group">
							<p>Patient Blood Type: <b>{{$bloodType}}</b></p> 
						</div>													
						<div class="form-group">
							<p>Patient Insurance: <b>{{$insurance}}</b></p> 
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#edit-patient-visit-modal -->

<div id="add-patient-birth-history-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Patient Birth History Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('insert-patient-birth-history-record') }}">
				{{ csrf_field() }}		
				<input type="hidden" class="form-control" name="patients_id" value="{{$patient[0]['id']}}" />
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please enter birth history information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" value="1" name="preterm" />
									<label for="preterm"> Preterm </label>
								</div>					
							</div>										
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" value="1" name="full_term" />
									<label for="preterm"> Full Term </label>
								</div>					
							</div>											
						</div>										
						<div class="clearfix"></div>
					
						<div class="col-md-3">
							<p>Type of Delivery:</p>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" value="1" name="nsd" />
									<label for="nsd"> NSD </label>
								</div>					
							</div>											
						</div>	
						<div class="col-md-3">
							<div class="form-group">
									<div class="checkbox checkbox-primary">
									<input type="checkbox" value="1" name="cs" />
									<label for="cs"> CS </label>
								</div>					
							</div>											
						</div>										
						<div class="clearfix"></div>									
						
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_weight" placeholder="Birth Weight" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-inline">
								<input type="text" class="form-control" name="bw_percentile" placeholder="Percentile" /> 
								<label for="height_type"> % </label>
							</div>									
						</div>							
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_head_circumference" placeholder="Birth Head Circumference" />
							</div>							
						</div>	
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="bhc_percentile" placeholder="Percentile" />
								<label for="height_type"> % </label>
							</div>									
						</div>											
						<div class="clearfix"></div>				

						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_length" placeholder="Birth Length" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-inline">
								<input type="text" class="form-control" name="bl_percentile" placeholder="Percentile" /> 
								<label for="height_type"> % </label>
							</div>									
						</div>							
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_chest_circumference" placeholder="Birth Chest Circumference" />
							</div>							
						</div>	
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="bcc_percentile" placeholder="Percentile" />
								<label for="height_type"> % </label>
							</div>									
						</div>											
						<div class="clearfix"></div>				

						<div class="col-md-3">
							<div class="form-group">
								<p>Patient Blood Type: <b>{{$bloodType}}</b></p> 
							</div>													
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_abdominal_circumference" placeholder="Birth Abdominal Circumference" />
							</div>								
						</div>		
						<div class="col-md-3">											
							<div class="form-group">
								<p>Patient Insurance: <b>{{$insurance}}</b></p> 
							</div>	
						</div>						
						<div class="clearfix"></div>							
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#add-patient-birth-history-modal -->

<div id="update-patient-birth-history-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Update Patient Birth History Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('update-patient-birth-history-record') }}">
				{{ csrf_field() }}		
				<input type="hidden" class="form-control" name="id" value="{{$birthHistory[0]['id']}}" />
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please update birth history information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" name="preterm" value="1" @if ($birthHistory[0]['preterm']) checked @endif />
									<label for="preterm"> Preterm </label>
								</div>					
							</div>										
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" value="1" name="full_term" @if ($birthHistory[0]['full_term']) checked @endif />
									<label for="preterm"> Full Term </label>
								</div>					
							</div>											
						</div>										
						<div class="clearfix"></div>
					
						<div class="col-md-3">
							<p>Type of Delivery:</p>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="checkbox checkbox-primary">
									<input type="checkbox" name="nsd" value="1" @if ($birthHistory[0]['nsd']) checked @endif />
									<label for="nsd"> NSD </label>
								</div>					
							</div>											
						</div>	
						<div class="col-md-3">
							<div class="form-group">
									<div class="checkbox checkbox-primary">
									<input type="checkbox" name="cs" value="1" @if ($birthHistory[0]['cs']) checked @endif />
									<label for="cs"> CS </label>
								</div>					
							</div>											
						</div>										
						<div class="clearfix"></div>									
						
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_weight" value="{{$birthHistory[0]['birth_weight']}}" placeholder="Birth Weight" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-inline">
								<input type="text" class="form-control" name="bw_percentile" value="{{$birthHistory[0]['bw_percentile']}}" placeholder="Percentile" /> 
								<label for="height_type"> % </label>
							</div>									
						</div>							
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_head_circumference" value="{{$birthHistory[0]['birth_head_circumference']}}" placeholder="Birth Head Circumference" />
							</div>							
						</div>	
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="bhc_percentile" value="{{$birthHistory[0]['bhc_percentile']}}" placeholder="Percentile" />
								<label for="height_type"> % </label>
							</div>									
						</div>											
						<div class="clearfix"></div>				

						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_length" value="{{$birthHistory[0]['birth_length']}}" placeholder="Birth Length" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-inline">
								<input type="text" class="form-control" name="bl_percentile" value="{{$birthHistory[0]['bl_percentile']}}" placeholder="Percentile" /> 
								<label for="height_type"> % </label>
							</div>									
						</div>							
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_chest_circumference" value="{{$birthHistory[0]['birth_chest_circumference']}}" placeholder="Birth Chest Circumference" />
							</div>							
						</div>	
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="bcc_percentile" value="{{$birthHistory[0]['bcc_percentile']}}" placeholder="Percentile" />
								<label for="height_type"> % </label>
							</div>									
						</div>											
						<div class="clearfix"></div>				

						<div class="col-md-3">
							<div class="form-group">
								<p>Patient Blood Type: <b>{{$bloodType}}</b></p> 
							</div>													
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" class="form-control" name="birth_abdominal_circumference" value="{{$birthHistory[0]['birth_abdominal_circumference']}}" placeholder="Birth Abdominal Circumference" />
							</div>								
						</div>		
						<div class="col-md-3">											
							<div class="form-group">
								<p>Patient Insurance: <b>{{$insurance}}</b></p> 
							</div>	
						</div>						
						<div class="clearfix"></div>							
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#update-patient-birth-history-modal -->

<div id="add-patient-immunization-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Patient Immunization Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('insert-patient-immunization-record') }}">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please enter immunization information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="patients_id" value="{{$patient[0]['id']}}" />
							
							<select class="select2 select2-multiple form-control" multiple="multiple" multiple data-placeholder="Choose Vaccines" name="vaccines[]">
								@foreach ($Vaccines as $v)
									<option value="{{$v['id']}}">{{$v['name']}}</option>
								@endforeach
							</select>							
						</div>			
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="First Vaccine" id="first_vaccine" name="first">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Second Vaccine" id="second_vaccine" name="second">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Third Vaccine" id="third_vaccine" name="third">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 1" id="booster_one" name="booster_one">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 2" id="booster_two" name="booster_two">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 3" id="booster_three" name="booster_three">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						
						<div class="form-group">
							<textarea class="form-control" name="other_vaccine" placeholder="Other Vaccine"></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="reaction" placeholder="Reaction"></textarea>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#add-patient-immunization-modal -->

<div id="edit-patient-immunization-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Update Patient Immunization Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('update-patient-immunization-record') }}">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please update immunization information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" />
							
							<select class="select2 select2-multiple form-control" multiple="multiple" multiple data-placeholder="Choose Vaccines" name="vaccines[]" id="edit-vaccines">
								@foreach ($Vaccines as $v)
									<option value="{{$v['id']}}">{{$v['name']}}</option>
								@endforeach
							</select>							
						</div>			
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="First Vaccine" id="first_vaccine" name="first">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Second Vaccine" id="second_vaccine" name="second">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Third Vaccine" id="third_vaccine" name="third">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 1" id="booster_one" name="booster_one">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 2" id="booster_two" name="booster_two">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Booster 3" id="booster_three" name="booster_three">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>	
						
						<div class="form-group">
							<textarea class="form-control" id="other_vaccine" name="other_vaccine" placeholder="Other Vaccine"></textarea>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="reaction" name="reaction" placeholder="Reaction"></textarea>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>				
				</div>
			</form>	
		</div>
	</div>
</div> <!-- /#add-patient-immunization-modal -->
@endsection