$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// Datatable #vaccines-datatable		 	
	$('#vaccines-datatable').DataTable({ 
		"ajax": {
			"url": "/get-existing-vaccines",
			"data": function(json) {
				return json;
			}
		},
		"columns": [
			{"data": "name"},
			{"data": "actions"}
		],
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]		
	});	
	
	// Delete vaccine
	$('#vaccines-datatable').on('click', ".btn-delete-vaccine", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted vaccine records will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete vaccine record!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-vaccine',
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
				
				swal("Vaccine Record Deleted!", "Vaccine records now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Vaccine records still exists on database.", "error");
			}
		});
	});	
	
	// Update vaccine
	$('#vaccines-datatable').on('click', ".btn-update-vaccine", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$("#update-vaccine-modal input[name='id']").val(that.attr('data-id'));
		$("#update-vaccine-modal input[name='new-vaccine']").val(that.attr('data-name'));
	});		
});