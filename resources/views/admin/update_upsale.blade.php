<x-header-component/> 
<x-nav-component/>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">{{ __('Add Upsales' )}}</h4>
        <div class="row">
          <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                      <form method="post" action="{{ route('upsale.update.success') }}" onsubmit="return valid();">
                      <input type="hidden" name="update_id" id="update_id" value="{{ $data -> id }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                    <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                                    <select name="client_id" id="client_id" class="form-control" onchange="getproject();">
                                        <option value="">--Select--</option>
                                        @foreach($clients as $val)
                                        <option value="{{ $val['id'] }}" {{ $val['id'] == $data -> client_id?'Selected':'' }}>{{ $val['name'].' ('.$val['client_code'].')' }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('client_id'))
                                    <small class="text-danger" id="client_iderrmsg">{{ $errors->first('client_id') }}</small>
                                    @endif 
                            </div>   
                            <div class="col-md-6">
                                    <label class="form-label" for="project_id">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($project as $val)
                                        <option value="{{ $val -> id }}" {{ $val -> id == $data -> sale_id?'Selected':'' }}>{{$val -> project_name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('project_id'))
                                    <small class="text-danger">{{ $errors->first('project_id') }}</small>
                                    @endif    
                            </div>  
                            <div class="col-md-12">
                                    <label class="form-label" for="upsale_type">{{ __('Upsale Product') }} <span class="text-danger">*</span></label>
                                    <select name="upsale_type" id="upsale_type" class="form-control" onchange="projectTypechangeEvent()">
                                        <option value="">--Select--</option>
                                        @foreach(upsale_type() as $key => $val)
                                        <option value="{{ $key }}" {{ $key == $data -> upsale_type?'Selected':'' }}>{{ $val }}</option>
                                        @endforeach                                   
                                    </select>
                                    @if($errors->has('upsale_type'))
                                    <small class="text-danger" id="upsale_typeerrmsg">{{ $errors->first('upsale_type') }}</small>
                                    @endif
                            </div>
                        </div> 
                        <div class="row" id="div_hosting">
                                  <div class="col-md-6">
                                    <label class="form-label" for="start_date">{{ __("Start Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="start_date" id="start_date" class="form-control" value="{{ date("Y-m-d", strtotime($data -> start_date)) }}">                                        
                                  </div>  
                                  <div class="col-md-6">
                                    <label class="form-label" for="end_date">{{ __("End Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d', strtotime($data -> end_date)) }}">                                            
                                  </div>
                        </div>

                        <div class="row" id="div_other">
                            <div class="col-md-12">
                              <label class="form-label" for="other">{{ __("Others Description") }} <span class="text-danger">*</span></label>
                              <textarea name="other" id="other" class="form-control" placeholder="Other Description">{{ $data -> others }}</textarea>
                            </div> 
                        </div>
                          <div class="row">                           
                              <div class="col-md-4">
                                    <label class="form-label" for="gross_amt">{{ __("Gross Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="gross_amt" id="gross_amt" class="form-control pendingamount" placeholder="$" value="{{ $data -> gross_amount }}">  
                                    @if($errors->has('gross_amt'))
                                    <small class="text-danger">{{ $errors->first('gross_amt') }}</small>
                                    @endif               
                              </div>
                              <div class="col-md-4">
                                    <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$" value="{{ $data -> net_amount }}">  
                                    @if($errors->has('net_amt'))
                                    <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                                    @endif             
                              </div>
                              <div class="col-md-4">
                                    <label class="form-label" for="due_amt">{{ __("Due Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="text" readonly name="due_amt" id="due_amt" class="form-control" placeholder="$" value="{{ $data -> gross_amount - $data -> net_amount }}">              
                              </div>
                              <div class="col-md-6">
                                    <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="sale_date" id="sale_date" class="form-control" value="{{ date("Y-m-d", strtotime($data -> sale_date)) }}">  
                                    @if($errors->has('sale_date'))
                                    <small class="text-danger">{{ $errors->first('sale_date') }}</small>
                                    @endif             
                              </div>
                              <div class="col-md-6" >
                                    <label class="form-label" for="payment_mode">{{ __('Payment Mode') }}<span class="text-danger">*</span></label>
                                    <select name="payment_mode" id="payment_mode" class="form-control" onchange="paymentonchangeevent()">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $payment = payment_mode();
                                        @endphp
                                        @foreach($payment as $i =>$val)
                                        <option value="{{ $i }}" {{ $i == $data -> payment_mode?'Selected':'' }}>{{ $val }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('payment_mode'))
                                    <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                    @endif 
                               </div>
                               
                               <div class="col-md-12" id="div_other_pay">
                                    <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                                    <input  type="text" name="other_payment_mode" id="other_payment_mode" class="form-control" placeholder="Description" vlaue="{{ $data -> other_payment_mode}}">              
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
                
              </div>
            </div>
<x-footer-component/>

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
      data: {client_id: $("#client_id").val()},
      cache: false,
      success: function(response){
        $("#project_id").html(response);
      }
    })
}
</script>