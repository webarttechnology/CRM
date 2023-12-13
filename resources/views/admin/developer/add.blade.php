<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Developer Task </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                  <div class="card">
                     <div class="card-body">
                          <span class="text-danger text-err" ></span>
                        <form  id="taskform" class="container" method="post">
                          @csrf
                          <input type="hidden" name="upate_id" id="update_id"/>
                          <div class="row">
                                  <div class="col-md-12">
                                      <label class="form-label" for="name">Project Name <span class="text-danger">*</span></label>
                                      <select name="sale_id" id="sale_id" class="form-control">
                                          <option value="">Select</option>
                                          @foreach($sales as $key=> $item)
                                              <option value="{{$key}}" {{ $key == old("sale_id") }}>{{ $item }}</option>
                                          @endforeach
                                      </select>
                                      <small class="text-danger" id="sale_id_formerrmsg"></small>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label" for="assign_type">{{ __("Assign Type") }} <span class="text-danger">*</span></label>
                                        <select name="assign_type" id="assign_type" class="form-control">
                                            <option value="">Select Type</option>
                                            @foreach(role() as $key => $val)
                                              <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    <small class="text-danger" id="assigntype_formerrmsg"></small>
                                </div>
                                  <div class="col-md-6">
                                    <div class="dynamic_assign_to">
                                        <label class="form-label" for="assign_to">{{ __("Assign to") }} <span class="text-danger">*</span></label>
                                        <select name="assign_to[]" id="assign_to" multiple="multiple" class="form-control js-example-basic-multiple">
                                            {{-- <option value="">Select</option> --}}
                                            @foreach($developer as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="assignto_formerrmsg">{{ $errors->first('assign_to') }}</small>
                                    </div>
                                  </div>  
                                  <div class="col-md-12">
                                      <label class="form-label" for="title">{{ __("Title") }} <span class="text-danger">*</span></label>
                                      <input type="text" name="title" id="title" class="form-control" placeholder="Task Title" value="{{ old('title') }}">
                                      <small class="text-danger" id="title_formerrmsg">{{ $errors->first('title') }}</small>
                                  </div>   
                                  <div class="col-md-12">
                                      <label class="form-label" for="details">{{ __("Details") }} <span class="text-danger">*</span></label>
                                      <textarea class="form-control" id="details" name="details" placeholder="Task Details"></textarea>
                                      <small class="text-danger" id="details_formerrmsg">{{ $errors->first('details') }}</small>
                                  </div>  
                                  <div class="col-md-6">
                                      <label class="form-label" for="start_date">{{ __('Start Date & Time') }} <span class="text-danger">*</span></label>
                                      <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}"/>
                                      <small class="text-danger" id="start_date_formerrmsg">{{ $errors->first('start_date') }}</small>
                                  </div>   
                                   
                                  <div class="col-md-6">
                                      <label class="form-label" for="end_date">{{ __('End Date & Time') }} <span class="text-danger">*</span></label>
                                      <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" />
                                      <small class="text-danger" id="end_date_formerrmsg">{{ $errors->first('end_date') }}</small>
                                  </div> 
                                  
                                  <div class="col-md-12">
                                      <label class="form-label" for="remarks">{{ __('Remarks') }}</label>
                                      <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks" >{{ old('remarks') }}</textarea>
                                      <small class="text-danger" id="remarks_formerrmsg">{{ $errors->first('remarks') }}</small>
                                  </div>  
                          </div>                        
                      </div>
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Save">
        </div>
         </form>
      </div>
    </div>
  </div>