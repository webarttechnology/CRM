	
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
		<script src="{{ url('panel/assets/js/timer.js') }}"></script>

		@if (session('successmsg'))
			<script>
				toastr.success("{{ Session::get('successmsg') }}");
			</script>
		@endif

		@if (session('errmsg'))
			<script>
				toastr.success("{{ Session::get('errmsg') }}");
			</script>
		@endif

		@yield('script')
		<script>
			 $(function(){


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

					$.ajax({
					type: 'POST',
					url: "{{ route('show-module-form') }}",
					data: {type: $(this).data('type'), id: $(this).data('id'), sale: $(this).data('sale'), },
					headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
					success:function(data){
						 $('.dynamic-form').html(data);
						 $('#add_module_form').modal('show');

						 initSelect2();
						 
					},
					});

				});

				///// add-client-modal
				// $(document).on("click", ".add-client-modal", function(e) {
				// 	e.preventDefault();
				// 	$('#add_client_modal').modal('show');
				// });
				
			 });
		</script>


<script>
  
    window.onload=function(){
        (function timer() {
            'use strict';



        // Assuming $totalTimeFormatted is 'HH:mm:ss'

        const totalTimeFormatted = '14:52:26'; // Replace with your actual formatted time

        // Split the formatted time into hours, minutes, and seconds
        const [hours, minutes, seconds] = totalTimeFormatted.split(':');

        // Create a new Date object and set the time components
        const totalTimeDate = new Date();
        totalTimeDate.setHours(parseInt(hours, 10));
        totalTimeDate.setMinutes(parseInt(minutes, 10));
        totalTimeDate.setSeconds(parseInt(seconds, 10));

        // Convert the Date object to a timestamp using getTime()
        const timestamp = totalTimeDate.getTime();
        
            //declare
            var output = document.getElementById('timer');
            // var toggle = document.getElementById('toggle');        
            var toggle = $('#toggle');        
            var clear = document.getElementById('clear');
            var running = $("#running").val()==1?true:false;
            var paused = $("#paused").val()==1?true:false;
            var timer;
            
            // timer start time
            var then;
            // pause duration
            var delay;
            // pause start time
            var delayThen;
        
            
            // start timer
            var start = async function() {
                const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=start&currentTime='+$('#timer').html());
                if(response.data.status == 1){
                  delay = 0;
                  running = true;
                  then = Date.now();              
                  timer = setInterval(run,51);
                //   toggle.classList.remove('btn-warning');
                //   toggle.classList.add('btn-danger');
                //   toggle.innerHTML = 'Stop Task';
                $('#toggle').removeClass('btn-warning');
                $('#toggle').addClass('btn-danger');
                $('#toggle').html('Stop Task');

                }else{
                  console.log(response.data.msg)
                }
              
            };
            
            
            // parse time in ms for output
            var parseTime = function(elapsed) {
                // array of time multiples [hours, min, sec, decimal]
                var d = [3600000,60000,1000,10];
                var time = [];
                var i = 0;
        
                while (i < d.length) {
                    var t = Math.floor(elapsed/d[i]);
        
                    // remove parsed time for next iteration
                    elapsed -= t*d[i];
        
                    // add '0' prefix to m,s,d when needed
                    t = (i > 0 && t < 10) ? '0' + t : t;
                    time.push(t);
                    i++;
                }
                
                return time;
            };
            
            
            // run
            var run = function() {        
                var time = parseTime(Date.now()-then-delay); 

                var  time_show = time[0] + ':' + time[1] + ':' + time[2];

                $('#timer').html(time_show);
                
                // output.innerHTML = time[0] + ':' + time[1] + ':' + time[2];
            };
            
            
            // stop
            var stop = async function() {
                const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=stop&currentTime='+$('#timer').html());
                if(response.data.status == 1){
                  paused = true;
                  delayThen = Date.now();
                //   toggle.innerHTML = 'Resume Task';
                //   toggle.classList.remove('btn-danger');
                //   toggle.classList.add('btn-primary');
                //   toggle.html = '';
                $('#toggle').html('Resume Task');
                $('#toggle').removeClass('btn-danger');
                $('#toggle').addClass('btn-primary');
                  clearInterval(timer);    
                  run();
                }else{
                  console.log(response.data.msg)
                }                    
            };
            
            
            // resume
            var resume = async function() {
               const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=resume&currentTime='+$('#timer').html());
    
               if(response.data.status == 1){
                  paused = false;
                  delay += Date.now()-delayThen;
                  timer = setInterval(run,51);
                //   toggle.innerHTML = 'Stop Task';
                $('#toggle').removeClass('btn-warning');
                $('#toggle').addClass('btn-danger');
                $('#toggle').html('Stop Task');

                }else{
                  console.log(response.data.msg)
                }           
                //clear.dataset.state = '';
            };
            
            
            // clear
            var reset = function() {
                running = false;
                paused = false;
                // toggle.innerHTML = 'start';
                $('#toggle').html('start');
                // output.innerHTML = '0:00:00';
                $('#timer').html('0:00:00');
                //clear.dataset.state = '';
            };
            
            
            // evaluate and route
            var router = function() { 
                if (!running) start();
                else if (paused) resume();
                else stop();
            };

			$(document).on("click", "#toggle", function(e) {
					e.preventDefault();
					router();
			});
        
            // document.toggle.addEventListener('click',router);

           // clear.addEventListener('click',reset);

        })();    
    
    }


    // console.log(Date.now());

    </script>

    </body>
</html>