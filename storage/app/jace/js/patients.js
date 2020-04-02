$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	$('#birth-date').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });		
	$('#birth-date-edit').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });			
	$('#visit-date').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#visit-date-edit').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });
	$('#first_vaccine').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#second_vaccine').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#third_vaccine').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#booster_one').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#booster_two').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	$('#booster_three').datepicker({ format: 'yyyy-mm-dd', todayHighlight: true });	
	
	// Datatable #patients-datatable		 	
	$('#patients-datatable').DataTable({ 
		"ajax": {
			"url": "/get-existing-patients",
			"data": function(d) {	
				// console.log(d);
				d.showReserveButton = $('#patients-datatable').attr('data-reserve')
			}
		},
		"columns": [
			{"data": "avatar"}, 
			{"data": "name"}, 
			{"data": "gender"},
			{"data": "birth_date"},
			{"data": "blood_type"},
			{"data": "address"},
			{"data": "school"}, 
			{"data": "father_name"},
			{"data": "mother_name"},
			{"data": "contact_num"},
			{"data": "insurance"},
			{"data": "actions"}
		],
		columnDefs: [
			{ width: 200, targets: 11 },
			{ className: "text-center", targets: 0 }
		],			
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]],
		dom: "Bfrtip",
		buttons: [
			{extend: "copy", className: "btn-sm", exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}}, 
			{extend: "csv", className: "btn-sm", exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}}, 
			{extend: "excel", className: "btn-sm", exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}}, 
			{extend: "pdf", className: "btn-sm", exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}}, 
			{extend: "print", className: "btn-sm", exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}}
		],
		responsive: !0		
	});	
	// example_table.ajax.reload();
	
	// Delete Patient
	$('#patients-datatable').on('click', ".btn-delete-patient", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted patients will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete patient!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-patient',
					dataType: 'json',
					data: {
						'_method':'POST',
						'_token':CSRF_TOKEN, 
						'id':id
					},
					success: function (res) {	
					},
					error: function(msg){
						console.log(msg);
					}				
				});	
				
				swal("Patient Deleted!", "Patient records now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Patient records still exists on database.", "error");
			}
		});
	});	
	
	// Reserve Patient
	$('#patients-datatable').on('click', ".btn-reserve-patient", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$.ajax({
			type: "POST",
			url: '/insert-reservation',
			dataType: 'html',
			data: {
				'_method':'POST',
				'_token':CSRF_TOKEN, 
				'id':that.attr("data-id")
			},
			success: function (res) {	
				that.closest('tr').attr('style', 'background-color: #ccffcc !important');
				that.closest('tr').fadeIn("slow");	
				location.href='/';	
				/*
				$("#add-notes-modal").hide();
				swal({
					title: "Notes successfully added!",
					text: "Page will reload after closing this window.",
					type: "success",
					//timer: 3000,
					showConfirmButton: true
				}, function (isConfirm) {
					if (isConfirm) location.reload();
          else location.reload();
				});		
				*/				
			},
			error: function(msg){
				console.log(msg);
			}				
		});		
	});	
	
	// Edit Patient
	$('#patients-datatable').on('click', ".btn-edit-patient", function(e) {	
		$("#edit-patient-modal input[name='id']").val($(this).attr('data-id'));
		$("#edit-patient-modal input[name='first_name']").val($(this).attr('data-fname'));
		$("#edit-patient-modal input[name='middle_name']").val($(this).attr('data-mname'));
		$("#edit-patient-modal input[name='last_name']").val($(this).attr('data-lname'));
		
		if ($(this).attr('data-gender') == 'M') $('#gender-male').prop('checked', true);
		else $('#gender-female').prop('checked', true);
		
		$("#edit-patient-modal input[name='birth_date']").val($(this).attr('data-bdate'));
		$("#edit-patient-modal textarea#address").text($(this).attr('data-address'));
		$("#edit-patient-modal input[name='school']").val($(this).attr('data-school'));
		$("#edit-patient-modal input[name='father_name']").val($(this).attr('data-father-name'));
		$("#edit-patient-modal input[name='mother_name']").val($(this).attr('data-mother-name'));
		$("#edit-patient-modal input[name='contact_num']").val($(this).attr('data-contact-num'));
		$("#edit-patient-modal select[name='blood_types_id']").val($(this).attr('data-blood-types-id'));
		$("#edit-patient-modal select[name='insurance_id']").val($(this).attr('data-insurance-id'));
	});		
	
	/************************************ VISITS ************************************/
	// Datatable #patient-visits-datatable		 	
	$('#patient-visits-datatable').DataTable({ 
		"ajax": {
			"url": "/get-patient-visits",
			"data": function(d) {	
				d.patientId = $('#patient-visits-datatable').attr('data-patient-id')
			}
		},
		"columns": [
			{"data": "date_of_visit"}, 
			{"data": "age"}, 
			{"data": "temperature"},
			{"data": "weight"},
			{"data": "height"},
			{"data": "complaints"}, 
			{"data": "physician_findings"},
			{"data": "treatment"},
			{"data": "charge_fee"},
			{"data": "actions"}
		],
		columnDefs: [
			{ width: 110, targets: 9 }
			/* { className: "text-center", targets: 0 } */
		],			
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]		
	});	
	
	// Delete Patient Visit
	$('#patient-visits-datatable').on('click', ".btn-delete-patient-visit", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted patient visit will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete patient visit!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-patient-visit',
					dataType: 'json',
					data: {
						'_method':'POST',
						'_token':CSRF_TOKEN, 
						'id':id
					},
					success: function (res) {	
					},
					error: function(msg){
						console.log(msg);
					}				
				});	
				
				swal("Patient Visit Deleted!", "Patient visit record now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Patient visit record still exists on database.", "error");
			}
		});
	});		

	// Edit Patient Visit
	$('#patient-visits-datatable').on('click', ".btn-edit-patient-visit", function(e) {	
		$("#edit-patient-visit-modal input[name='id']").val($(this).attr('data-id'));
		$("#edit-patient-visit-modal input[name='patient_id']").val($(this).attr('data-patient-id'));
		$("#edit-patient-visit-modal input[name='age']").val($(this).attr('data-age'));
		$("#edit-patient-visit-modal input[name='temperature']").val($(this).attr('data-temperature'));
		if ($(this).attr('data-temperature-type') == 'C') $('#temperature_type_c').prop('checked', true);
		else $('#temperature_type_f').prop('checked', true);

		$("#edit-patient-visit-modal input[name='weight']").val($(this).attr('data-weight'));
		if ($(this).attr('data-weight-type') == 'KG') $('#weight_type_kg').prop('checked', true);
		else $('#weight_type_lbs').prop('checked', true);
		
		$("#edit-patient-visit-modal input[name='height']").val($(this).attr('data-height'));
		if ($(this).attr('data-height-type') == 'C') $('#height_type_inches').prop('checked', true);
		else $('#height_type_cm').prop('checked', true);
		
		$("#edit-patient-visit-modal textarea#complaints").text($(this).attr('data-complaints'));
		$("#edit-patient-visit-modal textarea#physician_findings").text($(this).attr('data-physician-findings'));
		$("#edit-patient-visit-modal textarea#treatment").text($(this).attr('data-treatment'));
		$("#edit-patient-visit-modal input[name='date_of_visit']").val($(this).attr('data-date-of-visit'));		
		
		$("#edit-patient-visit-modal input[name='charge']").val($(this).attr('data-charge'));
		$("#edit-patient-visit-modal input[name='insurance']").val($(this).attr('data-insurance'));
	});	

	/************************************ BIRTH HISTORY ************************************/	
	
	/* Edit Patient Birth History
	$('#update-patient-birth-history-btn').on('click', function(e) {	
		$("#update-patient-birth-history-modal input[name='id']").val($(this).attr('data-id'));
		$("#update-patient-birth-history-modal input[name='patient_id']").val($(this).attr('data-patient-id'));
		$("#update-patient-birth-history-modal input[name='age']").val($(this).attr('data-age'));
		$("#update-patient-birth-history-modal input[name='temperature']").val($(this).attr('data-temperature'));
		if ($(this).attr('data-temperature-type') == 'C') $('#temperature_type_c').prop('checked', true);
		else $('#temperature_type_f').prop('checked', true);

		$("#update-patient-birth-history-modal input[name='weight']").val($(this).attr('data-weight'));
		if ($(this).attr('data-weight-type') == 'KG') $('#weight_type_kg').prop('checked', true);
		else $('#weight_type_lbs').prop('checked', true);
		
		$("#update-patient-birth-history-modal input[name='height']").val($(this).attr('data-height'));
		if ($(this).attr('data-height-type') == 'C') $('#height_type_inches').prop('checked', true);
		else $('#height_type_cm').prop('checked', true);
		
		$("#update-patient-birth-history-modal textarea#complaints").text($(this).attr('data-complaints'));
		$("#update-patient-birth-history-modal textarea#physician_findings").text($(this).attr('data-physician-findings'));
		$("#update-patient-birth-history-modal textarea#treatment").text($(this).attr('data-treatment'));
		$("#update-patient-birth-history-modal input[name='date_of_visit']").val($(this).attr('data-date-of-visit'));		
		
		$("#update-patient-birth-history-modal input[name='charge']").val($(this).attr('data-charge'));
		$("#update-patient-birth-history-modal input[name='insurance']").val($(this).attr('data-insurance'));
	});	
	*/

	/************************************ IMMUNIZATIONS ************************************/	
	// Select2
  $(".select2").select2();
	
	// Datatable #immunization-records-datatable		 	
	$('#immunization-records-datatable').DataTable({ 
		"ajax": {
			"url": "/get-patient-immunizations",
			"data": function(d) {	
				d.patientId = $('#immunization-records-datatable').attr('data-patient-id')
			}
		},
		"columns": [
			{"data": "vaccines"}, 
			{"data": "first"}, 
			{"data": "second"},
			{"data": "third"},
			{"data": "booster_one"},
			{"data": "booster_two"}, 
			{"data": "booster_three"},
			{"data": "other_vaccine"},
			{"data": "reaction"},
			{"data": "actions"}
		],
		columnDefs: [
			{ width: 110, targets: 9 }
		],			
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]		
	});		
	
	// Edit Patient Immunization
	$('#immunization-records-datatable').on('click', ".btn-edit-patient-immunization", function(e) {	
		$("#edit-patient-immunization-modal input[name='id']").val($(this).attr('data-id'));
		
		// https://stackoverflow.com/questions/25187926/how-to-set-selected-value-of-jquery-select2
		var values = $(this).attr('data-vaccines');
		var vaccines = [];
		$.each(values.split(","), function(i,e){
			vaccines.push(parseInt(e));
		});		
		$("#edit-patient-immunization-modal #edit-vaccines").val(vaccines).trigger("change");
	
		$("#edit-patient-immunization-modal input[name='first']").val($(this).attr('data-first'));
		$("#edit-patient-immunization-modal input[name='second']").val($(this).attr('data-second'));
		$("#edit-patient-immunization-modal input[name='third']").val($(this).attr('data-third'));	
		$("#edit-patient-immunization-modal input[name='booster_one']").val($(this).attr('data-booster-one'));	
		$("#edit-patient-immunization-modal input[name='booster_two']").val($(this).attr('data-booster-two'));	
		$("#edit-patient-immunization-modal input[name='booster_three']").val($(this).attr('data-booster-three'));		
		$("#edit-patient-immunization-modal textarea#other_vaccine").text($(this).attr('data-other-vaccine'));
		$("#edit-patient-immunization-modal textarea#reaction").text($(this).attr('data-reaction'));
	});		
	
	// Delete Patient Immunization
	$('#immunization-records-datatable').on('click', ".btn-delete-patient-immunization", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted patient immunization will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete patient immunization!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-patient-immunization',
					dataType: 'json',
					data: {
						'_method':'POST',
						'_token':CSRF_TOKEN, 
						'id':id
					},
					success: function (res) {	
					},
					error: function(msg){
						console.log(msg);
					}				
				});	
				
				swal("Patient Immunization Deleted!", "Patient immunization record now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Patient immunization record still exists on database.", "error");
			}
		});
	});		
	
	// TableManageButtons.init();
	/*
	// Buttons Copy|CSV|Excel|PDF|Print
	var handleDataTableButtons = function () {
		"use strict";
		0 !== $("#patients-datatable").length && $("#patients-datatable").DataTable({
			dom: "Bfrtip",
			buttons: [{extend: "copy", className: "btn-sm"}, {extend: "csv", className: "btn-sm"}, {
				extend: "excel",
				className: "btn-sm"
			}, {extend: "pdf", className: "btn-sm"}, {extend: "print", className: "btn-sm"}],
			responsive: !0
		})
	}, TableManageButtons = function () {
		"use strict";
		return {
			init: function () {
				handleDataTableButtons()
			}
		}
	}();	
	*/
});

