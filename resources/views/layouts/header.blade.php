@php 
	$un = Auth::user()->username; 
	$uId = Auth::user()->id; 
	$name = Auth::user()->firstname . ' ' . Auth::user()->lastname; 
	#dd( Auth::user() );
@endphp

<!-- Navigation Bar-->
<header id="topnav">
	<div class="topbar-main">
		<div class="container">

			<!-- LOGO -->
			<div class="topbar-left">
					<a href="/" class="logo"><img src="{{ asset('/public/assets/img/logo-32x32.png') }}" /> <span id="logo-text">Clinic Management System</span></a> 
			</div>
			<!-- End Logo container-->

			<div class="menu-extras">
				<ul class="nav navbar-nav navbar-right pull-right">
					<!--
					<li>
						<form role="search" class="navbar-left app-search pull-left hidden-xs">
							<input type="text" placeholder="Search..." class="form-control">
							<a href=""><i class="fa fa-search"></i></a>
						</form>
					</li>
					-->
					<li class="dropdown user-box">
						<a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
						<?=$name?>&nbsp;<span class="fa fa-user-circle"></span>	
							
							<div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
						</a>

						<ul class="dropdown-menu">
							
							<li><a href="<?= url('/user-management/'.$uId.'/edit') ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
							<!--
							<li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
							<li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
							-->
							<li class="divider"></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-5"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
				
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
				
				<div class="menu-item">
					<!-- Mobile menu toggle-->
					<a class="navbar-toggle">
						<div class="lines">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</a>
					<!-- End mobile menu toggle-->
				</div>
			</div> <!-- /menu-extras -->

		</div> <!-- /container -->
	</div> <!-- /topbar-main -->

	<div class="navbar-custom">
		<div class="container">
			<div id="navigation">
				<!-- Navigation Menu-->
				<ul class="navigation-menu">
					<li><a href="/"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a></li>
					<li><a href="/patients"><i class="zmdi zmdi-assignment"></i> <span> Patient Records </span> </a></li>
					<li><a href="/reservations"><i class="zmdi zmdi-alarm"></i> <span> Reservations </span> </a></li>
					@if (Auth::user()->admin) 
					<li><a href="/appointments"><i class="zmdi zmdi-calendar-note"></i> <span> Appointments </span> </a></li>
					@endif	
					
					<li><a href="/show-reports"><i class="zmdi zmdi-chart"></i> <span> Reports </span> </a></li>
					<li class="has-submenu">
						<a href="#"><i class="zmdi zmdi-settings"></i><span> Settings </span> </a>
						<ul class="submenu">
							<li><a href="/blood-types">Blood Types</a></li>
							<li><a href="/allergies">Allergies</a></li>
							<li><a href="/insurance">Insurance</a></li>
							<li><a href="/vaccines">Vaccines</a></li>
						</ul>
					</li>					
					
					@if (Auth::user()->admin) 
					<li><a href="{{ route('user-management.index') }}"><i class="zmdi zmdi-accounts"></i> <span>User Management</span></a></li>			
					@endif	

					
				</ul>
				<!-- End navigation menu  -->
			</div> <!-- /navigation -->
		</div> <!-- /container -->
	</div> <!-- /navbar-custom -->
</header>
<!-- End Navigation Bar-->