@extends('layouts.app')

@section('content')
	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">
		<div class="text-center">
			<a href="#" class="logo"><span>C<span>&nbsp;M S</span></span></a>
			<h5 class="text-muted m-t-0 font-600">Clinic Management System</h5>
		</div>
		<div class="m-t-40 card-box">
			<div class="text-center">
				<h4 class="text-uppercase font-bold m-b-0">Reset Password</h4>
				
				<p class="text-muted m-b-0 font-13 m-t-20">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
			</div>
			<div class="panel-body">
				@if (session('status'))
						<div class="alert alert-success">
								{{ session('status') }}
						</div>
				@endif			
			
				<form class="form-horizontal m-t-20" role="form" method="POST" action="{{ route('password.email') }}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<div class="col-xs-12">
								<input class="form-control" id="email" name="email" type="email" required="" placeholder="Enter email" value="{{ old('email') }}" required />
								
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif									
						</div>
					</div>
					
					<div class="form-group text-center m-t-20 m-b-0">
						<div class="col-xs-12">
							<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Send Password Reset Link</button>
						</div>
					</div>							
				</form>
			</div>
		</div>
		<!-- end card-box-->

		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="text-muted">Already have account?<a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
			</div>
		</div>
			
	</div>
	<!-- end wrapper page -->
@endsection
