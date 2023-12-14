 
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


         //// Timer Section 

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

        //  function resumeCountdown(index) {
        //      $.ajax({
        //          type: 'POST',
        //          url: '/workhistory/get-total-workhistory-per-task',
        //          data: {
        //              id: index
        //          },
        //          success: function(data) {
        //              currentTime = parseInt(data, 10) || 0;
        //              intervalId = setInterval(() => updateCountdown(index), 1000);
        //          },
        //      });
        //  }

         function updateCountdown(index) {

             const hours = Math.floor(currentTime / 3600);
             const minutes = Math.floor((currentTime % 3600) / 60);
             const seconds = currentTime % 60;

             var timer = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

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
        
        // return "You have unsaved changes. Are you sure you want to leave?";
       });


       //// End Timer Section 

     });
 </script>
 </body>
 </html>
