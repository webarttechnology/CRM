@section('title', 'Sales Add')
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
                        </span>Sales Add
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Add</li>
                    </ul>
                </div>
            </div>
              <!-- Content Starts -->
              <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                          <form method="post" action="{{ route('sales.new.insert.suceess') }}" class="form-save">
                            @csrf
                              @if($errors->has('email'))
                                        <small class="text-danger" >{{ $errors->first('email') }}</small>
                              @endif
                              </br>
                              @if($errors->has('current_website'))
                                  <small class="text-danger" id="current_websiteerrmsg">{{ $errors->first('current_website') }}</small>
                               @endif
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                        <label class="form-label" for="client_name">{{ __("Client name") }} <span class="text-danger">*</span></label>
                                        <select name="client_id" id="client_id" class="form-control">
                                            <option value="">--Select--</option>
                                            @foreach($data as $val)
                                            <option value="{{ $val['id'] }}">{{ $val['name'].' ('.$val['client_code'].')' }}</option>
                                            @endforeach    
                                        </select>
                                        @if($errors->has('client_id'))
                                        <small class="text-danger" id="client_iderrmsg">{{ $errors->first('client_id') }}</small>
                                        @endif 
                                </div> 
                                 <div class="col-md-2 mb-3">
                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-4">Add Client</a>
                                 </div>  
                                <div class="col-md-6 mb-3">
                                        <label class="form-label" for="project_name">{{ __("Project Name") }} <span class="text-danger">*</span></label>
                                        <input  type="text" name="project_name" id="project_name" class="form-control" placeholder="Project name" value="{{ old('project_name') }}"/>
                                        @if($errors->has('project_name'))
                                        <small class="text-danger" id="project_nameerrmsg">{{ $errors->first('project_name') }}</small>
                                        @endif    
                                </div> 
                                <div class="col-md-12 mb-3">
                                        <label class="form-label" for="project_type">{{ __('Project Type') }}<span class="text-danger">*</span></label>
                                        <select name="project_type" id="project_type" class="form-control" onchange="projectTypechangeEvent()">
                                            <option value="">--Select--</option>
                                            @foreach($project_type as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
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
                                            <option value="{{ $i  }}">{{ $val }}</option>
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
                                            <option value="{{ $i  }}">{{ $val }}</option>
                                            @endforeach    
                                        </select>
                                   </div>  
                                   <div class="col-md-12 mb-3" id="div_customer_requirment">
                                        <label class="form-label" for="customer_requerment">{{ __("Custom Requirements") }} <span class="text-danger">*</span></label>
                                        <input name="customer_requerment" id="customer_requerment" class="form-control" placeholder="Custom Requirements">        
                                   </div>   
                                   
                               </div> 
                               
                              <div class="rowd" id="div_digital_marketing">
                                    <div class="row">
                                        <div class="mt-3 col-md-1 mb-3">
                                          <div class="form-check">
                                                <input type="radio" name="digital_marketing" id="seo" value="SEO" class="form-check-input" onclick="smonclickEvent()" >
                                                <label class="form-label" for="seo">{{ __("SEO") }}</label>
                                          </div>
                                        </div>
                                        <div class="form-check mt-3 col-md-1 mb-3">
                                                <input type="radio" name="digital_marketing" id="smo" value="SMO" class="form-check-input" onclick="smonclickEvent()">
                                                <label class="form-label" for="smo">{{ __("SMO") }} </label>
                                        </div>
                                        <div class="form-check mt-3 col-md-2 mb-3">
                                                <input type="radio" name="digital_marketing" id="seo_smo" value="SEO_SMO" class="form-check-input" onclick="smonclickEvent()">
                                                <label class="form-label" for="seo_smo">{{ __(" SEO + SMO") }} </label>
                                        </div>
                                        <div class="form-check mt-3 col-md-2 mb-3">
                                                <input type="radio" name="digital_marketing" id="google_ads"  value="Google Ads" class="form-check-input" onclick="smonclickEvent()">
                                                <label class="form-label" for="google_ads">{{ __("Google Ads") }}</label>
                                        </div>  
                                    </div> 
                                  
                                    <div class="row mb-3">
                                        <div class="mt-3 col-md-2 div_smo mb-3">
                                          <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Facebook" id="facebook">
                                          <label class="form-check-label" for="facebook"> Facebook </label>
                                        </div>
    
                                        <div class="form-check mt-3 col-md-2 div_smo mb-3">
                                          <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Instagram" id="instagran" >
                                          <label class="form-check-label" for="instagran"> Instagram </label>
                                        </div>
    
                                        <div class="form-check mt-3 col-md-2 div_smo mb-3">
                                          <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Twitter" id="twitter">
                                          <label class="form-check-label" for="twitter"> Twitter </label>
                                        </div>
    
                                        <div class="form-check mt-3 col-md-2 div_smo mb-3">
                                          <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Youtube" id="youtube">
                                          <label class="form-check-label" for="youtube"> Youtube </label>
                                        </div>
    
                                        <div class="form-check mt-3 col-md-2 div_smo mb-3">
                                          <input class="form-check-input" type="checkbox" name="smo_platfrom[]" value="Linkedin" id="linkedin">
                                          <label class="form-check-label" for="linkedin"> Linkedin </label>
                                        </div>
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
                              
                              <div class="row" id="div_mobile_application">
                                    <div class="col-md-6 mb-3" >
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
                                      <div class="col-md-6 mb-3" >
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
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="cus_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                    <textarea  type="text" name="cus_project_description" id="cus_project_description" class="form-control" placeholder="Project description"></textarea>                                
                                </div>  
                              </div>
    
                              <div class="row" id="div_video_graphics">
                                  <div class="col-md-12 mb-3">
                                              <label class="form-label" for="gra_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                              <textarea  type="text" name="gra_project_description" id="gra_project_description" class="form-control" placeholder="Project Description"></textarea>
                                                  
                                  </div>
                              </div>
    
                              <div class="row" id="div_ui_ux">
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label" for="ui_project_description">{{ __("Project Description") }} <span class="text-danger">*</span></label>
                                      <textarea  type="text" name="ui_project_description" id="ui_project_description" class="form-control" placeholder="Project description"></textarea>               
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 mb-3">
                                        <label class="form-label" for="business_name">{{ __("Business Name") }} <span class="text-danger">*</span></label>
                                        <input  type="text" name="business_name" id="business_name" class="form-control" placeholder="Business name">          
                                        @if($errors->has('business_name'))
                                        <small class="text-danger" id="project_typeerrmsg">{{ $errors->first('business_name') }}</small>
                                        @endif
                                  </div>
                                  <div class="col-md-6 mb-3" >
                                        <label class="form-label" for="closer_name">{{ __('Closer') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="closer_name" id="closer_name" class="form-control" placeholder="Closer name" value="{{ old('closer_name') }}">     
                                        @if($errors->has('closer_name'))
                                        <small class="text-danger" id="client_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                                        @endif 
                                  </div>   
                                   <div class="col-md-6 mb-3" >
                                        <label class="form-label" for="agent_name">{{ __('Agent Name') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Agent name" value="{{ old('agent_name') }}">     
                                        @if($errors->has('agent_name'))
                                        <small class="text-danger" id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                                        @endif 
                                    </div>   
                                   <div class="col-md-6 mb-3" >
                                        <label class="form-label" for="reference_site">{{ __('Reference Sites') }}</label>
                                        <input type="text" name="reference_site" id="reference_site" class="form-control" placeholder="Reference Sites" value="{{ old('reference_site') }}"/>              
                                   </div>   
    
                                   <div class="col-md-12 mb-3">
                                        <label class="form-label" for="remark">{{ __("Remarks") }} <span class="text-danger">*</span></label>
                                        <textarea  type="text" name="remark" id="remark" class="form-control" placeholder="Remark"></textarea> 
                                        @if($errors->has('remark'))
                                        <small class="text-danger">{{ $errors->first('remark') }}</small>
                                        @endif        
                                  </div>
    
                                  <div class="col-md-12 mb-3">
                                              <label class="form-label" for="upsale">{{ __("Upsale Opportunities") }}</label>
                                              <input  type="text" name="upsale" id="upsale" class="form-control" placeholder="Upsale opportunities">       
                                  </div>
                                  <div class="col-md-6 mb-3">
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
                                  <div class="col-md-6 mb-3">
                                        <label class="form-label" for="gross_amt">{{ __("Gross Amount") }} <span class="text-danger">*</span></label>
                                        <input  type="number" name="gross_amt" id="gross_amt" class="form-control pendingamount" placeholder="$">  
                                        @if($errors->has('gross_amt'))
                                        <small class="text-danger">{{ $errors->first('gross_amt') }}</small>
                                        @endif               
                                  </div>
                                  <div class="col-md-6 mb-3">
                                        <label class="form-label" for="net_amt">{{ __("Net Amount") }} <span class="text-danger">*</span></label>
                                        <input  type="number" name="net_amt" id="net_amt" class="form-control pendingamount" placeholder="$">  
                                        @if($errors->has('net_amt'))
                                        <small class="text-danger">{{ $errors->first('net_amt') }}</small>
                                        @endif             
                                  </div>
                                  <div class="col-md-6 mb-3">
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
                                  <div class="col-md-6 mb-3" >
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
                                        <input  type="text" name="other_pay" id="other_pay" class="form-control" placeholder="Description" >              
                                  </div>
    
                              </div>                       
    
                            
    
                             <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-5 form-submit">Submit</button>
                                </div>
                             </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
  </div>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <form method="post" action="{{ route('sales.client.insert.suceess') }}" onsubmit="return valid1();">
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
                                        @foreach($countries as $val)
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
                         <!-- <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mt-5">Send</button>
                            </div>
                         </div> -->
                     
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
       </form>
    </div>
  </div>
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
  }  
}

function valid1(){
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
    }    
}

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

         let lineNo = 2;     
        $("#addrow").click(function () {         
            markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5 mb-3"><label class="form-label" for="email">{{ __("Email ID") }}</label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5 mb-3"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" /></div> <div class="col-md-2 mb-3"> <span class="btn btn-danger mt-4"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
            tableBody = $("#multipleimage");
            tableBody.append(markup);
            lineNo++;
        }); 

      
});  

  function deleteRow(lineno){
          // $("#deleterow"+lineno).click(function () {    
          // });

          $('#deleterow'+lineno).remove();
   }


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
@endsection