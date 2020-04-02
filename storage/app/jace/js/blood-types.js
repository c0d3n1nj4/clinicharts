$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// Datatable #blood-types-datatable		 	
	$('#blood-types-datatable').DataTable({ 
		"ajax": {
			"url": "/get-existing-blood-types",
			"data": function(json) {
				return json;
			}
		},
		"columns": [
			{"data": "blood_type"},
			{"data": "actions"}
		],
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]		
	});	
	
	// Delete blood type
	$('#blood-types-datatable').on('click', ".btn-delete-blood-type", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted blood type records will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete blood type record!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-blood-type',
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
				
				swal("Blood Type Record Deleted!", "Blood type records now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Blood type records still exists on database.", "error");
			}
		});
	});	
	
	// Update blood type
	$('#blood-types-datatable').on('click', ".btn-update-blood-type", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$("#update-blood-type-modal input[name='id']").val(that.attr('data-id'));
		$("#update-blood-type-modal input[name='new-blood-type']").val(that.attr('data-blood-type'));
	});		
});