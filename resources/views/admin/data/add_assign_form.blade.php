<div class="modal-header">
        <h4 class="modal-title text-center">Assign Task</h4>
        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('sales.assign.success') }}" class="assign-form-save save">
              <input type="hidden" name="update_id" value="{{ $data->id }}"/>
              @csrf
              <div class="row">
                  <div class="col-md-6 mb-3">
                          <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                          <select name="client_id" id="client_id" class="form-control">
                              <option value="">--Select--</option>
                              @foreach($client as $val)
                              <option value="{{ $val['id'] }}" {{ $data->client_id == $val['id']?'Selected':'' }}>{{ $val['name'].' ('.$val['client_code'].')' }}</option>
                              @endforeach    
                          </select>
                          @if($errors->has('client_id'))
                          <small class="text-danger" id="client_iderrmsg">{{ $errors->first('client_id') }}</small>
                          @endif 
                  </div>   
                  <div class="col-md-6 mb-3">
                          <label class="form-label" for="project_name">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                          <input  type="text" name="project_name" id="project_name" class="form-control" placeholder="Project name" value="{{ $data->project_name }}"/>
                          @if($errors->has('project_name'))
                          <small class="text-danger" id="project_nameerrmsg">{{ $errors->first('project_name') }}</small>
                          @endif    
                  </div>  
                  <div class="col-md-12 mb-3">
                          <label class="form-label" for="project_type">{{ __('Project Type') }}<span class="text-danger">*</span></label>
                          <select name="project_type" id="project_type" class="form-control" onchange="projectTypechangeEvent()">
                              <option value="">--Select--</option>
                              @foreach($project_type as $key => $val)
                              <option value="{{ $key }}" {{ $data->project_type == $key?'Selected':'' }}>{{ $val }}</option>
                              @endforeach    
                          </select>
                          @if($errors->has('project_type'))
                          <small class="text-danger" id="project_typeerrmsg">{{ $errors->first('project_type') }}</small>
                          @endif
                  </div>
              </div>  
              <div class="row" id="div_website">
                     <div class="col-md-6 mb-3" >
                          <label class="form-label" for="technology">{{ __('Technology/platform') }}<span class="text-danger">*</span></label>
                          <select name="technology" id="technology" class="form-control">                                      
                              <option value="">--Select--</option>
                              @php 
                                  $technology = website_technology();
                              @endphp
                              @foreach($technology as $i =>$val)
                              <option value="{{ $i }}" {{ $i == $data->technology ?'Selected':"" }}>{{ $val }}</option>
                              @endforeach       
                          </select>
                     </div>  
                     <div class="col-md-6 mb-3" >
                          <label class="form-label" for="type">{{ __('Type') }}<span class="text-danger">*</span></label>
                          <select name="type" id="type" class="form-control" onchange="customerOnchangeEvent()">                                      
                              <option value="">--Select--</option>
                              @php 
                                  $technology_type = website_technology_type();
                              @endphp
                              @foreach($technology_type as $i =>$val)
                              <option value="{{ $i  }}" {{ $i == $data->type ?'Selected':"" }}>{{ $val }}</option>
                              @endforeach    
                          </select>
                     </div>  
                     <div class="col-md-12 mb-3" id="div_customer_requirment">
                          <label class="form-label" for="customer_requerment">{{ __("Custom Requirements") }} <span class="text-danger">*</span></label>
                          <input name="customer_requerment" id="customer_requerment" class="form-control" placeholder="Custom Requirements" value="{{ $data -> customer_requerment }}">        
                     </div>   
                     
                 </div> 
                 
                <div class="rowd mb-3" id="div_digital_marketing">
                      <div class="row">
                          <div class="mt-3 col-md-1 mb-3">
                            <div class="form-check">
                                  <input type="radio" name="digital_marketing" id="seo" value="SEO" {{ $data->marketing_plan == "SEO"?'Checked':'' }} class="form-check-input" onclick="smonclickEvent()" >
                                  <label class="form-label" for="seo">{{ __("SEO") }}</label>
                            </div>
                          </div>
                          <div class="form-check mt-3 col-md-1 mb-3">
                                  <input type="radio" name="digital_marketing" id="smo" value="SMO" {{ $data->marketing_plan == "SMO"?'Checked':'' }} class="form-check-input" onclick="smonclickEvent()">
                                  <label class="form-label" for="smo">{{ __("SMO") }} </label>
                          </div>
                          <div class="form-check mt-3 col-md-2 mb-3">
                                  <input type="radio" name="digital_marketing" id="seo_smo" value="SEO_SMO" {{ $data->marketing_plan == "SEO_SMO"?'Checked':'' }} class="form-check-input" onclick="smonclickEvent()">
                                  <label class="form-label" for="seo">{{ __(" SEO + SMO") }} </label>
                          </div>
                          <div class="form-check mt-3 col-md-2 mb-3">
                                  <input type="radio" name="digital_marketing" id="google_ads" {{ $data->marketing_plan == "Google Ads"?'Checked':'' }}  value="Google Ads" class="form-check-input" onclick="smonclickEvent()">
                                  <label class="form-label" for="google_ads">{{ __("Google Ads") }}</label>
                          </div>  
                      </div> 
                    
                      <div class="row mb-3">
                          <div class="mt-3 col-md-2 div_smo mb-3">
                            <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Facebook" id="facebook" {{ $data->smo_on && in_array('Facebook', json_decode($data -> smo_on))?'Checked':'' }}>
                            <label class="form-check-label" for="facebook"> Facebook </label>
                          </div>

                          <div class="form-check mt-3 col-md-2 div_smo mb-3">
                            <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Instagram" id="instagran" {{ $data->smo_on && in_array('Instagram', json_decode($data -> smo_on))?'Checked':'' }}>
                            <label class="form-check-label" for="instagran"> Instagram </label>
                          </div>

                          <div class="form-check mt-3 col-md-2 div_smo mb-3">
                            <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Twitter" id="twitter" {{ $data->smo_on && in_array('Twitter', json_decode($data -> smo_on))?'Checked':'' }}>
                            <label class="form-check-label" for="twitter"> Twitter </label>
                          </div>

                          <div class="form-check mt-3 col-md-2 div_smo mb-3">
                            <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Youtube" id="youtube" {{ $data->smo_on && in_array('Youtube', json_decode($data -> smo_on))?'Checked':'' }}>
                            <label class="form-check-label" for="youtube"> Youtube </label>
                          </div>

                          <div class="form-check mt-3 col-md-2 div_smo mb-3">
                            <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Linkedin" id="linkedin" {{ $data->smo_on && in_array('Linkedin', json_decode($data -> smo_on))?'Checked':'' }}>
                            <label class="form-check-label" for="linkedin"> Linkedin </label>
                          </div>
                    </div>                                  
                </div>

                <div class="row" id="div_hosting">
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="start_date">{{ __("Start Date") }} <span class="text-danger">*</span></label>
                          <input  type="date" name="start_date" id="start_date" class="form-control" value="{{ date("Y-m-d", strtotime($data->start_date))  }}">                                        
                        </div>  
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="end_date">{{ __("End Date") }} <span class="text-danger">*</span></label>
                          <input  type="date" name="end_date" id="end_date" class="form-control" value="{{ date("Y-m-d", strtotime($data->end_date))  }}">                                            
                        </div>
                </div>
                
                <div class="row" id="div_mobile_application">
                      <div class="col-md-6 mb-3">
                                <label class="form-label" for="mobile_app_platform">{{ __('Platform ') }}<span class="text-danger">*</span></label>
                                <select text="text" name="mobile_app_platform" id="mobile_app_platform" class="form-control" >
                                  
                                    <option value="">--Select--</option>
                                    @php 
                                        $mobile = mobile_application();
                                    @endphp
                                    @foreach($mobile as $i =>$val)
                                    <option value="{{ $i  }}" {{ $i == $data->platform_name?'Selected':''}}>{{ $val }}</option>
                                    @endforeach    
                                </select>
                        </div> 
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="preferred_technology">{{ __('Preferred technology') }}<span class="text-danger">*</span></label>
                          <select name="preferred_technology" id="preferred_technology" class="form-control">
                            
                              <option value="">--Select--</option>
                              @php 
                                  $t_preferred = mobile_application_preferred();
                              @endphp
                              @foreach($t_preferred as $i =>$val)
                              <option value="{{ $i  }}" {{ $i == $data->prefer_technology?'Selected':''}}>{{ $val }}</option>
                              @endforeach    
                          </select>
                     </div>   

                </div>

                <div class="row" id="div_customised_platforms">
                  <div class="col-md-12 mb-3">
                      <label class="form-label" for="cus_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                      <textarea  type="text" name="cus_project_description" id="cus_project_description" class="form-control" placeholder="Project details">{{ $data->others }}</textarea>                                
                  </div>  
                </div>

                <div class="row" id="div_video_graphics">
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="gra_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                        <textarea  type="text" name="gra_project_description" id="gra_project_description" class="form-control" placeholder="Project details">{{ $data->others }}</textarea>
                                    
                    </div>
                </div>

                <div class="row" id="div_ui_ux">
                    <div class="col-md-12 mb-3">
                          <label class="form-label" for="ui_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                         <textarea  type="text" name="ui_project_description" id="ui_project_description" class="form-control" placeholder="Project details">{{ $data->others }}</textarea>               
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                                <label class="form-label" for="business_name">{{ __("Business Name") }} <span class="text-danger">*</span></label>
                                <input  type="text" name="business_name" id="business_name" class="form-control" placeholder="Business name" value="{{ $data->business_name }}">          
                    </div>
                    <div class="col-md-6 mb-3">
                          <label class="form-label" for="closer_name">{{ __('Closer name') }}<span class="text-danger">*</span></label>
                          <input type="text" name="closer_name" id="closer_name" class="form-control" placeholder="Closer name" value="{{ $data->closer_name }}">     
                          @if($errors->has('closer_name'))
                          <small class="text-danger" id="client_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                          @endif 
                     </div>   
                     <div class="col-md-6 mb-3">
                          <label class="form-label" for="agent_name">{{ __('Agent Name') }}<span class="text-danger">*</span></label>
                          <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Agent name" value="{{ $data->agent_name }}">     
                          @if($errors->has('agent_name'))
                          <small class="text-danger" id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                          @endif 
                     </div>   
                     <div class="col-md-6 mb-3">
                          <label class="form-label" for="reference_site">{{ __('Reference Sites') }}</label>
                          <input type="text" name="reference_site" id="reference_site" class="form-control" placeholder="Reference Sites" value="{{ $data->reference_sites }}"/>              
                     </div>   

                     <div class="col-md-12 mb-3">
                                <label class="form-label" for="remark">{{ __("Remarks") }} <span class="text-danger">*</span></label>
                                <textarea  type="text" name="remark" id="remark" class="form-control" placeholder="Remark">{{ $data->remarks }}</textarea>  
                                @if($errors->has('remark'))
                          <small class="text-danger">{{ $errors->first('remark') }}</small>
                          @endif       
                    </div>

                    <div class="col-md-12 mb-3">
                                <label class="form-label" for="upsale">{{ __("Upsale Opportunities") }}</label>
                                <input  type="text" name="upsale" id="upsale" class="form-control" placeholder="Upsale opportunities" value="{{ $data->upsale_opportunities }}">       
                    </div>
                    <div class="col-md-4 mb-3">
                          <label class="form-label" for="gross_amt">{{ __("Gross Amount") }} <span class="text-danger">*</span></label>
                          <input  type="number" name="gross_amt" id="gross_amt" class="form-control pendingamount" placeholder="$" value="{{ $data->gross_amount }}">
                          @if($errors->has('gross_amt'))
                          <small class="text-danger">{{ $errors->first('gross_amt') }}</small>
                          @endif               
                    </div>
                    <div class="col-md-4 mb-3">
                          <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                          <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$" value="{{ $data->net_amount }}">   
                          @if($errors->has('net_amt'))
                          <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                          @endif             
                    </div>
                    <div class="col-md-4 mb-3">
                          <label class="form-label" for="due_amt">{{ __("Due Amount") }} <span class="text-danger">*</span></label>
                          <input  type="text" readonly name="due_amt" id="due_amt" class="form-control" placeholder="$" value="{{ $data->gross_amount - $data->net_amount }}">              
                    </div>
                    <div class="col-md-6 mb-3">
                          <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                          <input  type="date" name="sale_date" id="sale_date" class="form-control" value="{{ date('Y-m-d', strtotime($data->sale_date) )}}">  
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
                              <option value="{{ $i }}" {{ $data->payment_mode == $i?'Selected':'' }}>{{ $val }}</option>
                              @endforeach    
                          </select>
                          @if($errors->has('payment_mode'))
                          <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                          @endif 
                     </div>
                     
                     <div class="col-md-12 mb-3" id="div_other_pay">
                          <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                          <input  type="text" name="other_pay" id="other_pay" class="form-control" placeholder="Description" value="{{ $data->other_pay }}" >              
                    </div>
                </div>  

              <div class="col-md-12 mb-3">
                  <label class="form-label" for="assign_to">{{ __('Assign to') }}<span class="text-danger">*</span></label>
                  <select name="assign_to" id="assign_to" class="form-control">
                      <option value="">--Select--</option>                               
                      @foreach($projectmanager as $key =>$val)
                      <option value="{{ $key }}">{{ $val }}</option>
                      @endforeach    
                  </select>
                  @if($errors->has('assign_to'))
                  <small class="text-danger">{{ $errors->first('assign_to') }}</small>
                  @endif 
              </div>
               <div class="row">
                  <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary mt-5 assign-submit">Submit</button>
                  </div>
               </div>
            </form>
        </div>
        </div>
</div>

<script>


$(document).ready(function () {
  // $("#div_website").hide();
   $('#div_customer_requirment').hide();
  // $('#div_digital_marketing').hide();
  // $('.div_smo').hide();
  // $("#div_mobile_application").hide();
  // $("#div_customised_platforms").hide();
  // $("#div_video_graphics").hide();
  // $("#div_ui_ux").hide();
   $("#div_other_pay").hide();
  // $("#div_hosting").hide();
  // $("#div_ssl").hide();
  // $("#div_website_maintance").hide();

  if($("#type").val() == 5){
    $('#div_customer_requirment').show();
  }else{
    $('#div_customer_requirment').hide();
  }

  if($("#payment_mode").val() == 6){
      $("#div_other_pay").show();
  }else{
      $("#div_other_pay").hide();
  }

  if($("#project_type").val() == 1){
      $("#div_website").show();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 2){
      $('#div_digital_marketing').show();
      $("#div_website").hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 3){
    $("#div_mobile_application").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 4){
      $("#div_customised_platforms").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 5){
      $("#div_video_graphics").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 6){
      $("#div_ui_ux").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 7){
      $("#div_hosting").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 8){
      $("#div_ssl").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 9){
    $("#div_website_maintance").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_ssl").hide();
  }
});  




$(document).on("keyup", '.pendingamount', function(e) {

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
    
function projectTypechangeEvent(){
  if($("#project_type").val() == 1){
      $("#div_website").show();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 2){
      $('#div_digital_marketing').show();
      $("#div_website").hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 3){
    $("#div_mobile_application").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 4){
      $("#div_customised_platforms").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 5){
      $("#div_video_graphics").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 6){
      $("#div_ui_ux").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 7){
      $("#div_hosting").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_ssl").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 8){
      $("#div_ssl").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 9){
    $("#div_website_maintance").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").show();
      $("#div_ssl").hide();
  }

}


function customerOnchangeEvent(){
  if($("#type").val() == 5){
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
</script>
