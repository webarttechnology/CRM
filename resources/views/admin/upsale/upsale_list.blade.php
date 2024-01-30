@section('title', 'Upsale list')
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
                        </span>Upsale list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Upsale list</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
           <div class="page-header pt-3 mb-0 ">
            <div class="row">
                <div class="col">
                  
                </div>
                <div class="col text-end">
                {{-- @if (Auth::user()->role_id != 3) --}}

                    <a href="#" class="add mb-3 btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form" data-type="add_upsale">Add Upsale</a>
                    {{-- @endif --}}
              
                </div>
            </div>
        </div>
        <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-8">
                               
                            </div>          
                            <div class="col-md-4">
                                <form action="{{ route('upsale.list.success') }}" method="post" class="align-items-center p-3 d-flex justify-content-center">
                                    @csrf
                                    <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                    </div>
                                    <input type="submit" value="Search" class="btn ms-2 btn-primary">
                                </form>                  
                            </div>         
                        </div>
                        <div class="tab-content">
                            <div class="table-responsive text-nowrap">
                                <span class="text-success">{{ Session::get('successmsg') }}</span>
                                <span class="text-danger">{{ Session::get('errmsg') }}</span>

                                <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid"  aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Task Name: activate to sort column descending"
                                                    aria-sort="ascending">Client name</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Percent Complete Indicator: activate to sort column ascending"
                                                    >Project name</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Responsible User: activate to sort column ascending"
                                                    >Upsale for</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Due Date: activate to sort column ascending"
                                                    >Gross Amount</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Task Owner: activate to sort column ascending"
                                                    >Net Amount</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Status: activate to sort column ascending"
                                                    >Due Amount</th>
                                                <th class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                    colspan="1"
                                                    aria-label=": activate to sort column ascending"
                                                    >Sale date</th>
                                                <th class="text-end sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Actions: activate to sort column ascending"
                                                    >ACTIONS</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $val)               
                                        <tr>
                                            <td>{{ $val->client_name }}</td>
                                            <td>{{ $val->project_name }}</td>
                                            <td>{{ $upsaleFor[$val->upsale_type] }}</td>
                                            <td>{{ number_format($val->gross_amount, 2) }}</td>
                                            <td>{{ number_format($val->net_amount, 2) }}</td>
                                            <td>{{ number_format($val->gross_amount - $val->net_amount, 2) }}</td>
                                            <td>{{ date("d/m/Y", strtotime($val->sale_date)) }}</td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item open-module-form" data-id="{{ $val->id }}" data-type="add_upsale" href="{{ route('upsale.update', ['updateid' => $val->id ]) }}"
                                                            ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 9)
                                                            <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')" href="{{ route('upsale.delete', ['deleteid' => $val->id ]) }}"
                                                            ><i class="bx bx-trash me-1"></i> Delete</a>
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
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
  </div>
@endsection

@section('script')
<script>
    $(function(){

//      $(document).on("click", ".form-submit", function(e) {
// 		e.preventDefault();
//         if($("#client_id").val() == ""){
//             toastr.error('Client name is a require field!');
//             $("#client_id").focus();
//             $("#client_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//             return false;
//         }else  if($("#project_id").val() == ""){
//             toastr.error('Project name is a require field!');
//             $("#project_id").focus();
//             $("#project_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//             return false;
//         }else  if($("#upsale_type").val() == ""){
//             toastr.error('Upsale type is a require field!');
//             $("#upsale_type").focus();
//             $("#upsale_type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//             return false;
//         }else  if(($("#upsale_type").val() == 1 || $("#upsale_type").val() == 2 || $("#upsale_type").val() == 3) && $("#start_date").val() == ""){
//             toastr.error('Start date is a required field!');
//             $("#start_date").focus();
//             $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//             return false;
//         }else  if(($("#upsale_type").val() == 1 || $("#upsale_type").val() == 2 || $("#upsale_type").val() == 3) && $("#end_date").val() == ""){
//             toastr.error('Start date is a required field!');
//             $("#end_date").focus();
//             $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//             return false;
//         }else{
//             $('.form-save').submit();
//         } 
// });
          

    });
</script>
@endsection