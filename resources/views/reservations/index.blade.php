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
	
	<h4 class="custom-modal-title">Reservations Management</h4>
	<div class="card-box">
		<div class="row">		
			<div class="pull-left jc-m-l-10 jc-m-b-10">
				<a href="/reserve-patient" class="btn btn-success">Add Reservation for Today</a>
			</div>				
		</div>
		<div class="clearfix"></div>
		
		<div class="row">
			<div class="col-md-12">
				<div id="aus-post-container">
					<div class="panel panel-default">
						<div class="panel-heading"><b>All Reservations</b> 						
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="reservations-all-datatable">
								<thead>
									<tr>
										<th>Priority</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Status</th>
										<th>Insurance</th>
										<th>Date Updated</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Priority</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Status</th>
										<th>Insurance</th>
										<th>Date Updated</th>
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
@endsection