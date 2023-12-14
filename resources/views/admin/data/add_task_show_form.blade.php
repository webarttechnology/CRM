<div class="modal-header">
    <h4 class="modal-title text-center">Task details</h4>
    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">                  
                    <div class="card-body">
                     <div class="row justify-content-center">
                        <div class="col-md-12 row">
                          <div class="d-flex justify-content-between align-items-baseline">
                            <div>
                              <h4 class="fw-bold py-3 mb-4 text-left">{{ __('Task details' )}}</h4>
                            </div>
                            <div class="btn btn-info">
                               <time id="timer" class="text-white countdown{{ $data->id }}">{{ $jobStatus?->currenttime ?? '0:00:00' }}</time>
                            </div>
                          </div>

                          <input type="hidden" id="job_id" value="{{ $data->id }}">
                          <input type="hidden" id="running" value="{{ $running }}">
                          <input type="hidden" id="paused" value="{{ $paused  }}">
                          
                          <div class="col-md-2">Project Name :</div> <div class="col-md-4"> <span>{{ $data->project_name }}</span></div>  
                          <div class="col-md-2">Task Title :</div> <div class="col-md-4"> <span>{{ $data->title }}</span></div> 
                          <div class="col-md-2">Task Details :</div> <div class="col-md-10"> <span>{!!  $data->details !!}</span></div>  
                          <div class="col-md-2">Active Date :</div> <div class="col-md-4"> <span>{{ date("jS M, h:i:s a", strtotime($data->start_date)) }}</span></div> 
                          <div class="col-md-2">Deadline :</div> <div class="col-md-4"> <span>{{ date("jS M, h:i:s a", strtotime($data->end_date)) }}</span></div> 
                          <div class="col-md-2">Created By :</div> <div class="col-md-4"> <span>{{ $data->assign_by_name }}</span></div> 
                          <div class="col-md-2">Created Date :</div> <div class="col-md-4"> <span>{{ date("d/m/Y h:i:s a", strtotime($data->created_at)) }}</span></div> 
                        </div>
                     </div>   
                    </div>
                  </div>
                </div>  
                
                <div class="d-flex flex-row justify-content-center">
                    <div class="px-1 clonebtn">
                      @if($jobStatus?->final_status == '')
                      <button class="btn btn-warning text-white timer-btn" data-id="{{ $data->id }}" data-type="start">Start Task</button>
                      @elseif($jobStatus?->final_status == 'start')
                      <button class="btn btn-danger text-white timer-btn" data-id="{{ $data->id }}" data-type="stop">Stop Task</button>
                      @elseif($jobStatus?->final_status == 'stop')
                      <button class="btn btn-warning text-white timer-btn" data-id="{{ $data->id }}" data-type="start">Start Task</button>
                      @endif
                    </div>              
                </div>
          </div>
        </div>
    </div>
</div>
