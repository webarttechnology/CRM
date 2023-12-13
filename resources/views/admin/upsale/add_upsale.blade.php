@section('title', 'Upsale Add')
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
                        </span>Upsale Add
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Upsale Add</li>
                    </ul>
                </div>
            </div>

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">                  
                    <div class="card-body">
                      <form method="post" action="{{ route('upsale.add.success') }}" onsubmit="return valid();">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                    <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                                    <select name="client_id" id="client_id" class="form-control" onchange="getproject();">
                                        <option value="">--Select--</option>
                                        @foreach($clients as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'].' ('.$val['client_code'].')' }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('client_id'))
                                    <small class="text-danger" id="client_iderrmsg">{{ $errors->first('client_id') }}</small>
                                    @endif 
                            </div>   
                            <div class="col-md-6 mb-3">
                                    <label class="form-label" for="project_id">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                    @if($errors->has('project_id'))
                                    <small class="text-danger">{{ $errors->first('project_id') }}</small>
                                    @endif    
                            </div>  
                            <div class="col-md-12 mb-3">
                                    <label class="form-label" for="upsale_type">{{ __('Upsale Product') }} <span class="text-danger">*</span></label>
                                    <select name="upsale_type" id="upsale_type" class="form-control" onchange="projectTypechangeEvent()">
                                        <option value="">--Select--</option>
                                        @foreach(upsale_type() as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach                                   
                                    </select>
                                    @if($errors->has('upsale_type'))
                                    <small class="text-danger" id="upsale_typeerrmsg">{{ $errors->first('upsale_type') }}</small>
                                    @endif
                            </div>
                        </div> 
                        <div class="row" id="div_hosting">
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="start_date">{{ __("Start Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="start_date" id="start_date" class="form-control">                                        
                                  </div>  
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="end_date">{{ __("End Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="end_date" id="end_date" class="form-control">                                            
                                  </div>
                        </div>

                        <div class="row" id="div_other">
                            <div class="col-md-12 mb-3">
                              <label class="form-label" for="other">{{ __("Others Description") }} <span class="text-danger">*</span></label>
                              <textarea name="other" id="other" class="form-control" placeholder="Other Description"></textarea>
                            </div> 
                        </div>
                          <div class="row">                           
                              <div class="col-md-4 mb-3">
                                    <label class="form-label" for="gross_amt">{{ __("Gross Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="gross_amt" id="gross_amt" class="form-control pendingamount" placeholder="$">  
                                    @if($errors->has('gross_amt'))
                                    <small class="text-danger">{{ $errors->first('gross_amt') }}</small>
                                    @endif               
                              </div>
                              <div class="col-md-4 mb-3">
                                    <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$">  
                                    @if($errors->has('net_amt'))
                                    <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                                    @endif             
                              </div>
                              <div class="col-md-4 mb-3">
                                    <label class="form-label" for="due_amt">{{ __("Due Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="text" readonly name="due_amt" id="due_amt" class="form-control" placeholder="$">              
                              </div>
                              <div class="col-md-6 mb-3">
                                    <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="sale_date" id="sale_date" class="form-control" >  
                                    @if($errors->has('sale_date'))
                                    <small class="text-danger">{{ $errors->first('sale_date') }}</small>
                                    @endif             
                              </div>
                              <div class="col-md-6 mb-3">
                                    <label class="form-label" for="payment_mode">{{ __('Payment Mode') }}<span class="text-danger">*</span></label>
                                    <select name="payment_mode" id="payment_mode" class="form-control" onchange="paymentonchangeevent()">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $payment = payment_mode();
                                        @endphp
                                        @foreach($payment as $i =>$val)
                                        <option value="{{ $i }}">{{ $val }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('payment_mode'))
                                    <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                    @endif 
                               </div>
                               
                               <div class="col-md-12 mb-3" id="div_other_pay">
                                    <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                                    <input  type="text" name="other_payment_mode" id="other_payment_mode" class="form-control" placeholder="Description" >              
                              </div>
                          </div>                     
                         <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mt-5">Submit</button>
                            </div>
                         </div>
                      </form>
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
function valid(){
  if($("#client_id").val() == ""){
    toastr.error('Client name is a require field!');
    $("#client_id").focus();
    $("#client_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#project_id").val() == ""){
    toastr.error('Project name is a require field!');
    $("#project_id").focus();
    $("#project_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#upsale_type").val() == ""){
    toastr.error('Upsale type is a require field!');
    $("#upsale_type").focus();
    $("#upsale_type").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if(($("#upsale_type").val() == 1 || $("#upsale_type").val() == 2 || $("#upsale_type").val() == 3) && $("#start_date").val() == ""){
    toastr.error('Start date is a required field!');
    $("#start_date").focus();
    $("#start_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if(($("#upsale_type").val() == 1 || $("#upsale_type").val() == 2 || $("#upsale_type").val() == 3) && $("#end_date").val() == ""){
    toastr.error('Start date is a required field!');
    $("#end_date").focus();
    $("#end_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }  
}

$(document).ready(function () { 
  $("#div_other_pay").hide();
  $("#div_hosting").hide();  
  $("#div_other").hide();
});  


$(".pendingamount").keyup(function(){
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
})


function projectTypechangeEvent(){
  if($("#upsale_type").val() == 1){    
      $("#div_hosting").show();    
      $("#div_other").hide(); 
  }else if($("#upsale_type").val() == 2){      
      $("#div_hosting").show();
      $("#div_other").hide();
  }else if($("#upsale_type").val() == 3){   
      $("#div_hosting").show();
      $("#div_other").hide();
  }else if($("#upsale_type").val() == 4){     
      $("#div_hosting").hide();
      $("#div_other").show();
  }

}


function customerOnchangeEvent(){
  if($("#technology_type").val() == 5){
    $('#div_customer_requirment').show();
  }else{
    $('#div_customer_requirment').hide();
  }
}


function smonclickEvent(){
  if($("#smo").is(":checked")){
    $('.div_smo').show();
  }else if($("#seo_smo").is(":checked")){
    $('.div_smo').show();
  }else{
    $('.div_smo').hide();
  }
}


function paymentonchangeevent(){
  if($("#payment_mode").val() == 6){
      $("#div_other_pay").show();
  }else{
      $("#div_other_pay").hide();
  }
}

function getproject(){
    $.ajax({
      type: 'GET',
      url: "/upsales/get-project",
      data: { client_id: $("#client_id").val() },
      cache: false,
      success: function(response){
        $("#project_id").html(response);
      }
    });
}
</script>
@endsection