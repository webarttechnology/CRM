@section('title', 'Time log List')
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
                        </span>Time log
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Time Log</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-end">
                        {{-- <a href="#" class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form"
                            data-type="add_user">Add User</a> --}}
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
                                        <div class="col-md-6">
                                              @php
                                                $user =  App\Models\User::find(request()->id);
                                              @endphp
                                            <h3>{{ $user->name }}</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-end mb-3">
                                                            <form  class="align-items-center d-flex justify-content-center">
                                                              
                                                                 <div class="row">
                                                                     <div class="col-md-6">
                                                                           <label for="">From Date</label>
                                                                          <input type="date" name="from" class="form-control" required value="{{ request()->from }}">
                                                                     </div>
                                                                     <div class="col-md-6">
                                                                       <label for="">To Date</label>
                                                                       <input type="date" name="to" class="form-control" value="{{ request()->to }}">
                                                                  </div>
                                                                 </div>
                                                              
                                                                <input type="submit" value="Search" class="btn ms-2 mt-3 btn-primary">
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
                                                        <th>Date</th>
                                                        <th>ClockIn</th>
                                                        <th>ClockOut</th>
                                                        <th>Total Working time</th>
                                                        <th>Total Break time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($timelog as $key => $val)
                                                           @php

                                                            $firstClockIn = $val->first();

                                                             if($val->last()->status == 'end'){

                                                                 $lastClockOut = $val->last();

                                                             }else{

                                                                $lastClockOut = null;

                                                             }

                                                            //  dd(ClockBreakTimePerUser( $val, 'break'));
                                                        
                                                           @endphp
                                                        <tr>
                                                            <td>{{ ++$loop->index }}</td>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $firstClockIn->created_at->format('H:i A') }}</td>
                                                            <td>{{ $lastClockOut?->created_at->format('H:i A') ?? 'NAN' }}</td>
                                                            <td>{{ ClockBreakTimePerUser( $val, 'work')['timeformat'] }}</td>
                                                            <td>{{ ClockBreakTimePerUser( $val, 'break')['timeformat'] }}</td>
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
