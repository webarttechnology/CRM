@section('title', 'User List')
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
                        </span>User List
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-end">

                        @if (Auth::user()->role_id != 3)
                        <a href="#"
                        class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form"
                        data-type="add_user">Add User</a>
                        @endif
                        
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
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-end mb-3">
                                                            <form action="{{ route('user.search') }}" method="post" class="align-items-center d-flex justify-content-center">
                                                                @csrf
                                                                <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                                                <input type="text" class="form-control" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                                                </div>
                                                                <input type="submit" value="Search" class="btn ms-2 btn-primary">
                                                            </form>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer"
                                                id="DataTables_Table_0" role="grid"
                                                aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>User name</th>
                                                        <th>Email ID</th>
                                                        <th>Role</th>
                                                        <th>Status</th>
                                                        <th>Created at</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user as $val)
                                                        <tr>
                                                            <td>{{ ++$loop->index }}</td>
                                                            <td><strong>{{ $val->name }}</strong></td>
                                                            <td>{{ $val->email }}</td>
                                                            <td>{{ $role[$val->role_id] }}</td>
                                                            <td>{!! $val->is_active == 1
                                                                ? '<span class="text-success">Active</span>'
                                                                : '<span class="text-danger">Inactive</span>' !!}</td>
                                                            <td>{{ date('d/m/Y', strtotime($val->created_at)) }}</td>

                                                            <td class="text-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">

                                                                        @if (Auth::user()->role_id == 9 && in_array($val->role_id, ['3']))
                                                                        <a class="dropdown-item open-module-form" data-type="add_user" data-id="{{ $val->id }}" href="{{ route('user.update', ['updateid' => $val->id]) }}">
                                                                            <i class="bx bx-edit-alt me-1"></i>
                                                                            Edit
                                                                        </a>
                                                                        @elseif (Auth::user()->role_id == 10 && in_array($val->role_id, ['4']))
                                                                        <a class="dropdown-item open-module-form" data-type="add_user" data-id="{{ $val->id }}" href="{{ route('user.update', ['updateid' => $val->id]) }}">
                                                                            <i class="bx bx-edit-alt me-1"></i>
                                                                            Edit
                                                                        </a>
                                                                        @elseif(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 5)
                                                                        <a class="dropdown-item open-module-form" data-type="add_user" data-id="{{ $val->id }}" href="{{ route('user.update', ['updateid' => $val->id]) }}">
                                                                            <i class="bx bx-edit-alt me-1"></i>
                                                                            Edit
                                                                        </a>
                                                                        @endif

                                                                    <a class="dropdown-item" href="{{ url('employee/time-log', $val->id) }}"><i class="bx bx-edit-alt me-1"></i>Time Log</a>
                                                                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 9)
                                                                        <a class="dropdown-item"  onclick="return confirm('Do you really want to delete this data?')"
                                                                            href="{{ route('user.delete', ['deleteid' => $val->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
    //         $(document).on("click", ".form-submit", function(e) {
	// 	        e.preventDefault();
    //             if($("#name").val() == ""){
    //                 toastr.error('User name is a require field!');
    //                 $("#name").focus();
    //                 $("#name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    //                 return false;
    //             }else if($("#email").val() == ""){
    //                 toastr.error('Email id is a require field!');
    //                 $("#email").focus();
    //                 $("#email").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    //                 return false;
    //             }else if($("#role_id").val() == ""){
    //                 toastr.error('Role id is a require field!');
    //                 $("#role_id").focus();
    //                 $("#role_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    //                 return false;
    //             }else if($("#password").val() == ""){
    //                 toastr.error('Password is a require field!');
    //                 $("#password").focus();
    //                 $("#password").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    //                 return false;
    //             }else if($("#password").val() != $("#confirm_password").val()){
    //                 toastr.error('Confirm Password does not match!');
    //                 $("#confirm_password").focus();
    //                 $("#confirm_password").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    //                 return false;
    //             } else{
    //               $('.save').submit();
    //          } 

	//  });

        });
    </script>
@endsection
