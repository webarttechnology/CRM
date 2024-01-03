@section('title', 'Collection list')
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
                        </span> Collection list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Collection list</li>
                    </ul>
                </div>
            </div>

               <!-- Page Header -->
           <div class="page-header pt-3 mb-0 ">
            <div class="row">
                <div class="col">
                  
                </div>
                <div class="col text-end">
                    <a href="#" class="add mb-3 btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form" data-type="add_collection">Add Collection</a>
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
                                        <div class="col-md-2">
                                          
                                        </div>          
                                        <div class="col-md-2 pt-3">
                                           
                                        </div>
                                        <div class="col-md-8">
                                            <form action="{{ route('collection.list.success') }}" method="post" class="align-items-center p-3">
                                                @csrf
                                                <div class="row px-md-5">
                                                    <div class="col-md-5">
                                                        <div class="input-group input-group-merge mobile_mb_3">
                                                        <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                                        <input type="date" class="form-control" name="start_date" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group input-group-merge mobile_mb_3">
                                                        <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                                        <input type="date" class="form-control" name="end_date" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="submit" value="Search" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </form>                     
                                        </div>         
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid"  aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                    <th>Client name</th>
                                                    <th>Project name</th>
                                                    <th>Currency</th>  
                                                    <th>Net Amount</th>             
                                                    <th>Instalment</th>
                                                    <th>Payment Mode</th>
                                                    <th>Payment date</th>
                                                    <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $val)               
                                                    <tr>
                                                        <td>{{ $val->client_name }}</td>
                                                        <td>{{ Str::limit($val->project_name, 20, '...') }}</td>
                                                        <td>{{ $currency[$val->currency] }}</td>
                                                        <td>{{ number_format($val->net_amount, 2) }}</td>
                                                        <td>{{ $instalment[$val->instalment] }}</td>
                                                        <td>{{ $val->payment_mode != 6?$paymentmode[$val->payment_mode]:$val->other_payment_mode }}</td>
                                                        <td>{{ date("d/m/Y", strtotime($val->sale_date)) }}</td>
                                                        <td>
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item  open-module-form" data-id="{{ $val->id }}" data-type="add_collection" href="{{ route('collection.update', ['updateid' => $val->id ]) }}"
                                                                        ><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                                                        @if(Auth::user()->role_id == 1)
                                                                        <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')" href="{{ route('collection.delete', ['deleteid' => $val->id]) }}"
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

//     $(document).on("click", ".form-submit", function(e) {
// 		e.preventDefault();
//         if($("#client_id").val() == ""){
//         toastr.error('Client name is a require field!');
//         $("#client_id").focus();
//         $("#client_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#project_id").val() == ""){
//         toastr.error('Project name is a require field!');
//         $("#project_id").focus();
//         $("#project_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#currency").val() == ""){
//         toastr.error('Currency is a require field!');
//         $("#currency").focus();
//         $("#currency").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#instalment").val() == ""){
//         toastr.error('Instalment is a require field!');
//         $("#instalment").focus();
//         $("#instalment").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#net_amt").val() == ""){
//         toastr.error('Net amount is a require field!');
//         $("#net_amt").focus();
//         $("#net_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#sale_date").val() == ""){
//         toastr.error('Sale date is a require field!');
//         $("#sale_date").focus();
//         $("#sale_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#payment_mode").val() == ""){
//         toastr.error('Payment mode is a require field!');
//         $("#payment_mode").focus();
//         $("#payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else  if($("#payment_mode").val() == 6 && $("#other_payment_mode").val() == ''){
//         toastr.error('Other payment mode is a require field!');
//         $("#other_payment_mode").focus();
//         $("#other_payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
//         return false;
//         }else{
//             $('.form-save').submit();
//         } 
// });

});
</script>
@endsection