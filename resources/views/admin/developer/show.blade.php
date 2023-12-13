<x-header-component/> 
<x-nav-component/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container-xxl flex-grow-1 container-p-y">
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
                              <time id="timer">{{ $jobStatus? $jobStatus->currenttime: '0:00:00' }}</time>
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
                      <button class="btn btn-warning" id="toggle">Start Task</button>
                      @elseif($jobStatus?->final_status == 'start')
                      <button class="btn btn-warning" id="toggle">Stop Task</button>
                      @elseif($jobStatus?->final_status == 'stop')
                      <button class="btn btn-primary" id="toggle">Resume Task</button>
                      @elseif($jobStatus?->final_status == 'resume')
                      <button class="btn btn-warning" id="toggle">Start Task</button>
                      @endif
                    </div>              
                </div>
          </div>
    </div>
<x-footer-component/>
<script>
  
window.onload=function(){
    (function timer() {
        'use strict';
    
        //declare
        var output = document.getElementById('timer');
        var toggle = document.getElementById('toggle');        
        var clear = document.getElementById('clear');
        var running = $("#running").val()==1?true:false;
        var paused = $("#paused").val()==1?true:false;
        var timer;
        
        // timer start time
        var then;
        // pause duration
        var delay;
        // pause start time
        var delayThen;
    
        
        // start timer
        var start = async function() {
            const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=start&currentTime='+$('#timer').html());
            if(response.data.status == 1){
              delay = 0;
              running = true;
              then = Date.now();              
              timer = setInterval(run,51);
              toggle.classList.remove('btn-warning');
              toggle.classList.add('btn-danger');
              toggle.innerHTML = 'Stop Task';
            }else{
              console.log(response.data.msg)
            }
          
        };
        
        
        // parse time in ms for output
        var parseTime = function(elapsed) {
            // array of time multiples [hours, min, sec, decimal]
            var d = [3600000,60000,1000,10];
            var time = [];
            var i = 0;
    
            while (i < d.length) {
                var t = Math.floor(elapsed/d[i]);
    
                // remove parsed time for next iteration
                elapsed -= t*d[i];
    
                // add '0' prefix to m,s,d when needed
                t = (i > 0 && t < 10) ? '0' + t : t;
                time.push(t);
                i++;
            }
            
            return time;
        };
        
        
        // run
        var run = function() {        
            var time = parseTime(Date.now()-then-delay);           
            output.innerHTML = time[0] + ':' + time[1] + ':' + time[2];
        };
        
        
        // stop
        var stop = async function() {
            const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=stop&currentTime='+$('#timer').html());
            if(response.data.status == 1){
              paused = true;
              delayThen = Date.now();
              toggle.innerHTML = 'Resume Task';
              toggle.classList.remove('btn-danger');
              toggle.classList.add('btn-primary');
              clearInterval(timer);    
              run();
            }else{
              console.log(response.data.msg)
            }                    
        };
        
        
        // resume
        var resume = async function() {
           const response = await axios.get("/workhistory?job_id="+$("#job_id").val()+'&final_status=resume&currentTime='+$('#timer').html());

           if(response.data.status == 1){
              paused = false;
              delay += Date.now()-delayThen;
              timer = setInterval(run,51);
              toggle.innerHTML = 'Stop Task';
            }else{
              console.log(response.data.msg)
            }           
            //clear.dataset.state = '';
        };
        
        
        // clear
        var reset = function() {
            running = false;
            paused = false;
            toggle.innerHTML = 'start';
            output.innerHTML = '0:00:00';
            //clear.dataset.state = '';
        };
        
        
        // evaluate and route
        var router = function() {
            if (!running) start();
            else if (paused) resume();
            else stop();
        };
        
        toggle.addEventListener('click',router);
       // clear.addEventListener('click',reset);        
    })();    

}
</script>