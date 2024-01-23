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


});
