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
<div class="modal right" id="fullWidthModal" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="chat-box">
                <!-- Modal content goes here -->
            </div>
        </div>
    </div>
</div>



  <!-- Previous Time Modal -->
  <div class="modal fade" id="PreviousTimeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Previous day work time</h5>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('previous-clockout-time-submit') }}" class="save">
                  @csrf
                  <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="end_date">{{ __('Reason') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="reason" placeholder="Enter Reason"></textarea>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="end_date">{{ __('Start Time') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control clockin"  value=""  readonly  name="start" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="end_date">{{ __('End Time') }} <span class="text-danger">*</span></label>
                        <input type="time" class="form-control"  name="end_time" />
                    </div>
                  </div>

                  <div class="text-center mt-4">
                      <button type="sunmit" class="btn btn-primary">Submit</button>
                  </div>

             </form>
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


<!-- theme JS -->
<script src="{{ url('panel/assets/js/theme-settings.js') }}"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Toastr JS -->
<script src="{{ url('panel/assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ url('panel/assets/js/app.js') }}"></script>

{{-- Clock Timer --}}
<script src="{{ url('panel/assets/js/clock.js') }}"></script>
<script src="{{ url('panel/assets/js/clockin-break.js') }}"></script>
<script src="{{ url('panel/assets/js/main.js') }}"></script>
@yield('script')
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
                url: '{{ route('comment.list') }}',
                data: {
                    task_id: taskId
                },
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
                    } else {
                        if ($clickBtn.data('type') == 'start') {

                            $clickBtn.removeClass('btn-warning');
                            $clickBtn.addClass('btn-danger');
                            $clickBtn.html('Stop Task');
                            $clickBtn.data('type', 'stop');

                            $(`.show-task-timer`).removeClass('d-none');

                            stopCountdown();

                            startCountdown($clickBtn.data('id'));

                        } else if ($clickBtn.data('type') == 'stop') {

                            $clickBtn.removeClass('btn-danger');
                            $clickBtn.addClass('btn-warning');
                            $clickBtn.html('Start Task');
                            $clickBtn.data('type', 'start');

                            $(`.show-task-timer`).addClass('d-none');

                            stopCountdown();

                        }
                    }
                },
            });

        });

        currentTaskTimerGet();

        function currentTaskTimerGet() {
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


        document.addEventListener('visibilitychange', function() {
			if (document.visibilityState === 'hidden') {

			   // If tab becomes inactive, clear the interval
				//  clearInterval(timerInterval);
				// alert("In active")

			} else {
			   // If tab becomes active, restart the interval
               stopCountdown();
               currentTaskTimerGet();
			}
		});


        //// End Timer Section 


        function getTaskList() {
            $.ajax({
                type: 'POST',
                url: '/workhistory/get-task-list',
                success: function(data) {
                    $('.task-list-section').html(data);
                },
            });
        }

        $(document).on('click', '#breakButton, #stopButton', function() {

            setTimeout(function() {
                var stopButton = $(".timer-btn[data-type='stop']")[0];
                // alert(stopButton);
                if (stopButton) {
                    stopButton.click();
                }
                // console.log("5 seconds have passed!");
            }, 5000);

        });


        $(".times_track").click(function(e) {
            e.preventDefault();
            $("#popUp").slideToggle();
        });


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


        ////// Pusher Notification

        var auth_id = '{{ Auth::id() }}';

        Pusher.logToConsole = true;

        var pusher = new Pusher('d2ece4d16be20aa65ad6', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('notify-user');
        channel.bind('chat-notify-user', function(data) {
            // console.log(JSON.stringify(data.message));
            if (data.message.to_user_id == auth_id) {
                if (data.message.message_status == 'Not Send') {
                    //  alert(JSON.stringify(data.message.chat_message));
                    if (data.message.user_image) {
                        $userImg = data.message.user_image;
                    } else {
                        $userImg = "{{ url('panel/assets/img/profiles/user-profile.png') }}";
                    }
                    showNotification(data.message.name, $userImg, data.message.chat_message)
                }
            }
        });


        function showNotification(name, image, msg) {

            var html = ` <div class="my-toast-container" id="toast">
                <div style="display: flex;">
                    <div><img src="` + image + `" width="40px" height="40px" style="border-radius: 100%;" alt="photo"></div>
                    <div style="margin-left: 10px;">
                    <div style="font-weight: 600; font-size: 15px;">` + name + `</div>
                    <div style="font-size: 13px; font-weight: 400;  margin-top: 5px;">` + msg + `</div>
                    </div>
                </div>
            </div>`;

            $("body").append(html);
            $('#toast').show();

            setTimeout(function() {
                $('#toast').fadeOut(1000).remove();
            }, 3000);
        }

    });
</script>
</body>
</html>
