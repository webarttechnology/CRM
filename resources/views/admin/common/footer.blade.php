 
 </div>
 <!-- /Main Wrapper -->

 <!-- Modal -->
 <div class="modal right fade" id="add_module_form" tabindex="-1" role="dialog" aria-modal="true">
 <div class="modal-dialog" role="document">
 <button type="button" class="close md-close" data-bs-dismiss="modal" aria-label="Close"> </button>
 <div class="modal-content dynamic-form">
 {{-- dynamic form inject --}}
 </div>
 <!-- modal-content -->
 </div><!-- modal-dialog -->
 </div>
 <!-- modal -->

 <!-- jQuery -->
 <script src="{{ url('panel/assets/js/jquery-3.6.0.min.js') }}"></script>

 <!-- Bootstrap Core JS -->
 <script src="{{ url('panel/assets/js/bootstrap.bundle.min.js') }}"></script>

 <!-- Slimscroll JS -->
 <script src="{{ url('panel/assets/js/jquery.slimscroll.min.js') }}"></script>


 <!-- Select2 JS -->
 <script src="{{ url('panel/assets/js/select2.min.js') }}"></script>

 <!-- Datatable JS -->
 <script src="{{ url('panel/assets/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ url('panel/assets/js/dataTables.bootstrap4.min.js') }}"></script>

 <!-- Datetimepicker JS -->
 <script src="{{ url('panel/assets/js/moment.min.js') }}"></script>
 <script src="{{ url('panel/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

 <!-- Chart JS -->
 <script src="{{ url('panel/assets/js/morris.js') }}"></script>

 <script src="{{ url('panel/assets/plugins/raphael/raphael.min.js') }}"></script>
 <script src="{{ url('panel/assets/js/chart.js') }}"></script>
 <script src="{{ url('panel/assets/js/linebar.min.js') }}"></script>
 <script src="{{ url('panel/assets/js/piechart.js') }}"></script>
 <script src="{{ url('panel/assets/js/apex.min.js') }}"></script>
 <!-- theme JS -->
 <script src="{{ url('panel/assets/js/theme-settings.js') }}"></script>

 <!-- Toastr JS -->
 <script src="{{ url('panel/assets/plugins/toastr/toastr.min.js') }}"></script>

 <!-- Custom JS -->
 <script src="{{ url('panel/assets/js/app.js') }}"></script>

 {{-- Timer --}}
 {{-- <script src="{{ url('panel/assets/js/timer.js') }}"></script> --}}

 @if (session('successmsg'))
 <script>
     toastr.success("{{ Session::get('successmsg') }}");
 </script>
 @endif

 @if (session('errmsg'))
 <script>
     toastr.error("{{ Session::get('errmsg') }}");
 </script>
 @endif

 @yield('script')
 <script>
     $(function() {



         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });




         function initSelect2() {
             var mySelect = $(".js-example-basic-multiple").select2({
                 dropdownParent: $("#add_module_form"),
                 placeholder: "Select",
                 allowClear: true,
                 tags: true,
             });
         };

         $(document).on("click", ".open-module-form", function(e) {
             e.preventDefault();

             var id = $(this).data('id');

             temId = $(this).data('id');

             $.ajax({
                 type: 'POST',
                 url: "{{ route('show-module-form') }}",
                 data: {
                     type: $(this).data('type'),
                     id: id,
                     sale: $(this).data('sale'),
                 },
                 success: function(data) {
                     GetStatusWorkHistory(id);
                     $('.dynamic-form').html(data);
                     $('#add_module_form').modal('show');

                     initSelect2();

                 },
             });

         });

         function GetStatusWorkHistory(id) {

             $.ajax({
                 type: 'POST',
                 url: "{{ route('get-status-work-history') }}",
                 data: {
                     id: id
                 },
                 success: function(data) {
                     if (data.status == 'start') {
                         startCountdown(id);
                     } else {
                         stopCountdown(id);
                     }
                 },

             });

         }





         let currentTime = 0;
         let intervalId = null;

         function startCountdown(index) {

             $.ajax({
                 type: 'POST',
                 url: '/workhistory/get-total-workhistory-per-task',
                 data: {
                     id: index
                 },
                 success: function(data) {
                     currentTime = parseInt(data, 10) || 0;
                     intervalId = setInterval(() => updateCountdown(index), 1000);
                 },
             });


         }

         function stopCountdown(index) {
             clearInterval(intervalId);
         }

         function resumeCountdown(index) {

             $.ajax({
                 type: 'POST',
                 url: '/workhistory/get-total-workhistory-per-task',
                 data: {
                     id: index
                 },
                 success: function(data) {
                     currentTime = parseInt(data, 10) || 0;
                     intervalId = setInterval(() => updateCountdown(index), 1000);
                 },
             });
         }

         function updateCountdown(index) {

             const hours = Math.floor(currentTime / 3600);
             const minutes = Math.floor((currentTime % 3600) / 60);
             const seconds = currentTime % 60;

             var timer =
                 `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

             $(`.countdown${index}`).html(timer);

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

             if ($(this).data('type') == 'start') {

                 $(this).removeClass('btn-warning');
                 $(this).addClass('btn-danger');
                 $(this).html('Stop Task');
                 $(this).data('type', 'stop');

                 startCountdown($(this).data('id'));

             } else if ($(this).data('type') == 'stop') {

                 $(this).removeClass('btn-danger');
                 $(this).addClass('btn-warning');
                 $(this).html('Start Task');
                 $(this).data('type', 'start');

                 stopCountdown();

             } 
             
            //  else if ($(this).data('type') == 'resume') {
            //      $(this).removeClass('btn-warning');
            //      $(this).addClass('btn-danger');
            //      $(this).html('Stop Task');
            //      $(this).data('type', 'stop');

            //      resumeCountdown($(this).data('id'));

            //  }



             //  console.log($(`.countdown${$(this).data('id')}`).html());
         });


         function storeTotalTime(id, type) {

             var currentTimeGet = $(`.countdown${id}`).html();

             $.ajax({
                 type: 'POST',
                 url: '/workhistory/store-total-workhistory-per-task',
                 data: {
                     id: id,
                     type: type,
                     time: currentTimeGet,
                     last_counter_time: formatTime(currentTime)
                 },
                 success: function(data) {
                     if (data.status == 0) {
                         toastr.error(data.msg);
                     }
                 },
             });
         }

        //  $(window).on('beforeunload', function() {
        //      // Make an AJAX call before the page is reloaded
            
        //  });

        $(window).on('beforeunload', function() {
        // Make an AJAX call before unloading the page

           var last_counter_time = formatTime(currentTime);
         
            $.ajax({
                 type: 'POST',
                 url: "{{ route('store-status-page-refresh') }}",
                 data: {
                     last_counter_time: last_counter_time,
                 },
                 success: function(response) {
                     // Handle the response if needed
                     console.log(response);
                 },
             });
        
        // You can return a custom message, but it may not be displayed in all browsers
        // return "You have unsaved changes. Are you sure you want to leave?";
       });


     });



 </script>



 <script>
     //     $.ajaxSetup({
     //         headers: {
     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     //         }
     //       });


     // 	let currentTime = 0; //   (in seconds)
     // 	let countdown;

     // 	function startCountdown(id) {

     // 		$.ajax({
     // 			type: 'POST',
     // 			url: '/workhistory/get-total-workhistory-per-task',
     // 			data: {id: id},
     // 			success:function(data){
     // 				currentTime = parseInt(data, 10) || 0;
     // 				countdown   = setInterval(updateCountdown, 1000);
     // 			},
     // 		});

     // 	}

     // 	function stopCountdown() {
     // 	  clearInterval(countdown);
     // 	}

     // 	function resumeCountdown(id) {
     // 	  $.ajax({
     // 		type: 'POST',
     // 		url: '/workhistory/get-total-workhistory-per-task',
     // 		data: {id: id},
     // 		success:function(data){
     // 			currentTime = parseInt(data, 10) || 0;
     // 			countdown   = setInterval(updateCountdown, 1000);
     // 		},
     // 	});

     // 	}

     // 	function updateCountdown() {
     // 	  const hours = Math.floor(currentTime / 3600);
     // 	  const minutes = Math.floor((currentTime % 3600) / 60);
     // 	  const seconds = currentTime % 60;
     // 	  var timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

     //     //  console.log(`.countdown${temId}`);

     // 	  $('.countdown').html(timer);

     // 	  currentTime++; 

     // 	}


     // 	function formatTime(time) {
     // 	  const hours = Math.floor(time / 3600);
     // 	  const minutes = Math.floor((time % 3600) / 60);
     // 	  const seconds = time % 60;
     // 	  return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
     // 	}



     // 	$(document).on("click", ".timer-btn", function(e) {
     // 		e.preventDefault();

     // 		storeTotalTime($(this).data('id'), $(this).data('type'));

     // 		 if($(this).data('type') == 'start'){
     // 			$(this).removeClass('btn-warning');
     //             $(this).addClass('btn-danger');
     //             $(this).html('Stop Task');
     // 			$(this).data('type', 'stop');

     // 			startCountdown($(this).data('id'));

     // 		 }else if($(this).data('type') == 'stop'){

     // 			 $(this).removeClass('btn-danger');
     // 			 $(this).addClass('btn-primary');
     // 			 $(this).html('Resume Task');
     // 			 $(this).data('type', 'resume');

     // 			 stopCountdown();

     // 		 }else if($(this).data('type') == 'resume'){
     // 			$(this).removeClass('btn-warning');
     // 			$(this).addClass('btn-danger');
     // 			$(this).html('Stop Task');
     // 			$(this).data('type', 'stop');

     // 			resumeCountdown($(this).data('id'));

     // 		 }

     // 	});


     // 	function storeTotalTime(id, type) {
     // 		$.ajax({
     // 			type: 'POST',
     // 			url: '/workhistory/store-total-workhistory-per-task',
     // 			data: {id: id, type: type, time: formatTime(currentTime)},
     // 			success:function(data){
     // 				 if(data.status == 0){
     // 					toastr.error(data.msg);
     // 				 }
     // 			},
     // 		});
     // 	}


     //     $(window).on('beforeunload', function() {
     //     // Make an AJAX call before the page is reloaded
     //         $.ajax({
     //             type:  'POST', // or 'GET' depending on your needs
     //             url: "{{ route('store-status-page-refresh') }}",
     //             data: {
     //                 // your data here
     //             },
     //             success: function(response) {
     //                 // Handle the response if needed
     //             },
     //         });
     //    });

     // window.onload=function(){
     //     (function timer() {
     //         'use strict';



     //     // Assuming $totalTimeFormatted is 'HH:mm:ss'

     //     const totalTimeFormatted = '14:52:26'; // Replace with your actual formatted time

     //     // Split the formatted time into hours, minutes, and seconds
     //     const [hours, minutes, seconds] = totalTimeFormatted.split(':');

     //     // Create a new Date object and set the time components
     //     const totalTimeDate = new Date();
     //     totalTimeDate.setHours(parseInt(hours, 10));
     //     totalTimeDate.setMinutes(parseInt(minutes, 10));
     //     totalTimeDate.setSeconds(parseInt(seconds, 10));

     //     // Convert the Date object to a timestamp using getTime()
     //     const timestamp = totalTimeDate.getTime();

     //         //declare
     //         var output = document.getElementById('timer');
     //         // var toggle = document.getElementById('toggle');        
     //         var toggle = $('#toggle');        
     //         var clear = document.getElementById('clear');
     //         var running = $("#running").val()==1?true:false;
     //         var paused = $("#paused").val()==1?true:false;
     //         var timer;

     //         // timer start time
     //         var then;
     //         // pause duration
     //         var delay;
     //         // pause start time
     //         var delayThen;


     //         // start timer
     //         var start = async function() {
     //             const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=start&currentTime='+$('#timer').html());
     //             if(response.data.status == 1){
     //               delay = 0;
     //               running = true;
     //               then = Date.now();              
     //               timer = setInterval(run,51);
     //             //   toggle.classList.remove('btn-warning');
     //             //   toggle.classList.add('btn-danger');
     //             //   toggle.innerHTML = 'Stop Task';
     //             $('#toggle').removeClass('btn-warning');
     //             $('#toggle').addClass('btn-danger');
     //             $('#toggle').html('Stop Task');

     //             }else{
     //               console.log(response.data.msg)
     //             }

     //         };


     //         // parse time in ms for output
     //         var parseTime = function(elapsed) {
     //             // array of time multiples [hours, min, sec, decimal]
     //             var d = [3600000,60000,1000,10];
     //             var time = [];
     //             var i = 0;

     //             while (i < d.length) {
     //                 var t = Math.floor(elapsed/d[i]);

     //                 // remove parsed time for next iteration
     //                 elapsed -= t*d[i];

     //                 // add '0' prefix to m,s,d when needed
     //                 t = (i > 0 && t < 10) ? '0' + t : t;
     //                 time.push(t);
     //                 i++;
     //             }

     //             return time;
     //         };


     //         // run
     //         var run = function() {        
     //             var time = parseTime(Date.now()-then-delay); 

     //             var  time_show = time[0] + ':' + time[1] + ':' + time[2];

     //             $('#timer').html(time_show);

     //             // output.innerHTML = time[0] + ':' + time[1] + ':' + time[2];
     //         };


     //         // stop
     //         var stop = async function() {
     //             const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=stop&currentTime='+$('#timer').html());
     //             if(response.data.status == 1){
     //               paused = true;
     //               delayThen = Date.now();
     //             //   toggle.innerHTML = 'Resume Task';
     //             //   toggle.classList.remove('btn-danger');
     //             //   toggle.classList.add('btn-primary');
     //             //   toggle.html = '';
     //             $('#toggle').html('Resume Task');
     //             $('#toggle').removeClass('btn-danger');
     //             $('#toggle').addClass('btn-primary');
     //               clearInterval(timer);    
     //               run();
     //             }else{
     //               console.log(response.data.msg)
     //             }                    
     //         };


     //         // resume
     //         var resume = async function() {
     //            const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=resume&currentTime='+$('#timer').html());

     //            if(response.data.status == 1){
     //               paused = false;
     //               delay += Date.now()-delayThen;
     //               timer = setInterval(run,51);
     //             //   toggle.innerHTML = 'Stop Task';
     //             $('#toggle').removeClass('btn-warning');
     //             $('#toggle').addClass('btn-danger');
     //             $('#toggle').html('Stop Task');

     //             }else{
     //               console.log(response.data.msg)
     //             }           
     //             //clear.dataset.state = '';
     //         };


     //         // clear
     //         var reset = function() {
     //             running = false;
     //             paused = false;
     //             // toggle.innerHTML = 'start';
     //             $('#toggle').html('start');
     //             // output.innerHTML = '0:00:00';
     //             $('#timer').html('0:00:00');
     //             //clear.dataset.state = '';
     //         };


     //         // evaluate and route
     //         var router = function() { 
     //             if (!running) start();
     //             else if (paused) resume();
     //             else stop();
     //         };

     // 		$(document).on("click", "#toggle", function(e) {
     // 				e.preventDefault();
     // 				router();
     // 		});

     //         // document.toggle.addEventListener('click',router);

     //        // clear.addEventListener('click',reset);

     //     })();    

     // }
 </script>

 </body>

 </html>
