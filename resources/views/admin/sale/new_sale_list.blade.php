@section('title', 'Sales list')
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
                        </span> Sales list
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales list</li>
                    </ul>
                </div>
            </div>

           <!-- Page Header -->
           <div class="page-header pt-3 mb-0 ">
            <div class="row">
                <div class="col">
                  
                </div>
                <div class="col text-end">
                    <a href="#" class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded open-module-form" data-type="add_sales">Add Sales</a>
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
                                        <div class="col-md-3">
                                          
                                        </div>          
                                        <div class="col-md-3 pt-3">
                                            <div class="input-group input-group-merge">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Search by status</option>
                                                    @foreach (projectstatus() as $val)
                                                    <option value="{{ $val }}" {{ $status == $val?'Selected':'' }}>{{ $val }}</option>
                                                    @endforeach
                                                </select>                       
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('sales.new.list.success') }}" method="post" class="align-items-center d-flex p-3 justify-content-center">
                                                @csrf
                                                <div class="input-group input-group-merge">
                                                <span class="input-group-text" id="basic-addon-search31"><i class="ion-ios7-search" data-bs-toggle="tooltip" title="" data-bs-original-title="ion-ios7-search" aria-label="ion-ios7-search"></i></span>
                                                <input type="text" class="form-control" name="search" placeholder="Search by project name & client name..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                                </div>
                                                <input type="submit" value="Search" class="btn ms-2 btn-primary">
                                            </form>                  
                                        </div>         
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid"  aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                                aria-label="Task Name: activate to sort column descending"
                                                                aria-sort="ascending">CLIENT NAME</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                                aria-label="Percent Complete Indicator: activate to sort column ascending"
                                                                >PROJECT NAME</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                                aria-label="Responsible User: activate to sort column ascending"
                                                                >ASSIGN TO</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Due Date: activate to sort column ascending"
                                                                >PROJECT TYPE</th>
    
                                                                
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Task Owner: activate to sort column ascending"
                                                                >CLOSER NAME</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Status: activate to sort column ascending"
                                                                >GROSS AMOUNT</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label=": activate to sort column ascending"
                                                                >NET AMOUNT</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label=": activate to sort column ascending"
                                                                >SALE DATE</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label=": activate to sort column ascending"
                                                                >STATUS</th>
                                                            <th class="text-end sorting" tabindex="0"
                                                                aria-controls="DataTables_Table_0" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Actions: activate to sort column ascending"
                                                                >ACTIONS</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $val)
                                                    <tr class={{ Auth::user()->id ==1?getcommentstatus($val->id)==0?'text-danger':'':'' }}>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $val->client_name }}</strong></td>
                                                    <td>{{ $val->project_name }}</td>
                                                    <td>{{  assignto($val->id) }}</td>
                                                    <td>{{ $projectType[$val->project_type] }}</td>
                                                    <td>{{ $val->closer_name }}</td>
                                                    <td>{{ number_format($val->gross_amount, 2) }}</td>
                                                    <td>{{ number_format($val->net_amount, 2) }}</td>
                                                    <td>{{ date("d/m/Y", strtotime($val->sale_date)) }}</td>
                                                    <td>{{ $val->status }}</td>
                                                   
                                                    <td class="text-center">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item  open-module-form" data-id="{{ $val->id }}" data-type="add_sales" href="{{ route('sales.update', ['updateid' => $val->id ]) }}"
                                                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                        <a class="dropdown-item" href="{{ route('sales.view', ['salesid' => $val->id ]) }}"
                                                                            ><i class="fa fa-eye"></i> Show</a>
                                                                        @if(Auth::user()->role_id < 3 )
                                                                        <a class="dropdown-item open-module-form" data-id="{{ $val->id }}" data-type="add_sales" data-sale="assign" href="{{ route('sales.assign', ['taskid' => $val->id ]) }}"
                                                                            ><i class="bx bx-edit-alt me-1"></i> Assign</a>
                                                                        @endif
                                                                        <a class="dropdown-item open-module-form" data-id="{{ $val->id }}" data-type="add_sales" data-sale="comment" href="{{ route('comment.index', ['taskid' => $val->id ]) }}"
                                                                            ><i class="bx bx-edit-alt me-1"></i>Comment</a> 
                                                                       
                                                                        @if(Auth::user()->role_id == 1)
                                                                        <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')"  href="{{ route('sales.delete', ['deleteid' => $val->id]) }}"
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

<!-- Modal -->
<div class="modal fade" id="add_client_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div class="card">
                     <div class="card-body">
                        <span class="text-success">{{ Session::get('successmsg') }}</span>
                        <form method="post" action="{{ route('sales.client.insert.suceess') }}" class="client-save">
                          @csrf
                          <div class="row">
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="name">Client Name <span class="text-danger">*</span></label>
                                      <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ old('name') }}" />
                                      @if($errors->has('name'))
                                      <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                                      @endif
                                  </div>
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="country_name">{{ __("Country name") }} <span class="text-danger">*</span></label>
                                      <select name="country_name" id="country_name" class="form-control">
                                          <option value="">Select</option>
                                          @foreach(country() as $val)
                                          <option value="{{ $val['name'] }}" {{ (old('country_name') == $val['name'])?'Selected':'' }}>{{ $val['name'].' ('.$val['code'].')' }}</option>
                                          @endforeach    
                                      </select>
                                      @if($errors->has('country_name'))
                                      <small class="text-danger" id="country_nameerrmsg">{{ $errors->first('country_name') }}</small>
                                      @endif
                                  </div>   
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="email">{{ __("Email ID(Primary)") }} <span class="text-danger">*</span></label>
                                      <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ old('email') }}"/>
                                      @if($errors->has('email'))
                                      <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                                      @endif
                                  </div>  
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" id="address" name="address" placeholder="1A, Ho Chi Minh Sarani Rd" value="{{ old('address') }}"/>
                                      @if($errors->has('email'))
                                      <small class="text-danger" id="addresserrmsg">{{ $errors->first('address') }}</small>
                                      @endif
                                  </div>   
                                  <div class="col-md-5 mb-3">
                                      <label class="form-label" for="email">{{ __("Email ID") }}</label>
                                      <input type="email" class="form-control" id="alteremail" name="alteremail[]" placeholder="xyz@gmail.com" />
                                  </div>  
                                  <div class="col-md-5 mb-3">
                                      <label class="form-label" for="address">{{ __('Mobile No') }}</label>
                                      <input type="text" class="form-control" id="mobile_no1" name="mobile_no[]" placeholder="+998889823" />
                                  </div>    
                                  <div class="col-md-2 mb-3">
                                 
                                      <span id="addrow" class="btn btn-primary mt-4" ><i class="fa fa-plus" ></i></span>
                                  </div>   
                                  <span id="multipleimage"></span>  
                                  
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="current_website">{{ __('Current Website') }}</label>
                                      <input type="text" class="form-control" id="current_website" name="current_website" placeholder="webart.technology" value="{{ old('current_website') }}"/>
                                      @if($errors->has('current_website'))
                                      <small class="text-danger" id="current_websiteerrmsg">{{ $errors->first('current_website') }}</small>
                                      @endif
                                  </div>  
  
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="agent_name">{{ __('Agent Name') }} <span class="text-danger">*</span></label>                                    
                                      <input type="text" name="agent_name" id="client_agent_name" class="form-control" placeholder="Agent name" value="{{ old('agent_name') }}">     
                                      @if($errors->has('agent_name'))
                                      <small class="text-danger" id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                                      @endif                             
                                  </div> 
  
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="closer_name">{{ __('Closer Name') }} <span class="text-danger">*</span></label>                                    
                                      <input type="text" name="closer_name" id="client_closer_name" class="form-control" placeholder="Closer name" value="{{ old('closer_name') }}">     
                                      @if($errors->has('closer_name'))
                                      <small class="text-danger" id="closer_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                                      @endif                            
                                  </div> 
  
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label" for="remarks">{{ __('Remarks') }} <span class="text-danger">*</span></label>
                                      <textarea class="form-control" id="remarks" name="remarks" placeholder="Your remarks here...">{{ old('current_website') }}</textarea>
                                      @if($errors->has('remarks'))
                                      <small class="text-danger" id="remarkserrmsg">{{ $errors->first('remarks') }}</small>
                                      @endif   
                                  </div> 
                          </div>  
                      </div>
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add-client-form-submit">Save</button>
        </div>
         </form>
      </div>
    </div>
</div>

@endsection
@section('script')
<script>
$(function(){

    $("#status").change(function(){
        window.location.href = "/sales/list?status="+$("#status").val();
    });
  
    $(document).on("click", ".form-submit", function(e) {
		e.preventDefault();
        if($("#client_id").val() == ""){
            toastr.error('Client name is a require field!');
            $("#client_id").focus();
            $("#client_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_name").val() == ""){
            toastr.error('Project name is a require field!');
            $("#project_name").focus();
            $("#project_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == ""){
            toastr.error('Project type is a require field!');
            $("#project_type").focus();
            $("#project_type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 1 && $("#technology").val() == ""){
            toastr.error('Technology name is a require field!');
            $("#technology").focus();
            $("#technology").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 1 && $("#type").val() == ""){
            toastr.error('Type is a require field!');
            $("#type").focus();
            $("#type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#type").val() == 5 && $("#customer_requerment").val() == ''){
            toastr.error('Custom requirements is a require field!');
            $("#customer_requerment").focus();
            $("#customer_requerment").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $('input[type=radio][name=digital_marketing]:checked').length == 0){
            toastr.error('Select one platform atleast!');
            $("#seo").focus();
            $("#seo").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $('input[name^=smo_platfrom]:checked').length == 0 && ($('input[type=radio][name=digital_marketing]:checked').val() == 'SMO' || $('input[type=radio][name=digital_marketing]:checked').val() == 'SEO_SMO')){
            toastr.error('Select one smo platform atleast!');
            $("#facebook").focus();
            $("#facebook").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $("#end_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 3 && $("#mobile_app_platform").val() == ""){
            toastr.error('Platform name is a required field!');
            $("#mobile_app_platform").focus();
            $("#mobile_app_platform").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 3 && $("#preferred_technology").val() == ""){
            toastr.error('Prefer technology is a required field!');
            $("#preferred_technology").focus();
            $("#preferred_technology").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 4 && $("#cus_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#cus_project_description").focus();
            $("#cus_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 5 && $("#gra_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#gra_project_description").focus();
            $("#gra_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 6 && $("#ui_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#ui_project_description").focus();
            $("#ui_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 7 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 7 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 8 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 8 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 9 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 9 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#business_name").val() == ''){
            toastr.error('Business name is a required field!');
            $("#business_name").focus();
            $("#business_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#closer_name").val() == ''){
            toastr.error('Closer name is a required field!');
            $("#closer_name").focus();
            $("#closer_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#agent_name").val() == ''){
            toastr.error('Agent name is a required field!');
            $("#agent_name").focus();
            $("#agent_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#remark").val() == ''){
            toastr.error('Remarks is a required field!');
            $("#remark").focus();
            $("#remark").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#gross_amt").val() == ''){
            toastr.error('Gross amount in a required field!');
            $("#gross_amt").focus();
            $("#gross_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#net_amt").val() == ''){
            toastr.error('Net amount is a required field!');
            $("#net_amt").focus();
            $("#net_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#due_amt").val() == ''){
            toastr.error('Due amount is a required field!');
            $("#due_amt").focus();
            $("#due_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#sale_date").val() == ''){
            toastr.error('Sale date is a required field!');
            $("#sale_date").focus();
            $("#sale_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#payment_mode").val() == ''){
            toastr.error('Sale date is a required field!');
            $("#payment_mode").focus();
            $("#payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#payment_mode").val() == 6 && $("#other_pay").val() == ''){
            toastr.error('Payment description is a required field!');
            $("#other_pay").focus();
            $("#other_pay").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else{
            $('.form-save').submit();
        } 
});


$(document).on("keyup", ".pendingamount", function(e) {
    
  const grossAmount = $("#gross_amt").val()?parseInt($("#gross_amt").val()):'0'
  const netAmount = $("#net_amt").val()?parseInt($("#net_amt").val()):'0'

  if(grossAmount >= netAmount){
  const pendingAmount = grossAmount - netAmount;
  $("#due_amt").val(pendingAmount);
  }else{
    toastr.error('Net amount must be lower than gross amount!');
    $("#net_amt").focus();
    $("#net_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    $("#due_amt").val(0);
  }
});


    /////// Client Add Section
    
    $(document).on("click", ".add-client-form-submit", function(e) {
		e.preventDefault();

        if($("#name").val() == ""){
            toastr.error('Client name is a require field!');
            $("#name").focus();
            $("#name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#country_name").val() == ""){
            toastr.error('Country name is a require field!');
            $("#country_name").focus();
            $("#country_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#email").val() == ""){
            toastr.error('Email id is a require field!');
            $("#email").focus();
            $("#email").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#address").val() == ""){
            toastr.error('Address is a require field!');
            $("#address").focus();
            $("#address").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#client_agent_name").val() == ""){
            toastr.error('Agent name is a require field!');
            $("#client_agent_name").focus();
            $("#client_agent_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#client_closer_name").val() == ""){
            toastr.error('Closer name is a require field!');
            $("#client_closer_name").focus();
            $("#client_closer_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else if($("#remarks").val() == ""){
            toastr.error('Remark is a require field!');
            $("#remarks").focus();
            $("#remarks").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else{
            $('.client-save').submit();
        } 
});


        let lineNo = 2;     
        $("#addrow").click(function () {         
            markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5 mb-3"><label class="form-label" for="email">{{ __("Email ID") }}</label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5 mb-3"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" /></div> <div class="col-md-2 mb-3"> <span class="btn btn-danger mt-4 delete-row"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
            tableBody = $("#multipleimage");
            tableBody.append(markup);
            lineNo++;
        });


       $(document).on("click", '.delete-row', function(e) {
            $(this).parent().parent().remove();
        });


        $(document).on("click", '.sendmessage', function(e) {
          $.ajax({
                 type:'GET',
                 url:'{{route("comment.add.success")}}',
                 data: 'message='+$(".textmessage").val()+'&task_id='+$("#task_id").val(),
                 success:function(data) {
                  getMessage();
                  $(".textmessage").val('');
                 }
          });
       });
  
  
      const getMessage = () => {
          $.ajax({
                  type:'GET',
                  url:'{{route("comment.list")}}',
                  data: 'task_id='+$("#task_id").val(),
                  success:function(data) {
                  $("#message").html(data);
                  }
          });
      }



      //  Assign task Section

      $(document).on("click", ".assign-submit", function(e) {
		e.preventDefault();

        if($("#client_id").val() == ""){
            toastr.error('Client name is a require field!');
            $("#client_id").focus();
            $("#client_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_name").val() == ""){
            toastr.error('Project name is a require field!');
            $("#project_name").focus();
            $("#project_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == ""){
            toastr.error('Project type is a require field!');
            $("#project_type").focus();
            $("#project_type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 1 && $("#technology").val() == ""){
            toastr.error('Technology name is a require field!');
            $("#technology").focus();
            $("#technology").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 1 && $("#type").val() == ""){
            toastr.error('Type is a require field!');
            $("#type").focus();
            $("#type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $('input[type=radio][name=digital_marketing]:checked').length == 0){
            toastr.error('Select one platform atleast!');
            $("#seo").focus();
            $("#seo").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $('input[name^=smo_platfrom]:checked').length == 0 && ($('input[type=radio][name=digital_marketing]:checked').val() == 'SMO' || $('input[type=radio][name=digital_marketing]:checked').val() == 'SEO_SMO')){
            toastr.error('Select one smo platform atleast!');
            $("#facebook").focus();
            $("#facebook").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 2 && $("#end_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 3 && $("#mobile_app_platform").val() == ""){
            toastr.error('Platform name is a required field!');
            $("#mobile_app_platform").focus();
            $("#mobile_app_platform").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 3 && $("#preferred_technology").val() == ""){
            toastr.error('Prefer technology is a required field!');
            $("#preferred_technology").focus();
            $("#preferred_technology").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 4 && $("#cus_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#cus_project_description").focus();
            $("#cus_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 5 && $("#gra_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#gra_project_description").focus();
            $("#gra_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 6 && $("#ui_project_description").val() == ""){
            toastr.error('Project description is a required field!');
            $("#ui_project_description").focus();
            $("#ui_project_description").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 7 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 7 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 8 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 8 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 9 && $("#start_date").val() == ""){
            toastr.error('Start date is a required field!');
            $("#start_date").focus();
            $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#project_type").val() == 9 && $("#end_date").val() == ""){
            toastr.error('End date is a required field!');
            $("#end_date").focus();
            $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#business_name").val() == ''){
            toastr.error('Business name is a required field!');
            $("#business_name").focus();
            $("#business_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#closer_name").val() == ''){
            toastr.error('Closer name is a required field!');
            $("#closer_name").focus();
            $("#closer_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#agent_name").val() == ''){
            toastr.error('Agent name is a required field!');
            $("#agent_name").focus();
            $("#agent_name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#remark").val() == ''){
            toastr.error('Remarks is a required field!');
            $("#remark").focus();
            $("#remark").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#gross_amt").val() == ''){
            toastr.error('Gross amount in a required field!');
            $("#gross_amt").focus();
            $("#gross_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#net_amt").val() == ''){
            toastr.error('Net amount is a required field!');
            $("#net_amt").focus();
            $("#net_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#due_amt").val() == ''){
            toastr.error('Due amount is a required field!');
            $("#due_amt").focus();
            $("#due_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#sale_date").val() == ''){
            toastr.error('Sale date is a required field!');
            $("#sale_date").focus();
            $("#sale_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#payment_mode").val() == ''){
            toastr.error('Sale date is a required field!');
            $("#payment_mode").focus();
            $("#payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#payment_mode").val() == 6 && $("#other_pay").val() == ''){
            toastr.error('Payment description is a required field!');
            $("#other_pay").focus();
            $("#other_pay").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        }else  if($("#assign_to").val() == ''){
            toastr.error('Assign to field is a required field!');
            $("#assign_to").focus();
            $("#assign_to").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
            return false;
        } else{
            $('.assign-form-save').submit();
        } 
});

});



</script>
@endsection