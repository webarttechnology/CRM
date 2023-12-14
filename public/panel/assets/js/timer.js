$(function(){

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


	let currentTime = 0; //   (in seconds)
	let countdown;
	
	function startCountdown(id) {

		$.ajax({
			type: 'POST',
			url: '/workhistory/get-total-workhistory-per-task',
			data: {id: id},
			success:function(data){
				currentTime = parseInt(data, 10) || 0;
				countdown   = setInterval(updateCountdown, 1000);
			},
		});

	}
	
	function stopCountdown() {
	  clearInterval(countdown);
	}
	
	function resumeCountdown(id) {
	  $.ajax({
		type: 'POST',
		url: '/workhistory/get-total-workhistory-per-task',
		data: {id: id},
		success:function(data){
			currentTime = parseInt(data, 10) || 0;
			countdown   = setInterval(updateCountdown, 1000);
		},
	});

	}
	
	function updateCountdown() {
	  const hours = Math.floor(currentTime / 3600);
	  const minutes = Math.floor((currentTime % 3600) / 60);
	  const seconds = currentTime % 60;
	  var timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	 
	  $('.countdown').html(timer);

	  currentTime++; 

	}


	function formatTime(time) {
	  const hours = Math.floor(time / 3600);
	  const minutes = Math.floor((time % 3600) / 60);
	  const seconds = time % 60;
	  return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	}



	$(document).on("click", ".timer-btn", function(e) {
		e.preventDefault();

		storeTotalTime($(this).data('id'), $(this).data('type'));

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
		$.ajax({
			type: 'POST',
			url: '/workhistory/store-total-workhistory-per-task',
			data: {id: id, type: type, time: formatTime(currentTime)},
			success:function(data){
				 if(data.status == 0){
					toastr.error(data.msg);
				 }
			},
		});
	}



});


