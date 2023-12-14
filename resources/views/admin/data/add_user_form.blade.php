<div class="modal-header">
        <h4 class="modal-title text-center">{{ $user_data  ? 'Update User' : 'Add User' }} </h4>
        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
        <div class="row">
        <div class="col-md-12">
           @if ($user_data)
           <form method="post" action="{{ route('user.update.success') }}"  class="save" autocomplete="off"> 
            <input type="hidden" name="update_id" id="update_id" value="{{ $user_data->id }}">
           @else
           <form method="post" action="{{ route('user.add.success') }}"  class="save" autocomplete="off"> 
           @endif
         
            @csrf
            <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="name">Full name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ $user_data?->name }}" />
                        @if($errors->has('name'))
                        <small class="text-danger" id="nameerrmsg">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="email">{{ __("Email ID") }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="jhon.doe@gmail.com" value="{{ $user_data?->email }}"/>
                        @if($errors->has('email'))
                        <small class="text-danger" id="emailerrmsg">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="mobile_no">{{ __('Mobile No') }}</label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="+998889823"  value="{{ $user_data?->mobile_no }}"/>
                    </div>   
                     
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="role">{{ __('Role') }}</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($role->toArray() as $key => $r)
                            <option value="{{ $key }}" {{ $key == $user_data?->role_id ?'Selected':"" }}>{{ $r }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                        <small class="text-danger" id="role_id">{{ $errors->first('role_id') }}</small>
                        @endif
                    </div> 

                    @if ($user_data == null)
                      <div class="col-md-6 mb-3">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="confirm_password">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                    </div> 
                    @endif

                    <div class="col-md-6">
                      <label class="form-label" for="role">{{ __('Status') }}</label>
                      <select name="is_active" id="is_active" class="form-control">
                          <option value="">Select</option>
                          <option value="1" {{ $user_data?->is_active == 1?'Selected':'' }}>Active</option>
                          <option value="0" {{ $user_data?->is_active == 0?'Selected':'' }}>Inactive</option>
                      </select>
                      @if($errors->has('is_active'))
                      <small class="text-danger" id="is_active">{{ $errors->first('is_active') }}</small>
                      @endif
                  </div>

            </div>                        
             <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-5 form-submit">Send</button>
                </div>
             </div>
          </form>

        </div>
        </div>
</div>