/**
* Theme: Adminto Admin Template
* Author: Coderthemes
* Component: Full-Calendar
* 
*/

!function($) {
	"use strict";

	var CalendarApp = function() {
			this.$body = $("body")
			this.$modal = $('#event-modal'),
			this.$event = ('#external-events div.external-event'),
			this.$calendar = $('#calendar'),
			this.$saveCategoryBtn = $('.save-category'),
			this.$categoryForm = $('#add-category form'),
			this.$extEvents = $('#external-events'),
			this.$calendarObj = null,
			this.$defaultView = 'agendaWeek'
	};

	/* on drop 
	CalendarApp.prototype.onDrop = function (eventObj, date) { 
			var $this = this;
					// retrieve the dropped element's stored Event Object
					var originalEventObject = eventObj.data('eventObject');
					var $categoryClass = eventObj.attr('data-class');
					// we need to copy it, so that multiple events don't have a reference to the same object
					var copiedEventObject = $.extend({}, originalEventObject);
					// assign it the date that was reported
					copiedEventObject.start = date;
					if ($categoryClass)
							copiedEventObject['className'] = [$categoryClass];
					// render the event on the calendar
					$this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
					// is the "remove after drop" checkbox checked?
					if ($('#drop-remove').is(':checked')) {
							// if so, remove the element from the "Draggable Events" list
							eventObj.remove();
					}
	},
	*/
	
	/* on click on event */
	CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
		var $this = this;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var form = $("<form id='frm-update-patient-appointment' method='POST'></form>");
		form.prepend('<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">');
		form.append("<input type='hidden' name='data-id' />");
		//form.append("<input type='hidden' name='patient-id' />");
		//form.append("<input type='hidden' name='patient-name' />");
		form.append('<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id=""><thead><tr><th>Name</th><th>Time</th></tr></thead><tbody><tr><td><span id="pName"></span></td><td><span id="aTime"></span></td></tr></tbody><tfoot><tr><th>Name</th><th>Time</th></tr></tfoot></table>')
		//form.append("<label>Change event info</label>");
		//form.append("<div class='input-group'><input class='form-control' type='text' name='event-info'  value='" + calEvent.event + "' /><span class='input-group-btn'><button type='button' class='btn btn-success waves-effect waves-light' id='btn-update-event'><i class='fa fa-check'></i> Save</button></span></div>");
		form.append('<button type="button" class="btn btn-danger waves-effect waves-light m-t-20 pull-left" id="btn-delete-event">Delete</button>');			
		$this.$modal.modal({
			backdrop: 'static'
		});
		
		/*			$this.$modal.find('#btn-delete-event').show().end().find('.modal-body').empty().prepend(form).end().find('#btn-delete-event').unbind('click').click(function (e) {
				$this.$calendarObj.fullCalendar('removeEvents', function (ev) {
						return (ev._id == calEvent._id);
				});
				$this.$modal.modal('hide');
				
		});
		*/
		$this.$modal.find('#patients-name-datatable_wrapper').hide();
		$this.$modal.find('.modal-body').empty().prepend(form).end();
		
		//$this.$modal.find('#btn-update-event').on('click', function (e) {
		//	e.preventDefault();
		//	$('#frm-update-patient-appointment').attr('action', "/update-appointment").submit();
		//});	

		$this.$modal.find('#btn-delete-event').on('click', function (e) {
			e.preventDefault();
			console.log('Delete');
			$('#frm-update-patient-appointment').attr('action', "/delete-appointment").submit();
		});				
		
		/*
		$this.$modal.find('form#frm-update-patient-appointment').on('submit', function () {
				calEvent.title = form.find("input[type=text]").val();
				$this.$calendarObj.fullCalendar('updateEvent', calEvent);
				$this.$modal.modal('hide');
				return false;
		});
		*/
		this.$modal.find('form#frm-update-patient-appointment input[name="data-id"]').val(calEvent.id);
		this.$modal.find('form#frm-update-patient-appointment #pName').html(calEvent.title);
		this.$modal.find('form#frm-update-patient-appointment #aTime').html(moment(calEvent.start).format('h:mm a') + ' - ' + moment(calEvent.end).format('h:mm a'));
		console.log(calEvent);
	},
	
	/* on select */
	CalendarApp.prototype.onSelect = function (start, end, allDay) {
		console.log(start);
		console.log(end);
		var $this = this;
				$this.$modal.modal({
						backdrop: 'static'
				});
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				var form = $("<form id='frm-add-patient-appointment' method='POST' action='/insert-appointment'></form>");
				form.prepend('<input type="hidden" name="_token" value="'+CSRF_TOKEN+'">');
				form.append("<div class='row'></div>");
				form.find(".row")
						.append("<input type='hidden' name='patient-id' />")
						.append("<input type='hidden' name='patient-name' />")
						.append("<input type='hidden' name='start' />")
						.append("<input type='hidden' name='end' />")
						/*.append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Info</label><input class='form-control' placeholder='Insert Event Info' type='text' name='event'/></div></div>")
						.append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Importance</label><select class='form-control' name='importance'></select></div></div>")
						.find("select[name='importance']")
						.append("<option value='bg-danger'>Important</option>")

						.append("<option value='bg-success'>Success</option>")
						.append("<option value='bg-purple'>Purple</option>")
						.append("<option value='bg-primary'>Primary</option>")
						.append("<option value='bg-pink'>Pink</option>")
						.append("<option value='bg-info'>Info</option>")

						.append("<option value='bg-primary'>Normal</option></div></div>");
				form.append('<button type="submit" class="btn btn-success save-event waves-effect waves-light" id="btn-create-event" disabled="disabled">Create event</button>');	
					//$('#btn-create-event').appendTo($('#frm-add-patient-appointment'));
				*/
				$this.$modal.find('#patients-name-datatable_wrapper').slideDown();
				$this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
					form.submit();
				});
				
				/*
				$this.$modal.find('form#frm-add-patient-appointment').on('submit', function () {
						var beginning = form.find("input[name='beginning']").val();
						var ending = form.find("input[name='ending']").val();
						$("#frm-add-patient-appointment input[name='start']").val(start.format());
						$("#frm-add-patient-appointment input[name='end']").val(end.format());
						return true;                
				});						
				*/

				$this.$modal.find('form#frm-add-patient-appointment').on('submit', function () {
						form.find("input[name='start']").val(moment(start).format());
						form.find("input[name='end']").val(moment(end).format());
						var pName = form.find("input[name='patient-name']").val();
						var categoryClass = form.find("select[name='importance'] option:checked").val();
						//var beginning = form.find("input[name='beginning']").val();
						//var ending = form.find("input[name='ending']").val();
						//if (event !== null && event.length != 0) {
								$this.$calendarObj.fullCalendar('renderEvent', {
										title: pName,
										start: start,
										end: end,
										allDay: false,
										className: categoryClass
								}, true);  
								$this.$modal.modal('hide');
						//}
						//else{
						//		alert('You have to give a title to your event');
						//}
						return true;
						
				});
				$this.$calendarObj.fullCalendar('unselect');

	},
	CalendarApp.prototype.enableDrag = function() {
		//init events
		$(this.$event).each(function () {
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
	}
	
	/* Initializing */
	CalendarApp.prototype.init = function() {
		this.enableDrag();
		
		/*  Initialize the calendar  */
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var form = '';
		var today = new Date($.now());
		var defaultEvents = null;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		function ajaxCallBack(data) {
			defaultEvents = data;
		}
		
		$.ajax({
			type: "GET",
			url: '/get-appointments',
			dataType: 'json',
			async: false,
			data: {
				'_method':'GET',
				'_token':CSRF_TOKEN 
			},
			/*
			success: function (data) {
				ajaxCallBack(data);
				console.log(defaultEvents);

				$.each(data, function(i, item) {
					defaultEvents.push({
						title: item.event,
						start: new Date($.now() + 158000000),
						className: item.importance
					});	
				});
				console.log(defaultEvents);

			},
			*/
			success: ajaxCallBack,
			error: function(msg){
				console.log(msg); 
			}				
		});						
		
		//console.log(defaultEvents);
		
		/*
		var defaultEvents =  [
				{
						title: 'Hey!',
						start: new Date($.now() + 158000000),
						className: 'bg-purple'
				},
				{
						title: 'See John Deo',
						start: today,
						end: today,
						className: 'bg-danger'
				},
				{
						title: 'Buy a Theme',
						start: new Date($.now() + 338000000),
						className: 'bg-primary'
				}];
		console.log(defaultEvents);
		*/
		
		var $this = this;
		$this.$calendarObj = $this.$calendar.fullCalendar({
				slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
				minTime: '08:00:00',
				maxTime: '19:00:00',  
				defaultView: 'agendaWeek',  
				handleWindowResize: true,   
				height: $(window).height() - 200,   
				header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
				},
				events: defaultEvents,
				eventRender: function (event, element) {
					//element.attr('data-id', event.id);
					element.attr('title', event.event);
					element.attr('event-start', event.start);
					element.attr('event-end', event.end);
				},			
				// https://fullcalendar.io/docs/eventResize
				eventResize: function (event, delta, revertFunc) {				
					$.ajax({
						type: "POST",
						url: '/update-appointment-by-drag',
						dataType: 'json',
						data: {
							'_method': 'POST',
							'_token': CSRF_TOKEN,
							'id': event.id,
							'start': event.start.format(),
							'end': event.end.format()
						},
						success: function (res) {	
							console.log(res.success); 
						},
						error: function(msg){
							console.log(msg); 
							revertFunc();
						}				
					});		
				},
				eventDrop: function (event, delta, revertFunc) {				
					$.ajax({
						type: "POST",
						url: '/update-appointment-by-drag',
						dataType: 'json',
						data: {
							'_method': 'POST',
							'_token': CSRF_TOKEN,
							'id': event.id,
							'start': event.start.format(),
							'end': event.end.format()
						},
						success: function (res) {	
							console.log(res.success); 
						},
						error: function(msg){
							console.log(msg); 
							revertFunc();
						}				
					});		
				},				
				editable: true,
				droppable: true, // this allows things to be dropped onto the calendar !!!
				eventLimit: true, // allow "more" link when too many events
				selectable: true,
				drop: function(date) { $this.onDrop($(this), date); },
				select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
				eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
		});

		/* on new event
		this.$saveCategoryBtn.on('click', function(){
				var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
				var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
				if (categoryName !== null && categoryName.length != 0) {
						$this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-move"></i>' + categoryName + '</div>')
						$this.enableDrag();
				}

		});
		*/
	},

 //init CalendarApp
	$.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
  "use strict";
  $.CalendarApp.init();
}(window.jQuery);
