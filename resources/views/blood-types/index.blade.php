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
	
	<h4 class="custom-modal-title">Blood Types Management</h4>
	<div class="card-box">
		<div class="row">		
			<div class="pull-left jc-m-l-10 jc-m-b-10">
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-blood-type-modal">Add New Blood Type Record</a>
			</div>				
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12">
				<div id="aus-post-container">
					<div class="panel panel-default">
						<div class="panel-heading"><b>Existing Blood Types</b> 						
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="blood-types-datatable">
								<thead>
									<tr>
										<th>Blood Type</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Blood Type</th>
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

<div id="add-blood-type-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Enter Blood Type" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="/insert-blood-type">
				{{ csrf_field() }}			
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="custom-modal-title">Please enter blood type record</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="text" class="form-control" name="new-blood-type" placeholder="Blood Type" />
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
</div> <!-- /#add-blood-type-modal -->

<div id="update-blood-type-modal" class="modal slide" tabindex="-1" role="dialog" aria-labelledby="Update Blood Type" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content" style="border:0 !important">
			<form method="POST" action="/update-blood-type">
				{{ csrf_field() }}			
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="custom-modal-title">Please update blood type record</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id" />
							<input type="text" class="form-control" name="new-blood-type" placeholder="Blood Type" />
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
</div> <!-- /#update-blood-type-modal -->
@endsection