@extends('users-mgmt.base')
@section('action-content')

<!-- Start content -->
<div class="container">
	<h4 class="custom-modal-title">Users Management</h4>
	<div class="card-box">
		<div class="row">
			<div class="col-md-12">
				<h3 class="box-title">List of Users</h3>
				<p>
					<br />
					<a class="btn btn-primary" href="{{ route('user-management.create') }}">Add new user</a>
				</p>  
			</div>
		</div>

		<!--	
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6"></div>
		</div>
		-->

		<!-- <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> -->
		<div class="row">
			<div class="col-md-12">
				<table id="users-mgmt-datatable" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">				
					<thead>
						<tr role="row">
							<th aria-controls="datatable-responsive">User Name</th>
							<th aria-controls="datatable-responsive">Email</th>
							<th aria-controls="datatable-responsive">First Name</th>
							<th aria-controls="datatable-responsive">Last Name</th>
							<th aria-controls="datatable-responsive">Admin</th>
							<th aria-controls="datatable-responsive">Action</th>
						</tr>
					</thead> 
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{ $user->username }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->firstname }}</td>
							<td>{{ $user->lastname }}</td>
							<td>@if ($user->admin) Yes @else No @endif</td>
							<td style="padding-left:18px">
								<form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin" style="margin-right:8px; width:auto">Update</a>
									@if ($user->username != Auth::user()->username)
									<button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">Delete</button>
									@endif
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr role="row">
							<th aria-controls="datatable-responsive">User Name</th>
							<th aria-controls="datatable-responsive">Email</th>
							<th aria-controls="datatable-responsive">First Name</th>
							<th aria-controls="datatable-responsive">Last Name</th>
							<th aria-controls="datatable-responsive">Admin</th>
							<th aria-controls="datatable-responsive">Action</th>
						</tr>
					</tfoot>		
				</table>							
				<!-- <table id="users-mgmt-datatable" class="table table-bordered table-striped table-hover dataTable" role="grid" aria-describedby="example2_info"> 
					<thead>
						<tr role="row">
							<th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
							<th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
							<th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">First Name</th>
							<th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
							<th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr role="row" class="odd">
							<td class="sorting_1">{{ $user->username }}</td>
							<td>{{ $user->email }}</td>
							<td class="hidden-xs">{{ $user->firstname }}</td>
							<td class="hidden-xs">{{ $user->lastname }}</td>
							<td style="padding-left:18px">
								<form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin" style="margin-right:8px">
										Update
									</a>
									@if ($user->username != Auth::user()->username)
									<button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
									Delete
									</button>
									@endif
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
					<tr>
						<th width="10%" rowspan="1" colspan="1">User Name</th>
						<th width="20%" rowspan="1" colspan="1">Email</th>
						<th class="hidden-xs" width="20%" rowspan="1" colspan="1">First Name</th>
						<th class="hidden-xs" width="20%" rowspan="1" colspan="1">Last Name</th>
						<th rowspan="1" colspan="2">Action</th>
					</tr>
					</tfoot>
				</table>
				-->
			</div>
		</div>
		<!--
		<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
					$users->links()
				</div>
			</div>
		</div>
		-->

	</div> <!-- /.card-box -->
</div> <!-- /.container -->

@endsection