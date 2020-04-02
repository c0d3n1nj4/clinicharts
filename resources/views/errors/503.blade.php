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
	
	503
	
	@endsection