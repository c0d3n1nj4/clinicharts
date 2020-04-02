@extends('layouts.app')

@section('content')
	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">
		<div class="text-center">
			<a href="#" class="logo"><img src="{{ asset('/public/assets/img/logo-64x64.png') }}" /></a><br /><br />
			<h5 class="text-muted m-t-0 font-600 white">Clinic Management System</h5>
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
							<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus />	
								
							@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif														
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<input type="password" name="password" class="form-control" placeholder="Password" required />
							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif								
						</div>
					</div>
					
					<!--
					<div class="form-group ">
						<div class="col-xs-12">
							<div class="checkbox checkbox-custom">
								<input id="checkbox-signup" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
								<label for="checkbox-signup">Remember me</label>
							</div>
						</div>
					</div>
					-->
					
					<div class="form-group text-center m-t-30">
							<div class="col-xs-12">
									<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
							</div>
					</div>
					<div class="form-group m-t-30 m-b-0">
							<div class="col-sm-12">
									<a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
							</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end card-box-->
		
		<!--
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
			</div>
		</div>
		-->
		
	</div>
	<!-- end wrapper page -->
@endsection
