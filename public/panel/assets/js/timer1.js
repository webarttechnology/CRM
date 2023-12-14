$(function(){

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


	    const countdowns = [];
		// let currentTime = 0; //   (in seconds)

		function startCountdown(index) {
	
		$.ajax({
			type: 'POST',
			url: '/workhistory/get-total-workhistory-per-task',
			data: {id: index},
			success:function(data){

				const taskTime  =  data;
				const initialTime = parseInt(taskTime, 10) || 0;

				countdowns[index] = {
					currentTime: initialTime,
					isRunning: true,
				};

			},
		});

		updateCountdown(index);

		}

		function stopCountdown(index) {
		  countdowns[index].isRunning = false;
		}

		function resumeCountdown(index) {
		countdowns[index].isRunning = true;
		updateCountdown(index);
		}

		function getOngoingTime(index) {
		const { currentTime } = countdowns[index];
		alert(`Ongoing Time ${index}: ${formatTime(currentTime)}`);
		}

		function updateCountdown(index) {

		const { currentTime, isRunning } = countdowns[index];

		if (!isRunning) return;

		const hours = Math.floor(currentTime / 3600);
		const minutes = Math.floor((currentTime % 3600) / 60);
		const seconds = currentTime % 60;

		var	timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

		$(`.countdown${index}`).html(timer);

		console.log($(`.countdown${index}`));

		countdowns[index].currentTime++;
			// Optionally, you can use setTimeout for delayed updates
		setTimeout(() => updateCountdown(index), 1000);
		}

		function formatTime(time) {
		const hours = Math.floor(time / 3600);
		const minutes = Math.floor((time % 3600) / 60);
		const seconds = time % 60;

		return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
		}

		$(document).on("click", ".timer-btn", function(e) {
			e.preventDefault();
	
			// storeTotalTime($(this).data('id'), $(this).data('type'));
	
			 if($(this).data('type') == 'start'){
				$(this).removeClass('btn-warning');
				$(this).addClass('btn-danger');
				$(this).html('Stop Task');
				$(this).data('type', 'stop');
	
				startCountdown($(this).data('id'));
	
			 }else if($(this).data('type') == 'stop'){
	
				 $(this).removeClass('btn-danger');
				 $(this).addClass('btn-primary');
				 $(this).html('Resume Task');
				 $(this).data('type', 'resume');
	
				 stopCountdown();
	
			 }else if($(this).data('type') == 'resume'){
				$(this).removeClass('btn-warning');
				$(this).addClass('btn-danger');
				$(this).html('Stop Task');
				$(this).data('type', 'stop');
	
				resumeCountdown($(this).data('id'));
				
			 }
	
		});
		
	
		function storeTotalTime(id, type) {
			const { currentTimeShow } = countdowns[id];
			$.ajax({
				type: 'POST',
				url: '/workhistory/store-total-workhistory-per-task',
				data: {id: id, type: type, time: formatTime(currentTimeShow)},
				success:function(data){
					 if(data.status == 0){
						toastr.error(data.msg);
					 }
				},
			});
		}


	
});


