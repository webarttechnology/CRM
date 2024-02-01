@section('title', 'Client List')
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
                        </span> Client list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Client List</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-end">
                        <a href="#"
                            class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form"
                            data-type="add_client">Add Client</a>
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
                                                            <form action="{{ route('sales.client.list.success') }}"
                                                                method="post"
                                                                class="align-items-center d-flex justify-content-center">
                                                                @csrf
                                                                <div class="input-group input-group-merge">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon-search31"><i class="ion-ios7-search"
                                                                            data-bs-toggle="tooltip" title=""
                                                                            data-bs-original-title="ion-ios7-search"
                                                                            aria-label="ion-ios7-search"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="search" placeholder="Search..."
                                                                        aria-label="Search..."
                                                                        aria-describedby="basic-addon-search31">
                                                                </div>
                                                                <input type="submit" value="Search"
                                                                    class="btn ms-2 btn-primary">
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
                                                    <tr role="row">
                                                        <th>CLIENTID</th>
                                                        <th>CLIENT NAME</th>
                                                        <th>EMAIL ID</th>
                                                        <th>CREATED AT</th>
                                                        <th>ACTIONS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($data as $val)
                                                        <tr>
                                                            <td>{{ $val->client_code }}</td>
                                                            <td><strong>{{ $val->name }}</strong></td>
                                                            <td>{{ $val->email }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($val->created_at)) }}</td>
                                                            <td class="text-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                            class="material-icons">more_vert</i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item open-module-form"
                                                                            data-type="add_client"
                                                                            data-id="{{ $val->id }}"
                                                                            href="{{ route('sales.client.update', ['updateid' => $val->id]) }}"><i
                                                                                class="bx bx-edit-alt me-1"></i>Edit</a>
                                                                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 9)
                                                                            <a class="dropdown-item"
                                                                                onclick="return confirm('Do you really want to delete this data?')"
                                                                                href="{{ route('sales.client.delete', ['deleteid' => $val->id]) }}"><i
                                                                                    class="bx bx-trash me-1"></i>
                                                                                Delete</a>
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
            let lineNo = 2;
            $(document).on("click", "#addrow", function(e) {
                e.preventDefault();
                markup = '<div class="row" id="deleterow' + lineNo +
                    '"> <div  class="col-md-5 mb-3"><label class="form-label" for="email">{{ __('Email ID') }}</label><input type="email" class="form-control" id="alteremail' +
                    lineNo +
                    '" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5"><label class="form-label" for="address">{{ __('Mobile No') }}</label><input type="text" class="form-control" id="address' +
                    lineNo +
                    '" name="mobile_no[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="10" maxlength="10" placeholder="7896541230" /></div> <div class="col-md-2"> <span class="btn btn-danger mt-4 delete-row"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>';
                tableBody = $("#multipleimage");
                tableBody.append(markup);
                lineNo++;
            });


            $(document).on("click", '.delete-row', function(e) {
                $(this).parent().parent().remove();
            });


            // $(document).on("click", ".form-submit", function(e) {
            // 	e.preventDefault();
            //       if($("#name").val() == ""){
            //         toastr.error('Client name is a require field!');
            //         $("#name").focus();
            //         $("#name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#country_name").val() == ""){
            //         toastr.error('Country name is a require field!');
            //         $("#country_name").focus();
            //         $("#country_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#email").val() == ""){
            //         toastr.error('Email id is a require field!');
            //         $("#email").focus();
            //         $("#email").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#address").val() == ""){
            //         toastr.error('Address is a require field!');
            //         $("#address").focus();
            //         $("#address").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#agent_name").val() == ""){
            //         toastr.error('Agent name is a require field!');
            //         $("#agent_name").focus();
            //         $("#agent_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#closer_name").val() == ""){
            //         toastr.error('Closer name is a require field!');
            //         $("#closer_name").focus();
            //         $("#closer_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else if($("#remarks").val() == ""){
            //         toastr.error('Remark is a require field!');
            //         $("#remarks").focus();
            //         $("#remarks").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            //         return false;
            //     }else{
            //         $('.save').submit();
            //     } 

            //  });

        });
    </script>
@endsection
