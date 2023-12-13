$(function(){

	let dynamicTotalTime = 2; /// (in seconds)
	let currentTime = 0;
	let countdown;
	
	function startCountdown() {
	  currentTime = parseInt(dynamicTotalTime, 10) || 0;
	  countdown   = setInterval(updateCountdown, 1000);
	}
	
	function stopCountdown() {
	  clearInterval(countdown);
	}
	
	function resumeCountdown() {
	  countdown = setInterval(updateCountdown, 1000);
	}
	
	function updateCountdown() {
	  const hours = Math.floor(currentTime / 3600);
	  const minutes = Math.floor((currentTime % 3600) / 60);
	  const seconds = currentTime % 60;
	  //   document.getElementById("countdown").innerHTML = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	  var timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	  $('.countdown').html(timer);
	
	
	currentTime++; 

	}
	
	
	function getOngoingTime() {
	  alert(`Ongoing Time: ${formatTime(currentTime)}`);
	}
	
	
	function formatTime(time) {
	  const hours = Math.floor(time / 3600);
	  const minutes = Math.floor((time % 3600) / 60);
	  const seconds = time % 60;
	  return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
	}


	$(document).on("click", ".timer-btn", function(e) {
		e.preventDefault();

		 if($(this).data('type') == 'start'){
			$(this).removeClass('btn-warning');
            $(this).addClass('btn-danger');
            $(this).html('Stop Task');
			$(this).data('type', 'stop');
			startCountdown();
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
			resumeCountdown();
		 }

		 getTotalTime($(this).data('id'));
		//  storeTotalTime($(this).data('id'), $(this).data('type'));
	});
	


	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
	
	function getTotalTime(id) {
		 
		$.ajax({
			type: 'POST',
			url: '/workhistory/get-total-workhistory-per-task',
			data: {id: id},
			success:function(data){
				
			},
		});
	
	}
	
	
	function storeTotalTime(id, type) {

		$.ajax({
			type: 'POST',
			url: '/workhistory/store-total-workhistory-per-task',
			data: {id: id, type: type},
			success:function(data){
			
			},
		});
		
	}


});


