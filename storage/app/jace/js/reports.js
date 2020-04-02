$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	$('#report-date').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });
	$('#report-date').on('change', function() {
		$('#btn-report-date-submit').attr('href', '/by-date/'+$(this).val());
		$('#btn-report-date-submit').removeAttr('disabled');
	});
});

