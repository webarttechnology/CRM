<x-header-component/> 
<x-nav-component/>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">{{ __('Add Collection' )}}</h4>
        <div class="row">
          <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                      <form method="post" action="{{ route('collection.add.success') }}" onsubmit="return valid();">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                    <label class="form-label" for="project_id">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                    @if($errors->has('project_id'))
                                    <small class="text-danger">{{ $errors->first('project_id') }}</small>
                                    @endif    
                            </div>  
                            <div class="col-md-6">
                                    <label class="form-label" for="upsale_type">{{ __('Currency') }} <span class="text-danger">*</span></label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach(currency() as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach                                   
                                    </select>
                                    @if($errors->has('currency'))
                                    <small class="text-danger">{{ $errors->first('currency') }}</small>
                                    @endif
                            </div>

                            <div class="col-md-6">
                                    <label class="form-label" for="upsale_type">{{ __('Instalment') }} <span class="text-danger">*</span></label>
                                    <select name="instalment" id="instalment" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach(instalment() as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach                                   
                                    </select>
                                    @if($errors->has('instalment'))
                                    <small class="text-danger">{{ $errors->first('instalment') }}</small>
                                    @endif
                            </div>
                        </div> 
                  
                          <div class="row">                         
                            
                              <div class="col-md-6">
                                    <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$">  
                                    @if($errors->has('net_amt'))
                                    <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                                    @endif             
                              </div>
                             
                              <div class="col-md-6">
                                    <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="sale_date" id="sale_date" class="form-control" >  
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
                                        <option value="{{ $i }}">{{ $val }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('payment_mode'))
                                    <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                    @endif 
                               </div>
                               
                               <div class="col-md-6" id="div_other_pay">
                                    <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                                    <input  type="text" name="other_payment_mode" id="other_payment_mode" class="form-control" placeholder="Other payment mode" >              
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
  }else  if($("#currency").val() == ""){
    toastr.error('Currency is a require field!');
    $("#currency").focus();
    $("#currency").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#instalment").val() == ""){
    toastr.error('Instalment is a require field!');
    $("#instalment").focus();
    $("#instalment").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#net_amt").val() == ""){
    toastr.error('Net amount is a require field!');
    $("#net_amt").focus();
    $("#net_amt").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#sale_date").val() == ""){
    toastr.error('Sale date is a require field!');
    $("#sale_date").focus();
    $("#sale_date").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#payment_mode").val() == ""){
    toastr.error('Payment mode is a require field!');
    $("#payment_mode").focus();
    $("#payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  }else  if($("#payment_mode").val() == 6 && $("#other_payment_mode").val() == ''){
    toastr.error('Other payment mode is a require field!');
    $("#other_payment_mode").focus();
    $("#other_payment_mode").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
    return false;
  } 
}

$(document).ready(function () { 
  $("#div_other_pay").hide();
  $("#div_hosting").hide();  
  $("#div_other").hide();
}); 










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