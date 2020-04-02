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

		<title>Clinic Management System</title>
		
		<!-- DataTables -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />		
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />		
		
		<!-- Plugins css-->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
			
		<!-- Sweet Alert css -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />		

		<!-- Form Uploads -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
		
		<!-- Datepicker -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">	

		<!-- Multiple Select -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet">			
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/css/select2.css') }}" rel="stylesheet">			
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/css/select2-bootstrap.css') }}" rel="stylesheet">			
		
		<!-- Calendar -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/fullcalendar/dist/fullcalendar.css') }}" rel="stylesheet">
		
		<!-- App css -->
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/storage/app/jace/css/main.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/themes/Adminto1.6/Horizontal/assets/css/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />		
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
		
		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/modernizr.min.js') }}"></script>
	</head>
	<body>

		<!-- Main Header -->
		@include('layouts.header') 
	
		<!-- Begin page -->
		<div class="wrapper">
			@yield('content')
		</div>	
		<!-- END wrapper -->

		<!-- Footer -->
		@include('layouts.footer')
		<!-- ./wrapper -->		
			
		<script>
				var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/detect.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/fastclick.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.blockUI.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/waves.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.nicescroll.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.slimscroll.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.scrollTo.min.js') }}"></script>
				<!-- Jquery-Ui -->
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

		<!-- Plugins Js -->
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/moment/moment.js') }}"></script>
		
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/pace.min.js') }}"></script>	
		
		<!-- KNOB JS -->
		<!--[if IE]>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/jquery-knob/excanvas.js') }}"></script>
		<![endif]-->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
	
    <!--Chartist Chart-->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/chartist/dist/chartist.min.js') }}"></script>
		<!-- https://codepen.io/k3no/pen/ozvKyX -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/chartist/dist/chartist-plugin-pointlabels-jc.js') }}"></script>	
	
		<!-- Modal-Effect --> 
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/custombox/dist/custombox.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/custombox/dist/legacy.min.js') }}"></script>		
	
		<!-- File uploads js -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/fileuploads/js/dropify.min.js') }}"></script>
		<script src="{{ asset('/public/assets/js/jquery.upload.js') }}"></script>
		
		<!-- Datatables-->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/jszip.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/pdfmake.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/vfs_fonts.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/buttons.print.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
		
		<!-- Editable Datatables-->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>	
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>	
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>	
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/tiny-editable/mindmup-editabletable.js') }}"></script>	
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/tiny-editable/numeric-input-example.js') }}"></script>			
	
		<!-- Sweet Alert js -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>							

		<!-- Datepicker -->
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
		
		<!-- Summernote -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/summernote/dist/summernote.min.js') }}"></script>
		
		<!-- Inbox/Compose Email -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/pages/jquery.inbox.js') }}"></script>		
		
		<!-- Multiple Select -->
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
		
		<!-- Calendar -->
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/moment/moment.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/plugins/fullcalendar/dist/fullcalendar.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/themes/Adminto1.6/Horizontal/assets/pages/jquery.fullcalendar.js') }}"></script>
				
		<!-- App js -->
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.core.js') }}"></script>
		<script src="{{ asset('/themes/Adminto1.6/Horizontal/assets/js/jquery.app.js') }}"></script>
		
		<!-- Jace js -->
		<script src="{{ asset('/storage/app/jace/js/main.js') }}"></script>		
		<script src="{{ asset('/storage/app/jace/js/dashboard.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/patients.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/reservations.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/blood-types.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/allergies.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/insurance.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/vaccines.js') }}"></script>	
		<script src="{{ asset('/storage/app/jace/js/appointment.js') }}"></script>	
	</body>
</html>