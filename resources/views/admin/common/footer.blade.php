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


<!-- Full Width Modal -->
<div class="modal right" id="fullWidthModal" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
      <div class="modal-content">
        <div class="chat-box">
          <!-- Modal content goes here -->
        </div>
      </div>
    </div>
  </div>

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

{{-- Clock Timer --}}
<script src="{{ url('panel/assets/js/clock.js') }}"></script>


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

            var type = $(this).data('type');
            var sale = $(this).data('sale');
            var taskId = $(this).data('id'); 

            $.ajax({
                type: 'POST',
                url: "{{ route('show-module-form') }}",
                data: {
                    type: type,
                    id: id,
                    sale: sale,
                },
                success: function(data) {

                    if(type == 'add_task' && sale == 'show'){
                        CurrentTimeStore();
                    }

                    GetStatusWorkHistory(id);

                    $('.dynamic-form').html(data);
                    $('#add_module_form').modal('show');

                    getMessage(taskId);

                    initSelect2();

                },
            });

        });

        const getMessage = (taskId) => {
             $.ajax({
                 type: 'GET',
                 url: '{{ route("comment.list") }}',
                 data: { task_id: taskId },
                 success: function(data) {
                     $("#message").html(data);
                 }
             });
         }
         
        function GetStatusWorkHistory(id) {

            $.ajax({
                type: 'POST',
                url: "{{ route('get-status-work-history') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status == 'start') {
                        $(`.show-task-timer`).removeClass('d-none');
                        stopCountdown();
                        startCountdown(id);
                        getTaskList();
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

        function stopCountdown() {
            clearInterval(intervalId);
        }

        function updateCountdown(index) {

            const hours = Math.floor(currentTime / 3600);
            const minutes = Math.floor((currentTime % 3600) / 60);
            const seconds = currentTime % 60;

            var timer =
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            $(`.countdown${index}`).html(timer);
            $(`.show-task-timer`).html(timer);

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

            $clickBtn = $(this);

            var currentTimeGet = $(`.countdown${$clickBtn.data('id')}`).html();

            $.ajax({
                type: 'POST',
                url: '/workhistory/store-total-workhistory-per-task',
                data: {
                    id: $clickBtn.data('id'),
                    type: $clickBtn.data('type'),
                    time: currentTimeGet,
                    last_counter_time: formatTime(currentTime)
                },
                beforeSend: function() { 
                  $clickBtn.prop('disabled', true); // disable button
                },
                success: function(data) {
                    $clickBtn.prop('disabled', false); // disable button
                    if (data.status == 0) {
                        toastr.error(data.msg);
                    }else{
                        if ($clickBtn.data('type') == 'start') {

                            $clickBtn.removeClass('btn-warning');
                            $clickBtn.addClass('btn-danger');
                            $clickBtn.html('Stop Task');
                            $clickBtn.data('type', 'stop');

                            $(`.show-task-timer`).removeClass('d-none');

                            stopCountdown();

                            startCountdown($clickBtn.data('id'));

                            getTaskList();

                            } else if ($clickBtn.data('type') == 'stop') {

                            $clickBtn.removeClass('btn-danger');
                            $clickBtn.addClass('btn-warning');
                            $clickBtn.html('Start Task');
                            $clickBtn.data('type', 'start');

                            $(`.show-task-timer`).addClass('d-none');

                            stopCountdown();

                            getTaskList();

                        }
                    }
                },
            });

        });

        currentTaskTimerGet();

        function currentTaskTimerGet()
        {
            $.ajax({
                type: 'POST',
                url: "{{ route('current-task-timer-get') }}",
                success: function(data) {
                    if (data.status == 'start') {
                        $(`.show-task-timer`).removeClass('d-none');
                        $(`.show-task-timer`).html(data.timer);
                        stopCountdown();
                        startCountdown(data.id);
                    } else {
                        $(`.show-task-timer`).addClass('d-none');
                        stopCountdown();
                    }
                },
            });  
        }


        function CurrentTimeStore(){

            var last_counter_time = formatTime(currentTime);

            $.ajax({
                type: 'POST',
                url: "{{ route('store-status-page-refresh') }}",
                data: {
                    last_counter_time: $(`.show-task-timer`).html(),
                },
                success: function(response) {
                    // Handle the response if needed
                    console.log(response);
                },
            });

        }


        $(window).on('beforeunload', function() {
            // Make an AJAX call before unloading the page
            CurrentTimeStore();
            // return "You have unsaved changes. Are you sure you want to leave?";
        });
        //// End Timer Section 


        getTaskList();

        function getTaskList() {
            $.ajax({
                type: 'POST',
                url: '/workhistory/get-task-list',
                success:function(data){
                    $('.task-list-section').html(data); 
                },
            });
        }


        /////// Chat Model
        $(document).on("click", ".open-chat-module", function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "{{ route('show-chat-module') }}",
                success: function(data) {
                    $('.chat-box').html(data);
                    setTimeout(function() {
                        $('#fullWidthModal').modal('show');
                    }, 500);
                },
            });
        });

       

    });
</script>
</body>

</html>
