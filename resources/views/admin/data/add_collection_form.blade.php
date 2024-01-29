<div class="modal-header">
        <h4 class="modal-title text-center">{{ $collection_data  ? 'Update Collection' : 'Add Collection' }} </h4>
        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          @if ($collection_data)
          <form method="post" action="{{ route('collection.update.success') }}" class="form-save save">
          <input type="hidden" name="update_id" id="update_id" value="{{ $collection_data->id }}"> 
          @else
          <form method="post" action="{{ route('collection.add.success') }}" class="form-save save">
          @endif
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                        <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                        <select name="client_id" id="client_id" class="form-control" onchange="getproject();">
                            <option value="">--Select--</option>
                            @foreach($clients as $val)
                            <option value="{{ $val['id'] }}" {{ $val['id'] == $collection_data?->client_id ? 'Selected':'' }}>{{ $val['name'].' ('.$val['client_code'].')' }}</option>
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
                            @foreach($project as $val)
                            <option value="{{ $val->id }}" {{ $val['id'] == $collection_data?->sale_id ? 'Selected':'' }}>{{ $val->project_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('project_id'))
                        <small class="text-danger">{{ $errors->first('project_id') }}</small>
                        @endif    
                </div>  
                <div class="col-md-6 mb-3">
                        <label class="form-label" for="upsale_type">{{ __('Currency') }} <span class="text-danger">*</span></label>
                        <select name="currency" id="currency" class="form-control">
                            <option value="">--Select--</option>
                            @foreach(currency() as $key => $val)
                            <option value="{{ $key }}" {{ $key == $collection_data?->currency ? 'Selected':'' }}>{{ $val }}</option>
                            @endforeach                                   
                        </select>
                        @if($errors->has('currency'))
                        <small class="text-danger">{{ $errors->first('currency') }}</small>
                        @endif
                </div>

                <div class="col-md-6 mb-3">
                        <label class="form-label" for="upsale_type">{{ __('Instalment') }} <span class="text-danger">*</span></label>
                        <select name="instalment" id="instalment" class="form-control">
                            <option value="">--Select--</option>
                            @foreach(instalment() as $key => $val)
                            <option value="{{ $key }}" {{ $key == $collection_data?->instalment ? 'Selected':'' }}>{{ $val }}</option>
                            @endforeach                                   
                        </select>
                        @if($errors->has('instalment'))
                        <small class="text-danger">{{ $errors->first('instalment') }}</small>
                        @endif
                </div>
            </div> 
      
              <div class="row">                         
                
                  <div class="col-md-6 mb-3">
                        <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                        <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$" value="{{ $collection_data?->net_amount }}" min="1">  
                        @if($errors->has('net_amt'))
                        <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                        @endif             
                  </div>
                 
                  <div class="col-md-6 mb-3">
                        <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                        <input  type="date" name="sale_date" id="sale_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ $collection_data?->sale_date }}">  
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
                            <option value="{{ $i }}" {{ $i == $collection_data?->payment_mode ? 'Selected': '' }}>{{ $val }}</option>
                            @endforeach    
                        </select>
                        @if($errors->has('payment_mode'))
                        <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                        @endif 
                   </div>
                   
                   <div class="col-md-6 mb-3" id="div_other_pay">
                        <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                        <input  type="text" name="other_payment_mode" id="other_payment_mode" class="form-control" placeholder="Other payment mode" value="{{ $collection_data?->other_payment_mode }}">              
                  </div>
              </div>                     
             <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-5 form-submit">{{ $collection_data  ? 'Update' : 'Submit' }}</button>
                </div>
             </div>
          </form>
        </div>
        </div>
</div>

<script>

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