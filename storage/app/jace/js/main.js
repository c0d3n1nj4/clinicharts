$(function() {	
	var baseurl = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	/* customer-order-tracking
	$("table[id^='customer-orders-tbl']").DataTable({ 
		"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]			
	});
	*/
	
	$('#estimated-arrival-date').datepicker({	
		format: 'yyyy-mm-dd',
		opens: 'left',
		drops: 'down',
		autoclose: true,
		todayHighlight: true
	});
	
	$('#estimated-arrival-date-update').datepicker({	
		format: 'yyyy-mm-dd',
		opens: 'left',
		drops: 'down',
		autoclose: true,
		todayHighlight: true
	});	
	
	// Update
	$('.btn-update-shipment').click ( function(e) {
		var shipmentId = $(this).attr('shipment-id');
		e.preventDefault();
		
		$.ajax({
			type: "GET",
			url: '/dashboard/get-shipment-by-id',
			dataType: 'json',
			data: {
				'_method':'GET',
				'_token':CSRF_TOKEN, 
				'shipmentId':shipmentId
			},
			success: function (res) {
				$("#update-shipment-modal input[name='shipment_id']").val(res.id);
				$("#update-shipment-modal input[name='shipment_name']").val(res.shipment_name);
				$("#update-shipment-modal input[name='estimated_arrival_date']").val(res.estimated_arrival_date);
				$("#update-shipment-modal select[name='shipment_status']").val(res.shipment_status);
			},
			error: function(msg){
				console.log(msg); 
			}				
		});						
	});
	
	// Delete
	$('.btn-delete-shipment').click( function(e) {
		var shipmentId = $(this).attr('shipment-id');
		e.preventDefault();
		
		$.ajax({
			type: "POST",
			url: '/dashboard/delete-shipment',
			dataType: 'html',
			data: {
				'_method':'POST',
				'_token':CSRF_TOKEN, 
				'shipmentId':shipmentId
			},
			success: function (res) {
				location.reload();
			},
			error: function(msg){
				console.log(msg); 
			}				
		});				
	});				
	// /customer-order-tracking
});