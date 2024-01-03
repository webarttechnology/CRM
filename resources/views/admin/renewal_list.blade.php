@section('title', 'Renewal list')
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
                        </span>Renewal list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Renewal list</li>
                    </ul>
                </div>
            </div>

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive mt-5">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                    <th>Client name</th>
                                                    <th>Email ID</th>
                                                    <th>Project name</th>
                                                    <th>Renewal for</th>
                                                    <th>Renewal Data</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($sales as $val)               
                                                    <tr>
                                                        <td><strong>{{ $val->name.' ('. $val->client_code.' )' }}</strong></td>
                                                        <td>{{ $val->email }}</td>
                                                        <td>{{ $val->project_name }}</td>
                                                        <td>{{ $project_type[$val->project_type] }}</td>
                                                        <td>{{ date("d/m/Y", strtotime($val->end_date)) }}</td>                        
                                                    </tr> 
                                                    @endforeach
                                                    @foreach($upsales as $uval)
                                                    <tr>
                                                        <td><strong>{{ $uval->name.' ('. $uval->client_code.' )' }}</strong></td>
                                                        <td>{{ $uval->email }}</td>
                                                        <td>{{ $uval->project_name }}</td>
                                                        <td>{{ $upsale_type[$uval->upsale_type] }}</td>
                                                        <td>{{ date("d/m/Y", strtotime($uval->end_date)) }}</td>                        
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


