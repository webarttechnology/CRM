@section('title', 'My Task')
@extends('admin.master.layout')

@section('content')
    <div class="page-wrapper" style="min-height: 333px;">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="feather-check-square"></i>
                        </span> Tasks
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">
                        {{-- <div class="dropdown">
                        <a class="dropdown-toggle recently-viewed" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> All Tasks </a>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="#">Items I'm following</a>
                            <a class="dropdown-item" href="#">All Completed Tasks</a>
                            <a class="dropdown-item" href="#">My Delegated Tasks</a>
                            <a class="dropdown-item" href="#">My Completed Tasks</a>
                            <a class="dropdown-item" href="#">My Open Tasks</a>
                            <a class="dropdown-item" href="#">My Tasks</a>
                            <a class="dropdown-item" href="#">All Tasks</a>
                        </div>
                    </div> --}}
                    </div>
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            @if (in_array(Auth::user()->id, [1, 2, 3]))
                                <li class="list-inline-item">
                                    <button
                                        class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form"
                                        data-type="add_task" id="add-task">New Task</button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <table
                                        class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr>
                                                <th>Sales name</th>
                                                <th>Assign By</th>
                                                <th>Task title</th>
                                                <th>Start date & time</th>
                                                <th>End date & time</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($data as $val)
                                                <tr>
                                                    <td>
                                                        <a class="dropdown-item get-all-comments open-module-form"
                                                            data-id="{{ $val->id }}" data-type="add_task"
                                                            data-sale="comment"
                                                            href="{{ route('comment.index', ['taskid' => $val->id]) }}"><i
                                                                class="bx bx-edit-alt me-1"></i>{{ $sales[$val->sale_id] }}</a>
                                                    </td>
                                                    <td>{{ $assignBy[$val->assign_by] }}</td>
                                                    <td>{{ $val->title }}</td>
                                                    <td>{{ date('d/m/Y h:i:s A', strtotime($val->start_date)) }}</td>
                                                    <td>{{ date('d/m/Y h:i:s A', strtotime($val->end_date)) }}</td>
                                                    <td>{{ getProjectStatus($val->status) }}</td>
                                                    <td>{{ $val->created_at->format('d-M-Y') }}</td>

                                                    <td class="text-center">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                @if ($isEdit == 1)
                                                                    <a class="dropdown-item  open-module-form"
                                                                        data-id="{{ $val->id }}" data-type="add_task"
                                                                        href="javascript:void(0)"
                                                                        data-id="{{ $val->id }}"><i
                                                                            class="bx bx-edit-alt me-1"></i>Edit</a>
                                                                @endif
                                                                @if ($isDelete == 1)
                                                                    <a class="dropdown-item"
                                                                        onclick="return confirm('Do you really want to delete this data?')"
                                                                        href="{{ route('developer.task.delete', ['deleteid' => $val->id]) }}"><i
                                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                                @endif
                                                                <a class="dropdown-item get-all-comments open-module-form"
                                                                    data-id="{{ $val->id }}" data-type="add_task"
                                                                    data-sale="comment"
                                                                    href="{{ route('comment.index', ['taskid' => $val->id]) }}"><i
                                                                        class="bx bx-edit-alt me-1"></i>Comment</a>
                                                                @if ($isShow == 1)
                                                                    <a class="dropdown-item open-module-form"
                                                                        data-id="{{ $val->id }}" data-type="add_task"
                                                                        data-sale="show"
                                                                        href="{{ route('developer.task.show', ['id' => $val->id]) }}"><i
                                                                            class="bx bx-trash me-1"></i> Show</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                // var mySelect = $(".js-example-basic-multiple").select2({
                //     dropdownParent: $("#add_module_form"),
                //     placeholder: "Select",
                //     allowClear: true,
                //     tags: true,
                // });
               

                $(document).on("click", "#openpopup", function(e) {

                    $('input').val('');
                    $('select').val('');
                    // CKEDITOR.instances['details'].setData('');
                    $('#exampleModal').modal('show');
                    $('input[name="submit"]').val('Submit');
                    $("#details").val('');
                    $("#remarks").val('');
                    $('#assign_to').val(null).trigger('change');
                });


                $(document).on("click", "#assign_type", function(e) {

                    if ($(this).val()) {
                        $('#assign_to').val(null).trigger('change');
                    }

                    $.ajax({
                        url: "{{ route('developer.get-assign-to') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: $(this).val(),
                        },
                        success: function(response) {
                            $('#assign_to').html(response);
                        }
                    });
                })



                //  $(document).on("submit", "#taskform", function(e) {
                $(document).on("click", ".submit-btn", function(e) {
                    e.preventDefault();
                    // CKEDITOR.instances.details.updateElement();

                    $('[id*=_formerrmsg]').text('');

                    if ($("#sale_id").val() == "") {
                        $('#sale_id_formerrmsg').text("Sale name is a required field");
                        $('#sale_id').focus();
                        return false;
                    } else if ($("#assign_type").val() == "") {
                        $('#assigntype_formerrmsg').text("Assign type is a required field");
                        return false;
                    } else if ($("#assign_to").val() == "") {
                        $('#assignto_formerrmsg').text("Assign to is a required field");
                        return false;
                    } else if ($("#title").val() == "") {
                        $('#title_formerrmsg').text("Title is a required field");
                        return false;
                    } else if ($("#start_date").val() == "") {
                        $('#start_date_formerrmsg').text("Start date is a required field");
                        return false;
                    } else if ($("#end_date").val() == "") {
                        $('#end_date_formerrmsg').text("End date is a required field");
                        return false;
                    } else {
                        $.ajax({
                            url: "{{ route('developer.task.success') }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                sale_id: $("#sale_id").val(),
                                assign_to: $("#assign_to").val(),
                                title: $("#title").val(),
                                details: $("#details").val(),
                                start_date: $("#start_date").val(),
                                end_date: $("#end_date").val(),
                                remarks: $("#remarks").val(),
                                update_id: $("#update_id").val(),
                            },
                            success: function(response) {
                                if (response.status == 1) {
                                    toastr.success(response.successmsg);
                                    $(".text-success").text(response.successmsg)
                                    $('#exampleModal').modal('hide');
                                    window.location.href = "/developer/task";
                                } else {
                                    toastr.success(response.errmsg);
                                    $(".text-err").text(response.errmsg)
                                }
                            },
                            error: function(response) {
                                $('#sale_id_formerrmsg').text(response.responseJSON
                                    .errors.sale_id);
                                $('#assignto_formerrmsg').text(response.responseJSON
                                    .errors
                                    .assign_to);
                                $('#title_formerrmsg').text(response.responseJSON.errors
                                    .title);
                                $('#details_formerrmsg').text(response.responseJSON
                                    .errors.details);
                                $('#start_date_formerrmsg').text(response.responseJSON
                                    .errors
                                    .start_date);
                                $('#end_date_formerrmsg').text(response.responseJSON
                                    .errors
                                    .end_date);
                            },
                        })
                    }

                });




                $(document).on("click", ".clickEdit", function(e) {
                    var id = $(this).data('id');

                    $('#assign_to').val(null).trigger('change');

                    $.ajax({

                        url: "{{ route('developer.task.edit') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            task_id: $(this).data('id'),
                        },
                        success: function(response) {
                            if (response.status == 1) {

                                $("#update_id").val(response.data.id);
                                $("#sale_id").val(response.data.sale_id);
                                $("#assign_type").val(response.role);
                                // $("#assign_to").val(response.data.assign_to);
                                $("#title").val(response.data.title);
                                $("#start_date").val(response.data.start_date);
                                $("#end_date").val(response.data.end_date);
                                $("#remarks").val(response.data.remarks);
                                $("#details").val(response.data.details);
                                $('#exampleModal').modal('show');

                                var assignedTo = JSON.parse(response.data.assign_to);

                                $('#assign_to').val(assignedTo).trigger('change');

                                // CKEDITOR.instances['details'].setData(response.data.details)

                            } else {
                                $(".text-err").text(response.errmsg)
                            }
                        },
                        error: function(response) {
                            alert(response);
                            return false;
                        },
                    });
                });



                $(document).on("click", '.sendmessage', function(e) {
                    
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('comment.add.success') }}',
                        data: 'message=' + $(".textmessage").val() + '&task_id=' + $(
                            "#task_id").val(),
                        success: function(data) {
                            getMessage();
                            $(".textmessage").val('');
                        }
                    });
                });


                const getMessage = () => {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('comment.list') }}',
                        data: 'task_id=' + $("#task_id").val(),
                        success: function(data) {
                            $("#message").html(data);
                        }
                    });
                }

            });

        });
    </script>
@endsection
