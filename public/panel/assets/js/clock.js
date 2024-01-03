$(function () {


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}

	function getMeridian(hours) {
		return (hours < 12) ? "AM" : "PM";
	}

	function startTime() {

		var today = new Date(),
			h = today.getHours(),
			m = checkTime(today.getMinutes()),
			s = checkTime(today.getSeconds());

		// Convert to 12-hour format
		h = (h > 12) ? h - 12 : h;
		h = (h === 0) ? 12 : h;

		var meridian = getMeridian(today.getHours());

		$('.time').text(h + ":" + m);
		$('.am-pm').text(meridian);

		// Update time every half second
		t = setTimeout(function () {
			startTime();
		}, 500);
	}

	// Start the clock
	startTime();






	// For Clockin and Clockout 
	let workTimerInterval;
	let breakTimerInterval;
	let workSeconds = 0;
	let workMinutes = 0;
	let workHours = 0;
	let breakSeconds = 0;
	let breakMinutes = 0;
	let breakHours = 0;

	$(document).ready(function () {
		$("#startButton").on("click", startWorkTimer);
		$("#breakButton").on("click", startBreakTimer);
		$("#continueButton").on("click", continueWorkTimer);
		$("#stopButton").on("click", stopTimer);
	});

	function startWorkTimer() {
		workTimerInterval = setInterval(updateWorkTimer, 1000);

		// Update work timer values with the latest values
		workHours = parseInt($("#start_timer").text().split(':')[0], 10);
		workMinutes = parseInt($("#start_timer").text().split(':')[1], 10);
		workSeconds = parseInt($("#start_timer").text().split(':')[2], 10);

		$("#start_timer").show();
		$("#startButton").hide();
		$("#breakButton").show();
		$("#stopButton").show();
		$("#startduration").show();
		$("#breakduration").hide();

		// Send start time to the backend
		let startTime = new Date().toISOString(); // Get the current time
		sendTimeData({ start_time: startTime, type: "work", work_status: "start" });

	}

	function updateWorkTimer() {
		workSeconds++;
		if (workSeconds >= 60) {
			workSeconds = 0;
			workMinutes++;
			if (workMinutes >= 60) {
				workMinutes = 0;
				workHours++;
			}
		}

		const formattedTime = pad(workHours) + ":" + pad(workMinutes) + ":" + pad(workSeconds);
		$("#start_timer").text(formattedTime);
	}

	function startBreakTimer() {
		clearInterval(workTimerInterval); // Stop the work timer
		breakTimerInterval = setInterval(updateBreakTimer, 1000);

		// Update break timer values with the latest values
		breakHours = parseInt($("#break_timer").text().split(':')[0], 10);
		breakMinutes = parseInt($("#break_timer").text().split(':')[1], 10);
		breakSeconds = parseInt($("#break_timer").text().split(':')[2], 10);

		$("#start_timer").hide();
		$("#break_timer").show();
		$("#breakButton").hide();
		$("#continueButton").show();
		$("#startduration").hide();
		$("#breakduration").show();
		let startTime = new Date().toISOString(); // Get the current time
		sendTimeData({ start_time: startTime, type: "break", work_status: "start" });
	}

	function updateBreakTimer() {
		breakSeconds++;
		if (breakSeconds >= 60) {
			breakSeconds = 0;
			breakMinutes++;
			if (breakMinutes >= 60) {
				breakMinutes = 0;
				breakHours++;
			}
		}

		const formattedTime = pad(breakHours) + ":" + pad(breakMinutes) + ":" + pad(breakSeconds);
		$("#break_timer").text(formattedTime);
	}

	function continueWorkTimer() {
		clearInterval(breakTimerInterval); // Stop the break timer

		// Update break timer values with the latest values
		breakHours = parseInt($("#break_timer").text().split(':')[0], 10);
		breakMinutes = parseInt($("#break_timer").text().split(':')[1], 10);
		breakSeconds = parseInt($("#break_timer").text().split(':')[2], 10);

		// Update work timer values with the latest values
		workHours = parseInt($("#start_timer").text().split(':')[0], 10);
		workMinutes = parseInt($("#start_timer").text().split(':')[1], 10);
		workSeconds = parseInt($("#start_timer").text().split(':')[2], 10);


		$("#start_timer").show();
		$("#break_timer").hide();
		$("#continueButton").hide();
		$("#breakButton").show();
		$("#startduration").show();
		$("#breakduration").hide();
		let startTime = new Date().toISOString(); // Get the current time
		sendTimeData({ start_time: startTime, type: "break", work_status: "stop" });
		startWorkTimer(); // Resume work timer
	}

	function stopTimer() {
		clearInterval(workTimerInterval);
		clearInterval(breakTimerInterval);

		// Get the stop time
		let stopTime = new Date().toISOString(); // Get the current time

		// Assign latest values to variables
		workHours = parseInt($("#start_timer").text().split(':')[0], 10);
		workMinutes = parseInt($("#start_timer").text().split(':')[1], 10);
		workSeconds = parseInt($("#start_timer").text().split(':')[2], 10);

		breakHours = parseInt($("#break_timer").text().split(':')[0], 10);
		breakMinutes = parseInt($("#break_timer").text().split(':')[1], 10);
		breakSeconds = parseInt($("#break_timer").text().split(':')[2], 10);

		// Capture the latest dynamic values before resetting the UI
		const latestWorkTime = pad(workHours) + ":" + pad(workMinutes) + ":" + pad(workSeconds);
		const latestBreakTime = pad(breakHours) + ":" + pad(breakMinutes) + ":" + pad(breakSeconds);


		// Calculate break duration
		let breakDuration = pad(breakHours) + ":" + pad(breakMinutes) + ":" + pad(breakSeconds);

		// Send stop time and break duration to the backend
		sendTimeData({ start_time: stopTime, break_hours: breakDuration, type: "work", work_status: "end" });

		// Reset timer and buttons in the UI
		// workSeconds = 0;
		// workMinutes = 0;
		// workHours = 0;
		// breakSeconds = 0;
		// breakMinutes = 0;
		// breakHours = 0;
		$("#start_timer").text(latestWorkTime);
		$("#break_timer").text(latestBreakTime);
		$("#start_timer").show();
		$("#break_timer").hide();
		$("#startButton").text("Continue Working");
		$("#startButton").show();
		$("#breakButton").hide();
		$("#continueButton").hide();
		$("#stopButton").hide();
		$("#startduration").show();
		$("#breakduration").hide();
	}

	function pad(value) {
		return value < 10 ? "0" + value : value;
	}


	function sendTimeData(data) {
		// data.timer_data = $("#timer").text();
		data.start_timer_data = $("#start_timer").text();
		data.break_timer_data = $("#break_timer").text();
		$.ajax({
			url: '/timelogs',
			method: 'POST',
			contentType: 'application/json',
			data: JSON.stringify(data),
			success: function (response) {
				console.log('Time data sent to backend:', response);
			},
			error: function (error) {
				console.error('Error sending time data:', error);
			}
		});
	}

	function previousWorkTimerGet() {
		$.ajax({
			type: 'POST',
			url: '/workhistory/previous-work-timer-get',
			success: function (data) {
				if (data.works.status !== "end") {
					// Open your modal here
					openModalWithData(data);
				} else {
					$('#myModal').modal('hide'); // Close the modal
				}
			},
		});
	}
	previousWorkTimerGet();

	function CurrentWorkTimeStore() {
		var visibleTimerId = '';
		let startTime = new Date().toISOString();
		// Check which timer is visible
		if ($('#start_timer').is(':visible')) {
			visibleTimerId = 'start_timer';
		} else if ($('#break_timer').is(':visible')) {
			visibleTimerId = 'break_timer';
		}

		// Get the time value from the visible timer
		var visibleTimerValue = $('#' + visibleTimerId).text();

		$.ajax({
			type: 'POST',
			url: '/workhistory/store-workstatus-page-refresh',
			data: {
				last_counter_times: visibleTimerValue,
				start_time: startTime
			},
			success: function (response) {
				// Handle the response if needed
				console.log(response);
			},
		});
	}



	$(window).on('beforeunload', function () {
		// Make an AJAX call before unloading the page
		CurrentWorkTimeStore();
		// return "You have unsaved changes. Are you sure you want to leave?";
	});

	currentWorkTimerGet();

	function currentWorkTimerGet() {
		$.ajax({
			type: 'POST',
			url: '/workhistory/current-work-timer-get',
			success: function (data) {
				if (data.status == 'start' && data.type == 'work') {
					const timerData = data.timer_data.split(':'); // Split timer data into hours, minutes, and seconds
					workHours = parseInt(timerData[0], 10); // Set hours
					workMinutes = parseInt(timerData[1], 10); // Set minutes
					workSeconds = parseInt(timerData[2], 10); // Set seconds

					// Update UI with timer data
					const formattedTime = pad(workHours) + ":" + pad(workMinutes) + ":" + pad(workSeconds);
					$("#start_timer").text(formattedTime);
					$("#start_timer").show();
					$("#break_timer").hide();
					$("#startButton").hide();
					$("#breakButton").show();
					$("#continueButton").hide();
					$("#stopButton").show();
					startWorkTimer();
				} else if (data.status == 'start' && data.type == 'break') {
					const timerData = data.timer_data.split(':'); // Split timer data into hours, minutes, and seconds
					breakHours = parseInt(timerData[0], 10); // Set hours
					breakMinutes = parseInt(timerData[1], 10); // Set minutes
					breakSeconds = parseInt(timerData[2], 10); // Set seconds

					// Update UI with timer data
					const formattedTime = pad(breakHours) + ":" + pad(breakMinutes) + ":" + pad(breakSeconds);
					$("#break_timer").text(formattedTime);
					$("#start_timer").hide();
					$("#break_timer").show();
					$("#startButton").hide();
					$("#breakButton").hide();
					$("#continueButton").show();
					$("#stopButton").show();
					startBreakTimer();
				} else if (data.status == null && data.type == null) {
					// Set variables to zero when both status and type are null
					workHours = 0;
					workMinutes = 0;
					workSeconds = 0;
					breakHours = 0;
					breakMinutes = 0;
					breakSeconds = 0;
					$("#start_timer").text("00:00:00");
					$("#break_timer").text("00:00:00");
					$("#start_timer").show();
					$("#break_timer").hide();
					$("#startButton").show();
					$("#breakButton").hide();
					$("#continueButton").hide();
					$("#stopButton").hide();
				}

				if (data.status == 'end' && data.type == 'work') {
					$("#startButton").text("Continue Working");
				}
			},
		});
	}

	function lastWorkTimerGet() {
		$.ajax({
			type: 'POST',
			url: '/workhistory/last-work-timer-get',
			success: function (data) {
				if (data.works.status !== "end") {
					// Open your modal here
					openModalWithData(data);
				} else {
					$('#myModal').modal('hide'); // Close the modal
				}
			},
		});
	}
	lastWorkTimerGet();

	function openModalWithData(data) {

		$('#myModal').modal('show');
		// Display specific fields in the input fields

		var timestamp = data.works.created_at;

		// Creating a Date object from the timestamp
		var date = new Date(timestamp);

		// Formatting the date in "dd-mm-yyyy" format
		var formattedDates = date.toLocaleDateString('en-GB', {
			day: '2-digit',
			month: '2-digit',
			year: 'numeric'
		});
		$('#typeInput').val(data.works.type);
		$('#statusInput').val(data.works.status);
		$('#createdAtInput').val(data.works.created_at);
		$('#updatedAtInput').val(data.works.updated_at);
		$('#date').val(formattedDates);
	}

	$(document).ready(function () {
		$('#reasonform').on('submit', function (event) {
			event.preventDefault(); // Prevent default form submission

			// Serialize form data
			var formData = $(this).serialize();

			// Send AJAX request
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'), // URL from the form action attribute
				data: formData,
				success: function (response) {
					// Handle success response, if needed	
					console.log('Data saved successfully!');
					$('#myModal').modal('hide'); // Close the modal
					// Reload the page after closing the modal
					setTimeout(function () {
						location.reload();
					}, 500); // Delay before refreshing (adjust as needed)
				},
				error: function (error) {
					// Handle error response
					console.error('Error:', error);
					// You can display an error message or handle the error accordingly
				}
			});
		});
	});



	// For Clockin and Clockout


});
