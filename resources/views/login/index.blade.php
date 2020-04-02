@extends('layouts.app')

@section('content')
	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">
	
		@if(session()->has('error'))
			<div class="text-center">
				<div class="alert alert-danger">
					{{ session()->get('error') }}
				</div>			
			</div>
		@elseif(session()->has('success'))	
			<div class="text-center">
				<div class="alert alert-success">
					{{ session()->get('success') }}
				</div>			
			</div>			
		@endif	
	
		<div class="text-center">
			<a href="#" class="logo"><span>Customer<span>&nbsp;Order</span></span></a>
			<h5 class="text-muted m-t-0 font-600">Tracker</h5>
		</div>
		<div class="m-t-40 card-box">
			<div class="text-center">
				<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
			</div>
			<div class="panel-body">
				<form class="form-horizontal m-t-20" action="{{ route('login') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group ">
						<div class="col-xs-12">					
							<input type="text" name="OrderID" class="form-control" placeholder="Order ID" value="{{ old('OrderID') }}" required autofocus />	
								
							@if ($errors->has('OrderID'))
								<span class="help-block">
									<strong>{{ $errors->first('OrderID') }}</strong>
								</span>
							@endif														
						</div>
					</div>
					
					<div class="form-group ">
						<div class="col-xs-12">					
							<input type="text" name="BillLastName" class="form-control" placeholder="Last Name" value="{{ old('BillLastName') }}" required autofocus />	
								
							@if ($errors->has('BillLastName'))
								<span class="help-block">
									<strong>{{ $errors->first('BillLastName') }}</strong>
								</span>
							@endif														
						</div>
					</div>					

					<div class="form-group text-center m-t-30">
							<div class="col-xs-12">
									<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
							</div>
					</div>
					

				</form>
			</div>
		</div>
		<!-- end card-box-->
			
	</div>
	<!-- end wrapper page -->
@endsection
