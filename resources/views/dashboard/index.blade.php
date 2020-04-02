@extends('layouts.app-template')
@section('content')

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
	
	<!-- Initial Reports -->
	<h4 class="custom-modal-title">Initial Reports</h4>
	<div class="card-box">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="card-box">
					 <h4 class="header-title m-t-0 m-b-30">Total Sales</h4>

					 <div class="widget-chart-1">
							 <div class="widget-chart-box-1">
									 <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
													data-bgColor="#F9B9B9" value="77.77"
													data-skin="tron" data-angleOffset="180" data-readOnly=true
													data-thickness=".15"/>
							 </div>

							 <div class="widget-detail-1">
									 <h2 class="p-t-10 m-b-0"> P 77777 </h2>
									 <p class="text-muted">Revenue today</p>
							 </div>
					 </div>
				</div>
			 </div><!-- end col -->

			 <div class="col-lg-3 col-md-6">
					 <div class="card-box">
							 <h4 class="header-title m-t-0 m-b-30">Total Patients</h4>

							 <div class="widget-chart-1">
									 <div class="widget-chart-box-1">
											 <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
															data-bgColor="#FFE6BA" value="77"
															data-skin="tron" data-angleOffset="180" data-readOnly=true
															data-thickness=".15"/>
									 </div>
									 <div class="widget-detail-1">
											 <h2 class="p-t-10 m-b-0"> 77 </h2>
											 <p class="text-muted">Patients today</p>
									 </div>
							 </div>
					 </div>
			 </div><!-- end col -->

			 <div class="col-lg-3 col-md-6">
					 <div class="card-box">
							 <h4 class="header-title m-t-0 m-b-30">New Patients</h4>

							 <div class="widget-chart-1">
									 <div class="widget-chart-box-1">
											 <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#10c469"
															data-bgColor="rgba(16, 196, 105, 0.2)" value="7"
															data-skin="tron" data-angleOffset="180" data-readOnly=true
															data-thickness=".15"/>
									 </div>
									 <div class="widget-detail-1">
											 <h2 class="p-t-10 m-b-0"> 7 </h2>
											 <p class="text-muted">New Patients today</p>
									 </div>
							 </div>
					 </div>
			 </div><!-- end col -->

			 <div class="col-lg-3 col-md-6">
					 <div class="card-box">
							 <div class="dropdown pull-right">
									 <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown"
											aria-expanded="false">
											 <i class="zmdi zmdi-more-vert"></i>
									 </a>
									 <ul class="dropdown-menu" role="menu">
											 <li><a href="#">Action</a></li>
											 <li><a href="#">Another action</a></li>
											 <li><a href="#">Something else here</a></li>
											 <li class="divider"></li>
											 <li><a href="#">Separated link</a></li>
									 </ul>
							 </div>

							 <h4 class="header-title m-t-0 m-b-30">Daily Sales</h4>

							 <div class="widget-box-2">
									 <div class="widget-detail-2">
											 <span class="badge badge-pink pull-left m-t-20">32% <i
															 class="zmdi zmdi-trending-up"></i> </span>
											 <h2 class="m-b-0"> 158 </h2>
											 <p class="text-muted m-b-25">Revenue today</p>
									 </div>
									 <div class="progress progress-bar-pink-alt progress-sm m-b-0">
											 <div class="progress-bar progress-bar-pink" role="progressbar"
														aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
														style="width: 77%;">
													 <span class="sr-only">77% Complete</span>
											 </div>
									 </div>
							 </div>
					 </div>
			 </div><!-- end col -->

	 </div>
	<!-- end row -->	
	</div> <!-- /.card-box -->
	<!-- /Initial Reports -->
	
	<!-- Reservations Management -->
	<h4 class="custom-modal-title">Today's Reservations</h4>
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
						<!-- <div class="panel-heading"><b>Today's Reservations</b> 						
						</div> -->
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="reservations-datatable">
								<thead>
									<tr>
										<th>Priority</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Status</th>
										<th>Insurance</th>
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
	<!-- /Reservations Management -->
</div> <!-- /.container -->
@endsection