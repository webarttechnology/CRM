<x-header-component/> 
<x-nav-component/>

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">{{ __('Add User' )}}</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">                  
                    <div class="card-body">
                        <span class="text-success">{{ Session::get('successmsg') }}</span>
                        <span class="text-danger">{{ Session::get('errmsg') }}</span>
                      <form method="post" action="{{ route('user.add.success') }}" onsubmit="return valid();" autocomplete="off">
                        @csrf
                        <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">Full name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ old('name') }}" />
                                    @if($errors->has('name'))
                                    <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                            
                                <div class="col-md-6">
                                    <label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ old('email') }}"/>
                                    @if($errors->has('email'))
                                    <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="mobile_no">{{ __('Mobile No') }}</label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="+998889823" />
                                </div>   
                                 
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="role">{{ __('Role') }}</label>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($role->toArray() as $key => $r)
                                        <option value="{{ $key }}" {{ $key == old('role_id')?'Selected':"" }}>{{ $r }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('role_id'))
                                    <small class="text-danger" id="role_id">{{ $errors->first('role_id') }}</small>
                                    @endif
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                </div> 

                                <div class="col-md-6">
                                    <label class="form-label" for="confirm_password">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
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
            markup = '<div class="row" id="deleterow'+ lineNo +'"> <div  class="col-md-5"><label class="form-label" for="email">{{ __("Email ID") }}</label><input type="email" class="form-control" id="alteremail'+ lineNo +'" name="alteremail[]" placeholder="jhon.doe@gmail.com" /></div><div class="col-md-5"><label class="form-label" for="address">{{ __("Mobile No") }}</label><input type="text" class="form-control" id="address'+ lineNo +'" name="mobile_no[]" placeholder="1A, Ho Chi Minh Sarani Rd" /></div> <div class="col-md-2"> <span class="btn btn-danger mt-4"  onclick="deleteRow('+ lineNo +')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div> </div>' ;
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

function valid(){
    if($("#name").val() == ""){
        toastr.error('User name is a require field!');
        $("#name").focus();
        $("#name").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        return false;
    }else if($("#email").val() == ""){
        toastr.error('Email id is a require field!');
        $("#email").focus();
        $("#email").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        return false;
    }else if($("#role_id").val() == ""){
        toastr.error('Role id is a require field!');
        $("#role_id").focus();
        $("#role_id").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        return false;
    }else if($("#password").val() == ""){
        toastr.error('Password is a require field!');
        $("#password").focus();
        $("#password").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        return false;
    }else if($("#password").val() != $("#confirm_password").val()){
        toastr.error('Confirm Password does not match!');
        $("#confirm_password").focus();
        $("#confirm_password").css({"border-color": "red", "border-width":"1px", "border-style":"solid"});
        return false;
    }      
}


</script>