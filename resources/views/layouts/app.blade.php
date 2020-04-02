<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Clinic Management System">
		<meta name="Nanny Annie" content="Clinic Management System">

		<!-- App Favicon -->
		<link rel="shortcut icon" href="{{ asset('/themes/Adminto1.6/Horizontal/assets/images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">		
		
		<!-- App title -->
		<title>{{ config('app.name', 'Clinic Management System') }}</title>

		<!-- App CSS -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/core.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/components.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/icons.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/pages.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/menu.css') }}" rel='stylesheet' type='text/css' />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/responsive.css') }}" rel='stylesheet' type='text/css' />	
		<link href="{{ asset('/storage/app/jace/css/main.css') }}" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/modernizr.min.js') }}"></script>
		
    <!-- csrf_token -->
    <script>
			window.Laravel = {!! json_encode([
				'csrfToken' => csrf_token(),
			]) !!};
    </script>			
	</head>
	<body>
		@yield('content')
		
		<script>
			var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/detect.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/fastclick.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.slimscroll.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.blockUI.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/waves.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/wow.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.nicescroll.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.scrollTo.min.js') }}"></script>

		<!-- App js -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.core.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.app.js') }}"></script>
	</body>
</html>