$(function () {

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	let currentClockTime = 0;
	let intervalId = null;

	function startClockinClockout(index) {
		currentClockTime = currentClockTime;
		intervalId = setInterval(() => updateClockinClockout(index), 1000);
	}

	function stopClockinClockout() {
		clearInterval(intervalId);
	}

	function updateClockinClockout(index) {

		const hours = Math.floor(currentClockTime / 3600);
		const minutes = Math.floor((currentClockTime % 3600) / 60);
		const seconds = currentClockTime % 60;

		var timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

		$(`.clockin_break_timer`).html(timer);

		currentClockTime++;
	}



	function formatTime(time) {
		const hours = Math.floor(time / 3600);
		const minutes = Math.floor((time % 3600) / 60);
		const seconds = time % 60;
		return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	}



	$(document).on("click", ".clock-btn", function (e) {

		if ($(this).data('type') == 'clockin') {

			var html = `<small>
				<button id="breakButton" class="custom_btn break clock-btn" data-type="break" ><i class="fa-solid fa-play"></i>
					Break
				</button>
				</small>
			 <small>
				<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
					Clock Out
				</button>
			</small>`;

		} else if ($(this).data('type') == 'break') {

			var html = `<small>
			<button id="continueButton" class="custom_btn break clock-btn" data-type="continue" ><i class="fa-solid fa-play"></i>
				Continue
			</button>
			</small>
		 <small>
			<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
				Clock Out
			</button>
		</small>`;

		} else if ($(this).data('type') == 'clockout') {

			var html = `<small>
				<button id="continueButton" class="custom_btn break clock-btn" data-type="continue"><i class="fa-solid fa-play"></i>
					Continue
				</button>
				</small>`;

		} else if ($(this).data('type') == 'continue') {

			var html = `<small>
				<button id="breakButton" class="custom_btn break clock-btn" data-type="break" ><i class="fa-solid fa-play"></i>
					Break
				</button>
				</small>
			 <small>
				<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
					Clock Out
				</button>
			</small>`;

		}


		ClockInBreakClockOut($(this).data('type'), html);

	});


	function ClockInBreakClockOut(type, html) {


		var timerHtml = `<div class="timer-loader"></div>`;

		$.ajax({
			type: 'POST',
			url: "/clockin-break-clockout",
			data: {
				type: type,
			},
			beforeSend: function() {
				$('.clock-btn').prop('disabled', true); // disable button
				$('.clockin_break_timer').html(timerHtml);
			},
			success: function (data) {

				setTimeout(function() {
					$('.clockin_break_timer').html('');
					$('.clock-btn').prop('disabled', false); // disable button
				}, 1000);

				currentClockTime = parseInt(data.totalSecond, 10) || 0;

				if (type == 'clockin') {

					startClockinClockout(1);

					
					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});

					setTimeout(function() {

						$('.title-work').text('Working Day Duration');
						$('.clock-break-btn').html(html);
						$('.work-type').show().text('WORKING');

						$('.add-color').css({
							color: '#2dec2d'
						});
					}, 1000);

				} else if (type == 'break') {

					stopClockinClockout();
					startClockinClockout(1);

					$('.clockin_break_timer').css({
						color: '#db0a26'
					});
					

					setTimeout(function() {

						$('.title-work').text('Break Duration');
						$('.clock-break-btn').html(html);
						$('.work-type').show().text('BREAK');

						$('.add-color').css({
							color: '#db0a26'
						});
					}, 1000);


					$('.show-task-timer').addClass('d-none');
					
				} else if (type == 'clockout') {


					stopClockinClockout();

					
					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});

					
					setTimeout(function() {

						$(`.clockin_break_timer`).html(data.timeformat);
						$('.title-work').text('Working Day Duration');
						$('.clock-break-btn').html(html);
						$('.work-type').hide().text('');

						$('.add-color').css({
							color: '#fff'
						});
					}, 1000);

					$('.show-task-timer').addClass('d-none');

				} else if (type == 'continue') {

					stopClockinClockout();
					startClockinClockout(1);

					
					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});

					setTimeout(function() {
						$('.title-work').text('Working Day Duration');
						$('.clock-break-btn').html(html);
						$('.work-type').show().text('WORKING');

						$('.add-color').css({
							color: '#2dec2d'
						});
					}, 1000);

				}

			},
		});

	}

	ShowClockTime();

	function ShowClockTime() {

		$('.add-color').css({
			color: '#fff'
		});

		$.ajax({
			type: 'POST',
			url: "/clockin-break-clockout-time",
			success: function (data) {

				$(`.clockin_break_timer`).html(data.timeformat);

				currentClockTime = parseInt(data.totalSecond, 10) || 0;

				if (data.type == 'work') {

					if (data.status == 'start') {

						var html = `<small>
						<button id="breakButton" class="custom_btn break clock-btn" data-type="break" ><i class="fa-solid fa-play"></i>
							Break
						</button>
						</small>
					<small>
						<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
							Clock Out
						</button>
					</small>`;

						startClockinClockout(1);

						$('.title-work').text('Working Day Duration');
						$('.clock-break-btn').html(html);

						$('.work-type').show().text('WORKING');

						$('.clockin_break_timer').css({
							color: '#2dec2d'
						});

						$('.add-color').css({
							color: '#2dec2d'
						});

					}

					if (data.status == 'end') {

						var html = `<small>
						<button id="continueButton" class="custom_btn break clock-btn" data-type="continue"><i class="fa-solid fa-play"></i>
							Continue
						</button>
						</small>`;

						stopClockinClockout();

						$('.title-work').text('Working Day Duration');
						$(`.clockin_break_timer`).html(data.timeformat);
						$('.clock-break-btn').html(html);
						$('.work-type').hide().text('');

						$('.clockin_break_timer').css({
							color: '#2dec2d'
						});

						$('.add-color').css({
							color: '#fff'
						});

					}



				} else if (data.type == 'break') {

					var html = `<small>
						<button id="continueButton" class="custom_btn break clock-btn" data-type="continue" ><i class="fa-solid fa-play"></i>
							Continue
						</button>
						</small>
					<small>
						<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
							Clock Out
						</button>
					</small>`;

					stopClockinClockout();
					startClockinClockout(1);

					$('.title-work').text('Break Duration');

					$('.clock-break-btn').html(html);
					$('.work-type').show().text('BREAK');

					$(`.clockin_break_timer`).html(data.timeformat);

					$('.clockin_break_timer').css({
						color: '#db0a26'
					});

					$('.add-color').css({
						color: '#db0a26'
					});

				}

			},
		});

	}


		CheckPreviousClockOut();

		function CheckPreviousClockOut()
		{

			$.ajax({
				type: 'POST',
				url:  '/check-previous-clockout',
				success: function (response) {

					if(response.status == 'error'){
						$('.clockin').val(response.clockin);
						$('#PreviousTimeModal').modal('show'); 
					}
					
				},
				error: function (error) {
					// Handle error response
					console.error('Error:', error);
					$('#PreviousTimeModal').modal('hide'); 
				}
			});

		}


		function AuthCheck()
		{

			$.ajax({
				type: 'GET',
				url:  '/check-user-auth',
				success: function (response) {

					if(response == false ){
						  window.location.href = '/login';
					}
					
				},
				error: function (error) {
					// Handle error response
					console.error('Error:', error);

				}
			});

		}


		document.addEventListener('visibilitychange', function() {
			if (document.visibilityState === 'hidden') {

			   // If tab becomes inactive, clear the interval
				//  clearInterval(timerInterval);
				// alert("In active")

			} else {
			   // If tab becomes active, restart the interval
			     AuthCheck();
				stopClockinClockout();
			    ShowClockTime();
			}
		});

});
