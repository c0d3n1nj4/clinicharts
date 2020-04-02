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
	
	<h4 class="custom-modal-title">Appointments Management</h4>
	<div class="card-box">
		<!-- Page-Title 
		<div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right m-t-15">
					<button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</div>
				<h4 class="page-title">Calendar</h4>
			</div>
		</div>
		-->
		<div class="row">
			<div class="col-lg-12">

				<div class="row">
				<!--
					<div class="col-md-3">
						<div class="widget">
							<div class="widget-body">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-success btn-block waves-effect waves-light">
											<i class="fa fa-plus"></i> Create New
										</a>
										<div id="external-events" class="m-t-20">
											<br>
											<p>Drag and drop your event or click in the calendar</p>
											<div class="external-event bg-primary" data-class="bg-primary">
												<i class="fa fa-move"></i>New Theme Release
											</div>
											<div class="external-event bg-pink" data-class="bg-pink">
												<i class="fa fa-move"></i>My Event
											</div>
											<div class="external-event bg-warning" data-class="bg-warning">
												<i class="fa fa-move"></i>Meet manager
											</div>
											<div class="external-event bg-purple" data-class="bg-purple">
												<i class="fa fa-move"></i>Create New theme
											</div>
										</div>

										<div class="checkbox m-t-40">
											<input id="drop-remove" type="checkbox">
											<label for="drop-remove">Remove after drop</label>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div> end col-->
					<div class="col-md-12">
						<div class="card-box">
							<div id="calendar"></div>
						</div>
					</div> <!-- end col -->
				</div>  <!-- end row -->

				<!-- BEGIN MODAL -->
				<div class="modal fade none-border" id="event-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title"><strong>Appointment Details</strong></h4>
							</div>
							<div class="m-t-20">
								<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="patients-name-datatable">
									<thead><tr><th>Name</th><th>Action</th></tr></thead>
									<tfoot><tr><th>Name</th><th>Action</th></tr></tfoot>
								</table>
							</div>	
							<div class="modal-body"></div>
							<div class="modal-footer">
							<!--
								<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
							-->	
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Add Category 
				<div class="modal fade none-border" id="add-category">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title"><strong>Add a category </strong></h4>
							</div>
							<div class="modal-body">
								<form role="form">
									<div class="row">
										<div class="col-md-6">
											<label class="control-label">Category Name</label>
											<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
										</div>
										<div class="col-md-6">
											<label class="control-label">Choose Category Color</label>
											<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
												<option value="success">Success</option>
												<option value="danger">Danger</option>
												<option value="info">Info</option>
												<option value="pink">Pink</option>
												<option value="primary">Primary</option>
												<option value="warning">Warning</option>
												<option value="inverse">Inverse</option>
											</select>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
							</div>
						</div>
					</div>
				</div>
				 END MODAL -->
			</div>
			<!-- end col-12 -->
		</div> <!-- end row -->
		<div class="clearfix"></div>

	</div> <!-- /.card-box -->
</div> <!-- /.container -->

<div id="add-allergy-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Allergy" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="/insert-allergy">
				{{ csrf_field() }}			
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="custom-modal-title">Please enter allergy record</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="text" class="form-control" name="new-allergy" placeholder="Allergy Description" />
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
</div> <!-- /#add-allergy-modal -->

<div id="update-allergy-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Update Allergy" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="/update-allergy">
				{{ csrf_field() }}			
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="custom-modal-title">Please update allergy record</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" />
							<input type="text" class="form-control" name="new-allergy" placeholder="Allergy Description" />
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
</div> <!-- /#update-allergy-modal -->
@endsection