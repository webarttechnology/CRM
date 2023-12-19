@section('title', 'Group list')
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
                        </span> Group list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Group Member list</li>
                    </ul>
                </div>
            </div>



            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-md-3">

                                        </div>
                                        <div class="col-md-3 pt-3">
                                           
                                        </div>
                                        <div class="col-md-6">
                                      
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
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Task Name: activate to sort column descending"
                                                            aria-sort="ascending"> NAME</th>

                                                        <th class="text-end sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Actions: activate to sort column ascending">ACTIONS
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($group_member as $data)
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                                <strong>{{ $data->user->name }}</strong>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                            class="material-icons">more_vert</i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item"
                                                                            onclick="return confirm('Do you really want to remove this member?')"
                                                                            href="{{ route('group.memberdelete', ['groupmemberid' => $data->id]) }}"><i
                                                                                class="bx bx-trash me-1"></i>
                                                                            Delete</a>
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
    <script></script>
@endsection
