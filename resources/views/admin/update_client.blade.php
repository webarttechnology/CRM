<x-header-component/> 
<x-nav-component/>

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{{ __('Update Client' )}}</h4>
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                        <span class="text-success">{{ Session::get('successmsg') }}</span>
                      <form method="post" action="{{ route('sales.client.update.suceess') }}" onsubmit="return valid();">
                      <input type="hidden" name="update_id" id="update_id" value="{{ $data -> id }}"/>
                        @csrf
                        <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">Client Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ $data -> name }}" />
                                    @if($errors->has('name'))
                                    <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="country_name">{{ __("Country name") }} <span class="text-danger">*</span></label>
                                    <select name="country_name" id="country_name" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($countries as $val)
                                        <option value="{{ $val['name'] }}" {{ ($data -> country_name == $val['name'])?'Selected':'' }}>{{ $val['name'].' ('.$val['code'].')' }}</option>
                                        @endforeach    
                                    </select>
                                    @if($errors->has('country_name'))
                                    <small class="text-danger" id="country_nameerrmsg">{{ $errors->first('country_name') }}</small>
                                    @endif
                                </div>   
                                <div class="col-md-6">
                                    <label class="form-label" for="email">{{ __("Email ID(Primary)") }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ $data -> email }}"/>
                                    @if($errors->has('email'))
                                    <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>  
                                <div class="col-md-6">
                                    <label class="form-label" for="address">{{ __('Address') }}</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="1A, Ho Chi Minh Sarani Rd" value="{{ $data -> address }}"/>
                                    @if($errors->has('email'))
                                    <small class="text-danger" id="addresserrmsg">{{ $errors->first('address') }}</small>
                                    @endif
                                </div>   
                                <div class="col-md-5">
                                    <label class="form-label" for="email">{{ __("Email ID") }}</label>
                                    <input type="email" class="form-control" id="alteremail" name="alteremail[]" placeholder="xyz@gmail.com" value="{{ count($data -> contact_details)?$data -> contact_details[0] -> email_id:''}}"/>
                                </div>  
                                <div class="col-md-5">
                                    <label class="form-label" for="address">{{ __('Mobile No') }}</label>
                                    <input type="text" class="form-control" id="mobile_no1" name="mobile_no[]" placeholder="+998889823" value="{{ count($data -> contact_details)?$data -> contact_details[0] -> mobile_no:'' }}"/>
                                </div> 
                                <div class="col-md-2">                               
                                    <span id="addrow" class="btn btn-primary mt-4" ><i class="fa fa-plus" ></i></span>
                                </div>   
                                <span id="multipleimage">
                                    @for($i = 1; $i <count($data -> contact_details); $i++)
                                        <div class="row" id="{{ 'deleterow'.$i }}"> 
                                            <div  class="col-md-5">
                                                <label class="form-label" for="email">{{ __("Email ID") }}</label>
                                                <input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" value="{{ $data -> contact_details[$i] -> email_id }}"/>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label" for="address">{{ __("Mobile No") }}</label>
                                                <input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="9000090909" value="{{ $data -> contact_details[$i] -> mobile_no }}"/>
                                            </div> 
                                            <div class="col-md-2"> 
                                                <span class="btn btn-danger mt-4"  onclick="deleteRow({{ $i }})"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                            </div> 
                                        </div>
                                    @endfor
                                </span>  
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="current_website">{{ __('Current Website') }}</label>
                                    <input type="text" class="form-control" id="current_website" name="current_website" placeholder="webart.technology" value="{{ $data -> current_website }}"/>
                                    @if($errors->has('current_website'))
                                    <small class="text-danger" id="current_websiteerrmsg">{{ $errors->first('current_website') }}</small>
                                    @endif
                                </div>  

                                <div class="col-md-6">
                                    <label class="form-label" for="agent_name">{{ __('Agent Name') }}</label>                                    
                                    <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Agent name" value="{{ $data ->agent_name }}">     
                                    @if($errors->has('agent_name'))
                                    <small class="text-danger" id="agent_nameerrmsg">{{ $errors->first('agent_name') }}</small>
                                    @endif                             
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="closer_name">{{ __('Closer Name') }}</label>                                    
                                    <input type="text" name="closer_name" id="closer_name" class="form-control" placeholder="Closer name" value="{{ $data ->closer_name }}">     
                                    @if($errors->has('closer_name'))
                                    <small class="text-danger" id="closer_nameerrmsg">{{ $errors->first('closer_name') }}</small>
                                    @endif                            
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="remarks">{{ __('Remarks') }}</label>
                                    <textarea class="form-control" id="remarks" name="remarks" placeholder="Your remarks here...">{{ $data ->remarks }}</textarea>
                                    @if($errors->has('remarks'))
                                    <small class="text-danger" id="remarkserrmsg">{{ $errors->first('remarks') }}</small>
                                    @endif   
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
       let lineNo = 2;     
        $("#addrow").click(function () {         
            markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5"><label class="form-label" for="email">{{ __("Email ID") }}</label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="+447975777666" /></div> <div class="col-md-2"> <span class="btn btn-danger mt-4"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
            tableBody = $("#multipleimage");
            tableBody.append(markup);
            lineNo++;
        }); 
}); 
function deleteRow(lineno){
        $("#deleterow"+lineno).click(function () {    
            $('#deleterow'+lineno).remove();
        });
}


</script>