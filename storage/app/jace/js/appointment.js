$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// Datatable #patients-name-datatable
	$('#patients-name-datatable').DataTable({ 
		"ajax": {
			"url": "/get-patients-name",
			"data": function(json) {
				return json;
			}
		},
		"columns": [
			{"data": "name"},
			{"data": "action"},
		],
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[10, 25, 50 -1], [10, 25, 50, "All"]]		
	});	
	
	// Insert patient
	$('#patients-name-datatable').on('click', ".btn-add-patient-appointment", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$("input[name='patient-id']").val(that.attr('data-id'));
		$("input[name='patient-name']").val(that.attr('data-name'));
		
		$("form#frm-add-patient-appointment").submit();	
/*		
		if ( $("input[name='patient-id']").val().length != 0 && $("input[name='event']").val().length != 0) {
			$('#btn-create-event').prop('disabled', false);
		}		
*/		
	});		
/*
	$("input[name='event']").on('input', function() {
		console.log('Changed');
	});	
*/	
	
	//$("form#frm-add-patient-appointment").bind('change keyup', $("input[name='event']"), function() {
	//	console.log('Changed');
	//	if ( $("input[name='patient-id']").val().length != 0 && $("input[name='event']").val().length != 0) {
	//		$('#btn-create-event').prop('disabled', false);
	//	} else {
	//		$('#btn-create-event').prop('disabled', true);
	//	}
	//});	
});