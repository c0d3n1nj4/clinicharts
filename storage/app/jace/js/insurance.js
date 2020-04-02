$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// Datatable #insurance-datatable		 	
	$('#insurance-datatable').DataTable({ 
		"ajax": {
			"url": "/get-existing-insurance",
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
	
	// Delete insurance
	$('#insurance-datatable').on('click', ".btn-delete-insurance", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted insurance records will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete insurance record!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-insurance',
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
				
				swal("Insurance Record Deleted!", "Insurance records now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Insurance records still exists on database.", "error");
			}
		});
	});	
	
	// Update insurance
	$('#insurance-datatable').on('click', ".btn-update-insurance", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$("#update-insurance-modal input[name='id']").val(that.attr('data-id'));
		$("#update-insurance-modal input[name='insurance-name']").val(that.attr('data-insurance-name'));
	});		
});