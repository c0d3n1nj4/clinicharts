$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// Datatable #allergies-datatable		 	
	$('#allergies-datatable').DataTable({ 
		"ajax": {
			"url": "/get-existing-allergies",
			"data": function(json) {
				return json;
			}
		},
		"columns": [
			{"data": "description"},
			{"data": "actions"}
		],
		fixedHeader: true,
		autoWidth: false,
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]		
	});	
	
	// Delete allergy
	$('#allergies-datatable').on('click', ".btn-delete-allergy", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		swal({
			title: "Are you sure?",
			text: "Deleted allergy records will be removed from database.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete allergy record!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				var id = that.attr('data-id');		
				
				$.ajax({
					type: "POST",
					url: '/delete-allergy',
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
				
				swal("Allergy Record Deleted!", "Allergy records now removed from database.", "success");	
				that.closest('tr').remove();
			} else {
				swal("Canceled!", "Allergy records still exists on database.", "error");
			}
		});
	});	
	
	// Update allergy
	$('#allergies-datatable').on('click', ".btn-update-allergy", function(e) {	
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var that = $(this);		
		e.preventDefault();
		
		$("#update-allergy-modal input[name='id']").val(that.attr('data-id'));
		$("#update-allergy-modal input[name='new-allergy']").val(that.attr('data-allergy'));
	});		
});