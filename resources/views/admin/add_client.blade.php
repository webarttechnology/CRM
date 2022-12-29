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
                                    <label class="form-label" for="name">Client Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="country_name">{{ __("Country name") }} <span class="text-danger">*</span></label>
                                    <select name="country_name" id="country_name" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($countries as $val)
                                        <option value="{{ $val['name'] }}">{{ $val['name'].' ('.$val['code'].')' }}</option>
                                        @endforeach    
                                    </select>
                                </div>   
                                <div class="col-md-6">
                                    <label class="form-label" for="email">{{ __("Email ID(Primary)") }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" />
                                </div>  
                                <div class="col-md-6">
                                    <label class="form-label" for="address">{{ __('Address') }}</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="1A, Ho Chi Minh Sarani Rd" />
                                </div>   
                                <div class="col-md-5">
                                    <label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="alteremail" name="alteremail[]" placeholder="jhon.doe@gmail.com" />
                                </div>  
                                <div class="col-md-5">
                                    <label class="form-label" for="address">{{ __('Mobile No') }}</label>
                                    <input type="text" class="form-control" id="mobile_no1" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" />
                                </div>    
                                <div class="col-md-2">
                               
                                    <span id="addrow" class="btn btn-primary mt-4" ><i class="fa fa-plus" ></i></span>
                                </div>   
                                <span id="multipleimage"></span>  
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="current_website">{{ __('Current Website') }}</label>
                                    <input type="text" class="form-control" id="current_website" name="current_website" placeholder="webart.technology" />
                                </div>  

                                <div class="col-md-6">
                                    <label class="form-label" for="current_website">{{ __('Agent Name') }}</label>                                    
                                    <select name="agent_name" id="agent_name" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($agents as $val)
                                        <option value="{{ $val -> id }}">{{ $val -> name }}</option>
                                        @endforeach    
                                    </select>                               
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="current_website">{{ __('Closer Name') }}</label>                                    
                                    <select name="closer_name" id="closer_name" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($closers as $val)
                                        <option value="{{ $val -> id }}">{{ $val -> name }}</option>
                                        @endforeach    
                                    </select>                               
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="remarks">{{ __('Remarks') }}</label>
                                    <textarea class="form-control" id="remarks" name="remarks" placeholder="Your remarks here..."></textarea>
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
            markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5"><label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" /></div> <div class="col-md-2"> <span class="btn btn-danger mt-4"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
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