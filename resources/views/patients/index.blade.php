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

	<h4 class="custom-modal-title">Patients Management</h4>
	<div class="card-box">
		<div class="row">		
			<div class="pull-left jc-m-l-10 jc-m-b-10">
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-patient-modal">Add New Patient Record</a>
			</div>				
		</div>
		<div class="clearfix"></div>
		
		<div class="row">
			<div class="col-md-12">
				<div id="aus-post-container">
					<div class="panel panel-default">
						<div class="panel-heading"><b>Existing Patients</b> 						
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="patients-datatable" data-reserve="{{$reserve}}">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Gender</th>
										<th>Birth Date</th>
										<th>Blood Type</th>
										<th>Address</th>
										<th>School</th>
										<th>Father's Name</th>
										<th>Mother's Name</th>
										<th>Contact #</th>
										<th>Insurance</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Gender</th>
										<th>Birth Date</th>
										<th>Blood Type</th>
										<th>Address</th>
										<th>School</th>
										<th>Father's Name</th>
										<th>Mother's Name</th>
										<th>Contact #</th>
										<th>Insurance</th>										
										<th>Actions</th>
									</tr>
								</tfoot>								
							</table>	
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div> <!-- /.card-box -->
</div> <!-- /.container -->

<div id="add-patient-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Patient Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('insert-patient') }}" enctype="multipart/form-data">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please enter patient information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="text" class="form-control" name="first_name" placeholder="First Name" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="middle_name" placeholder="Middle Name" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" />
						</div>
						<div class="form-group">
							<div class="radio radio-info radio-inline">
								<input type="radio" value="M" name="gender" checked>
								<label for="gender-male"> Male </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" value="F" name="gender">
								<label for="gender-female"> Female </label>							
							</div>
						</div>		
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Birth Date" id="birth-date" name="birth_date">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>						
						<div class="form-group">
							<textarea class="form-control" name="address" placeholder="Address"></textarea>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="school" placeholder="School" />
						</div>			
						<div class="form-group">
							<input type="text" class="form-control" name="father_name" placeholder="Father's Name" />
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="mother_name" placeholder="Mother's Name" />
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="contact_num" placeholder="Contact Number" />
						</div>	
						<div class="form-group">
							<select name="blood_types_id" class="form-control">
								<option value="-" selected>Select Blood Type</option>
								@foreach ($BloodTypes as $bt)
									<option value="{{$bt['id']}}">{{$bt['blood_type']}}</option>
								@endforeach
							</select>
						</div>						
						<div class="form-group">
							<select name="insurance_id" class="form-control">
								<option value="None" selected>Select Insurance</option>
								@foreach ($Insurance as $ins)
									<option value="{{$ins['id']}}">{{$ins['name']}}</option>
								@endforeach
							</select>
						</div>							
						<div class="form-group">
							<input type="file" class="form-control" name="patient-picture" placeholder="Picture" />
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
</div> <!-- /#add-patient-modal -->

<div id="edit-patient-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Patient Information" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="{{ URL::to('update-patient') }}" enctype="multipart/form-data">
			{{ csrf_field() }}		
				<div class="modal-header">
					<button type="button" class="close jc-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="custom-modal-title jc-modal-h4">Please enter patient information</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" />
							<input type="text" class="form-control" name="first_name" placeholder="First Name" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="middle_name" placeholder="Middle Name" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" />
						</div>
						<div class="form-group">
							<div class="radio radio-info radio-inline">
								<input type="radio" id="gender-male" value="M" name="gender" checked>
								<label for="gender-male"> Male </label>
							</div>					
							<div class="radio radio-danger radio-inline">
								<input type="radio" id="gender-female" value="F" name="gender">
								<label for="gender-female"> Female </label>							
							</div>
						</div>		
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Birth Date" id="birth-date-edit" name="birth_date">
								<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
							</div>
						</div>						
						<div class="form-group">
							<textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="school" placeholder="School" />
						</div>			
						<div class="form-group">
							<input type="text" class="form-control" name="father_name" placeholder="Father's Name" />
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="mother_name" placeholder="Mother's Name" />
						</div>	
						<div class="form-group">
							<input type="text" class="form-control" name="contact_num" placeholder="Contact Number" />
						</div>							
						<div class="form-group">
							<select name="blood_types_id" class="form-control">
								<option value="-" selected>Select Blood Type</option>
								@foreach ($BloodTypes as $bt)
									<option value="{{$bt['id']}}">{{$bt['blood_type']}}</option>
								@endforeach
							</select>
						</div>						
						<div class="form-group">
							<select name="insurance_id" class="form-control">
								@foreach ($Insurance as $ins)
									<option value="{{$ins['id']}}">{{$ins['name']}}</option>
								@endforeach
							</select>
						</div>						
						<div class="form-group">
							<input type="file" class="form-control" name="patient-picture" placeholder="Picture" />
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
</div> <!-- /#edit-patient-modal -->
@endsection