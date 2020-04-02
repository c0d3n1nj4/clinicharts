<!-- Footer -->
<footer class="footer text-right">
	<div class="container">
		<div class="row">
			<div class="col-xs-6">
				Copyright &copy; 2018. <a href="http://cms.devclutch.com">Clinic Management System</a>. All rights reserved.
			</div>
			<div class="col-xs-6">
				<div class="pull-right">
					@php
						$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
						echo 'Page Load Time: '.$executionTime.' second(s)';
					@endphp	
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End Footer -->