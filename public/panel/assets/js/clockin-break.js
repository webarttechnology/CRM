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

	

	$(document).on("click", ".clock-btn", function(e) {

		if($(this).data('type') == 'clockin'){

			var html =`<small>
				<button id="breakButton" class="custom_btn break clock-btn" data-type="break" ><i class="fa-solid fa-play"></i>
					Break
				</button>
				</small>
			 <small>
				<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
					Clock Out
				</button>
			</small>`;

		}else if($(this).data('type') == 'break'){

			var html =`<small>
			<button id="continueButton" class="custom_btn break clock-btn" data-type="continue" ><i class="fa-solid fa-play"></i>
				Continue
			</button>
			</small>
		 <small>
			<button id="stopButton" class="custom_btn clockout clock-btn" data-type="clockout"> <i class="fa-solid fa-play"></i>
				Clock Out
			</button>
		</small>`;

		}else if($(this).data('type') == 'clockout'){

				var html =`<small>
				<button id="continueButton" class="custom_btn break clock-btn" data-type="continue"><i class="fa-solid fa-play"></i>
					Continue
				</button>
				</small>`;
		
		}else if($(this).data('type') == 'continue'){

			var html =`<small>
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


	function ClockInBreakClockOut(type, html)
	{

		$.ajax({
			type: 'POST',
			url: "/clockin-break-clockout",
			data: {
				type: type,
			},
			success: function(data) {

				 console.log(data);

				 currentClockTime = parseInt(data.totalSecond, 10) || 0;

				if(type == 'clockin'){

					startClockinClockout(1);

					$('.title-work').text('Working Day Duration');
					$('.clock-break-btn').html(html);
					
					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});
					$('.add-color').css({
						color: '#2dec2d'
					});

				}else if(type == 'break'){

					stopClockinClockout();
					startClockinClockout(1);

					$('.title-work').text('Break Duration');
					$('.clock-break-btn').html(html);

					$('.clockin_break_timer').css({
						color: '#db0a26'
					});
					$('.add-color').css({
						color: '#db0a26'
					});

				}else if(type == 'clockout'){

					startClockinClockout(1);

					stopClockinClockout();

					$('.title-work').text('Working Day Duration');

					$('.clock-break-btn').html(html);

					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});

					$('.add-color').css({
						color: '#fff'
					});

				}else if(type == 'continue'){

					stopClockinClockout();
					startClockinClockout(1);

					$('.title-work').text('Working Day Duration');

					$('.clock-break-btn').html(html);

					$('.clockin_break_timer').css({
						color: '#2dec2d'
					});

					$('.add-color').css({
						color: '#2dec2d'
					});

				}

			},
		});

	}


});
