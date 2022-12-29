<x-header-component/> 
<x-nav-component/>

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{{ __('Add Client' )}}</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                      <form method="post" action="{{ route('sales.client.insert.suceess') }}" onsubmit="return valid();">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                    <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                                    <select name="country_name" id="client_name" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach($data as $val)
                                        <option value="{{ $val['name'] }}">{{ $val['name'].' ('.$val['code'].')' }}</option>
                                        @endforeach    
                                    </select>
                            </div>   
                            <div class="col-md-6">
                                    <label class="form-label" for="project_name">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                                    <input  type="text" name="country_name" id="project_name" class="form-control">
                                       
                            </div>  
                            <div class="col-md-12">
                                    <label class="form-label" for="project_type">{{ __('Project Type') }}<span class="text-danger">*</span></label>
                                    <select name="project_type" id="project_type" class="form-control" onchange="projectTypechangeEvent()">
                                        <option value="">--Select--</option>
                                        @foreach($project_type as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'].' ('.$val['name'].')' }}</option>
                                        @endforeach    
                                    </select>
                            </div>
                        </div>  
                        <div class="row" id="div_website">
                               <div class="col-md-6" >
                                    <label class="form-label" for="technology">{{ __('Technology/platform') }}<span class="text-danger">*</span></label>
                                    <select name="technology" id="technology" class="form-control">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $technology = website_technology();
                                        @endphp
                                        @foreach($technology as $i =>$val)
                                        <option value="{{ $i  }}">{{ $val }}</option>
                                        @endforeach       
                                    </select>
                               </div>  
                               <div class="col-md-6" >
                                    <label class="form-label" for="technology_type">{{ __('Type') }}<span class="text-danger">*</span></label>
                                    <select name="technology_type" id="technology_type" class="form-control" onchange="customerOnchangeEvent()">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $technology_type = website_technology_type();
                                        @endphp
                                        @foreach($technology_type as $i =>$val)
                                        <option value="{{ $i  }}">{{ $val }}</option>
                                        @endforeach    
                                    </select>
                               </div>  
                               <div class="col-md-12" id="div_customer_requirment">
                                    <label class="form-label" for="customer_requerment">{{ __("Customer Requirements") }} <span class="text-danger">*</span></label>
                                    <input name="customer_requerment" id="customer_requerment" class="form-control" placeholder="">        
                               </div>   
                               
                           </div> 
                           
                          <div class="rowd" id="div_digital_marketing">
                                <div class="row">
                                    <div class="mt-3 col-md-1">
                                      <div class="form-check">
                                            <input type="radio" name="digital_marketing" id="seo" value="SEO" class="form-check-input" onclick="smonclickEvent()" >
                                            <label class="form-label" for="seo">{{ __("SEO") }}</label>
                                      </div>
                                    </div>
                                    <div class="form-check mt-3 col-md-1">
                                            <input type="radio" name="digital_marketing" id="smo" value="SMO" class="form-check-input" onclick="smonclickEvent()">
                                            <label class="form-label" for="smo">{{ __("SMO") }} </label>
                                    </div>
                                    <div class="form-check mt-3 col-md-2">
                                            <input type="radio" name="digital_marketing" id="seo_smo" value="SEO_SMO" class="form-check-input" onclick="smonclickEvent()">
                                            <label class="form-label" for="seo">{{ __(" SEO + SMO") }} </label>
                                    </div>
                                    <div class="form-check mt-3 col-md-2">
                                            <input type="radio" name="digital_marketing" id="google_ads"  value="Google Ads" class="form-check-input" onclick="smonclickEvent()">
                                            <label class="form-label" for="google_ads">{{ __("Google Ads") }}</label>
                                    </div>  
                                </div> 
                              
                                <div class="row mb-3">
                                    <div class="mt-3 col-md-2 div_smo">
                                      <input class="form-check-input" type="checkbox" name="smo_platfrom" value="Facebook" id="facebook">
                                      <label class="form-check-label" for="facebook"> Facebook </label>
                                    </div>

                                    <div class="form-check mt-3 col-md-2 div_smo">
                                      <input class="form-check-input" type="checkbox" name="smo_platfrom" value="Instagram" id="instagran" >
                                      <label class="form-check-label" for="instagran"> Instagram </label>
                                    </div>

                                    <div class="form-check mt-3 col-md-2 div_smo">
                                      <input class="form-check-input" type="checkbox" name="smo_platfrom" value="Twitter" id="twitter">
                                      <label class="form-check-label" for="twitter"> Twitter </label>
                                    </div>

                                    <div class="form-check mt-3 col-md-2 div_smo">
                                      <input class="form-check-input" type="checkbox" name="smo_platfrom" value="Youtube" id="youtube">
                                      <label class="form-check-label" for="youtube"> Youtube </label>
                                    </div>

                                    <div class="form-check mt-3 col-md-2 div_smo">
                                      <input class="form-check-input" type="checkbox" name="smo_platfrom" value="Linkedin" id="linkedin">
                                      <label class="form-check-label" for="linkedin"> Linkedin </label>
                                    </div>
                              </div>
                                
                              
                                <div class="row">
                                  <div class="col-md-6">
                                        <label class="form-label" for="start_date">{{ __("Start Date") }} <span class="text-danger">*</span></label>
                                        <input  type="date" name="start_date" id="start_date" class="form-control">
                                            
                                  </div>  
                                  <div class="col-md-6">
                                        <label class="form-label" for="end_date">{{ __("End Date") }} <span class="text-danger">*</span></label>
                                        <input  type="date" name="end_date" id="end_date" class="form-control">
                                            
                                  </div>
                                </div>  
                          </div>
                          
                          <div class="row" id="div_mobile_application">
                                <div class="col-md-6" >
                                          <label class="form-label" for="mobile_app_platform">{{ __('Platform ') }}<span class="text-danger">*</span></label>
                                          <select text="text" name="mobile_app_platform" id="mobile_app_platform" class="form-control" >
                                            
                                              <option value="">--Select--</option>
                                              @php 
                                                  $mobile = mobile_application();
                                              @endphp
                                              @foreach($mobile as $i =>$val)
                                              <option value="{{ $i  }}">{{ $val }}</option>
                                              @endforeach    
                                          </select>
                                  </div> 
                                  <div class="col-md-6" >
                                    <label class="form-label" for="preferred_technology">{{ __('Preferred technology') }}<span class="text-danger">*</span></label>
                                    <select name="preferred_technology" id="preferred_technology" class="form-control">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $t_preferred = mobile_application_preferred();
                                        @endphp
                                        @foreach($t_preferred as $i =>$val)
                                        <option value="{{ $i  }}">{{ $val }}</option>
                                        @endforeach    
                                    </select>
                               </div>   

                          </div>

                          <div class="row" id="div_customised_platforms">
                            <div class="col-md-12">
                                        <label class="form-label" for="cus_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                        <textarea  type="text" name="project_description" id="project_description" class="form-control"></textarea>
                                            
                            </div>  
                          </div>

                          <div class="row" id="div_video_graphics">
                              <div class="col-md-12">
                                          <label class="form-label" for="gra_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                          <textarea  type="text" name="project_description" id="project_description" class="form-control"></textarea>
                                              
                              </div>
                          </div>

                          <div class="row" id="div_ui_ux">
                              <div class="col-md-12">
                                              <label class="form-label" for="ui_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                              <textarea  type="text" name="ui_project_description" id="ui_project_description" class="form-control"></textarea>               
                              </div>
                              <div class="col-md-6">
                                          <label class="form-label" for="business_name">{{ __("Business Name") }} <span class="text-danger">*</span></label>
                                          <input  type="text" name="business_name" id="business_name" class="form-control" placeholder="Business name">          
                              </div>
                              <div class="col-md-6" >
                                    <label class="form-label" for="closer">{{ __('Closer') }}<span class="text-danger">*</span></label>
                                    <select name="closer" id="closer" class="form-control">
                                      
                                        <option value="">--Select--</option>
                                       
                                        @foreach($closer as $item)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach    
                                    </select>
                               </div>   
                               <div class="col-md-6" >
                                    <label class="form-label" for="agent_name">{{ __('Agent Name') }}<span class="text-danger">*</span></label>
                                    <select name="agent_name" id="agent_name" class="form-control">
                                      
                                        <option value="">--Select--</option>
                                       
                                        @foreach($agent as $item)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach    
                                    </select>
                               </div>   
                               <div class="col-md-6" >
                                    <label class="form-label" for="reference_site">{{ __('Reference Sites') }}<span class="text-danger">*</span></label>
                                    <select name="reference_site" id="reference_site" class="form-control">
                                      
                                        <option value="">--Select--</option>
                                        @php 
                                            $ui_reference = ui_reference_site();
                                        @endphp
                                        @foreach($ui_reference as $i =>$val)
                                        <option value="{{ $i }}">{{ $val }}</option>
                                        @endforeach    
                                    </select>
                               </div>   

                               <div class="col-md-12">
                                          <label class="form-label" for="remark">{{ __("Remarks") }} <span class="text-danger">*</span></label>
                                          <textarea  type="text" name="remark" id="remark" class="form-control" placeholder="Remark"></textarea>         
                              </div>

                              <div class="col-md-12">
                                          <label class="form-label" for="upsale">{{ __("Upsale Opportunities") }} <span class="text-danger">*</span></label>
                                          <input  type="text" name="upsale" id="upsale" class="form-control" placeholder="Upsale opportunities">       
                              </div>
                              <div class="col-md-4">
                                    <label class="form-label" for="gross_amt">{{ __("Gross Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="gross_amt" id="gross_amt" class="form-control" placeholder="$">              
                              </div>
                              <div class="col-md-4">
                                    <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="net_amt" id="net_amt" class="form-control" placeholder="$">              
                              </div>
                              <div class="col-md-4">
                                    <label class="form-label" for="due_amt">{{ __("Due Amount") }} <span class="text-danger">*</span></label>
                                    <input  type="number" name="due_amt" id="due_amt" class="form-control" placeholder="$">              
                              </div>
                              <div class="col-md-6">
                                    <label class="form-label" for="sale_date">{{ __("Sale Date") }} <span class="text-danger">*</span></label>
                                    <input  type="date" name="sale_date" id="sale_date" class="form-control" >              
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
                               </div>  
                               
                               <div class="col-md-12" id="div_other_pay">
                                    <label class="form-label" for="other_pay">{{ __("Payment Description") }} <span class="text-danger">*</span></label>
                                    <input  type="text" name="other_pay" id="other_pay" class="form-control" placeholder="Description" >              
                              </div>

                          </div> 

                          <div class="row" id="div_hosting">
                              <div class="col-md-12">
                                          <label class="form-label" for="hosting_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                          <textarea  type="text" name="hosting_description" id="hosting_description" class="form-control" placeholder="Description"></textarea>           
                              </div>
                          </div>

                          
                          <div class="row" id="div_ssl">
                              <div class="col-md-12">
                                          <label class="form-label" for="ssl_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                          <textarea  type="text" name="ssl_description" id="ssl_description" class="form-control" placeholder="Description"></textarea>           
                              </div>
                          </div>

                          <div class="row" id="div_website_maintance">
                              <div class="col-md-12">
                                          <label class="form-label" for="website_maintance_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                          <textarea  type="text" name="website_maintance_description" id="website_maintance_description" class="form-control" placeholder="Description"></textarea>           
                              </div>
                          </div>

                         <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mt-5">Send</button>
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

$(document).ready(function () {
  $("#div_website").hide();
  $('#div_customer_requirment').hide();
  $('#div_digital_marketing').hide();
  $('.div_smo').hide();
  $("#div_mobile_application").hide();
  $("#div_customised_platforms").hide();
  $("#div_video_graphics").hide();
  $("#div_ui_ux").hide();
  $("#div_other_pay").hide();
  $("#div_hosting").hide();
  $("#div_ssl").hide();
  $("#div_website_maintance").hide();
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
      $("#div_hosting").hide();
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
      $("#div_hosting").hide();
      $("#div_website_maintance").hide();
  }else if($("#project_type").val() == 9){
    $("#div_website_maintance").show();
      $("#div_website").hide();
      $('#div_digital_marketing').hide();
      $("#div_mobile_application").hide();
      $("#div_customised_platforms").hide();
      $("#div_video_graphics").hide();
      $("#div_ui_ux").hide();
      $("#div_hosting").hide();
      $("#div_ssl").hide();
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
               
              
            
     



</script>