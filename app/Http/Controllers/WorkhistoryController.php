<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\Workhistory;
use Illuminate\Http\Request;
use App\Models\Developertask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WorkhistoryController extends Controller
{
    public function create(Request $request){   
          
        $taskdetails = Developertask::find($request->get('job_id'));
        $assignTo    = json_decode($taskdetails->assign_to);

        // dd(Auth::user()->id);
        // dd($request->get('job_id'));

        if(in_array(Auth::user()->id, $assignTo)){
            $history = new Workhistory([
                'developer_job_id' => $request->get('job_id'),
                'user_id'=> Auth::user()->id,
                'final_status' => $request->get('final_status'),
                'currenttime'  => $request->get('currentTime'),
                'delayThen'    => $request->get('delayThen') ? $request->get('delayThen') : 0
            ]);

            $history->save();

            //dd($history);

            if($request->get('final_status') == 'start'){

                Developertask::where('id', $request->get('job_id'))->update(['status'=> 1]);

            }else if($request->get('final_status') == 'stop'){

                Developertask::where('id', $request->get('job_id'))->update(['status'=> 3]);
            }

            return response()->json( ['status' => 1] );

        }else{

            return response()->json(['status' => 0, 'msg'=> "Invalid task"]);

        }
    }


    public function get_total_workhistory_per_task(Request $request)
    {

        $jobTotalTime = Workhistory::where('developer_job_id', $request->id)->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();  
        
        if($jobTotalTime){
            $totalTimeFormatted = $jobTotalTime->currenttime; // Replace with your actual formatted time
            // Explode the formatted time to get hours, minutes, and seconds
            [$hours, $minutes, $seconds] = explode(':', $totalTimeFormatted);
            // Calculate the total time in seconds
            $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
        }else{
            $totalSeconds = 0;
        }

        echo $totalSeconds;

    }


    public function store_total_workhistory_per_task(Request $request)
    {

  
        $taskdetails = Developertask::find($request->id);
        $assignTo    = json_decode($taskdetails->assign_to);

        if(in_array(Auth::user()->id, $assignTo)){

            $data  = [
                'developer_job_id' => $request->id,
                'user_id'          => Auth::user()->id,
                'final_status'     => $request->type,
                'currenttime'      => $request->time,
                'delayThen'        => 0
            ];

            $last = Workhistory::create($data);

            if($request->type == 'start'){

                Developertask::where('id', $request->id)->update(['status'=> 1]);

                $last_id = $last->id - 1;

                if($last_id > 0){

                   $last_work_data = Workhistory::where('id', $last_id)->where('final_status', 'start')->first();

                   if($last_work_data){

                    $data_last  = [
                        'developer_job_id' => $last_work_data->developer_job_id,
                        'user_id'          => Auth::user()->id,
                        'final_status'     => 'stop',
                        'currenttime'      => $request->last_counter_time,
                        'delayThen'        => 0
                    ];

                    Workhistory::create($data_last);

                   }

                }

            
                Workhistory::whereNot('developer_job_id', $last->developer_job_id)->where('user_id', Auth::user()->id)->update(['final_status'=> 'stop']);

            }else if($request->type == 'stop'){

                Developertask::where('id', $request->type)->update(['status'=> 3]);

            }

            return response()->json( ['status' => 1] );

        }else{

            return response()->json(['status' => 0, 'msg'=> "You can not start this task"]);

        }

    }


    public function get_status_work_history(Request $request)
    {
        
       $work =  Workhistory::where('user_id', Auth::user()->id)->where('developer_job_id', $request->id)->latest()->first();
      
       if($work){
         $status  = $work->final_status;
        // $time    = '00:00:00';
       }else{
         $status  = false;
         // $time    = '00:00:00';
       }

       return response()->json( ['status' => $status ] );

    }

    public function store_status_page_refresh(Request $request)
    {
        
        $work =  Workhistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        if($work){
             if($work->final_status == 'start'){
                $data  = [
                    'developer_job_id' => $work->developer_job_id,
                    'user_id'          => Auth::user()->id,
                    'final_status'     => $work->final_status,
                    'currenttime'      => $request->last_counter_time,
                    'delayThen'        => 0
                ];
             }

             $timeWithoutColons = str_replace(":", "", $request->last_counter_time);

             if($timeWithoutColons > 0){
                 Workhistory::create($data);
             }
        }

          return true;
    }

    public function current_task_timer_get(Request $request)
    {
        
       $work =  Workhistory::where('user_id', Auth::user()->id)->latest()->first();
      
       if($work){
         $status  = $work->final_status;
         $time    = $work->currenttime;
         $id      = $work->developer_job_id;
       }else{
         $status  = false;
         $time    = '00:00:00';
         $id      = null;
       }

       return response()->json( ['status' => $status, 'timer' => $time, 'id' => $id  ] );

    }

    public function get_task_list(Request $request)
    {

       $work =  Workhistory::where('user_id', Auth::user()->id)
       ->distinct('user_id')->latest()
       ->where('final_status', 'stop')
       ->orwhere('final_status', 'start')
       ->select('user_id', 'developer_job_id', 'final_status')->get();

       return view('admin.data.working-task', compact('work'))->render();
    }

    public function store_workstatus_page_refresh(Request $request)
    {
        $today = Carbon::today();
        $work =  TimeLog::where('user_id', Auth::user()->id)->whereDate('created_at', $today)->orderBy('id', 'desc')->first();
        $startTime =  Carbon::parse($request->start_time);
        $startTime->setTimezone('Asia/Kolkata');
        if ($work) {

            $data  = [
                'user_id'       => Auth::user()->id,
                'start_time'    => $startTime->format('H:i:s'),
                'timer_data'    =>  $request->last_counter_time,
                'type' =>  $work->type,
                'status' =>   $work->status,
            ];
            TimeLog::create($data);
        }
        return true;
    }


    public function current_work_timer_get(Request $request)
    {

        $today = Carbon::today();
        $work =  TimeLog::where('user_id', Auth::user()->id)->whereDate('created_at', $today)->orderBy('id', 'desc')->first();
        if ($work) {
            $start_time = $work->start_time;
            $timer_data = $work->timer_data;
            $type =  $work->type;
            $status =  $work->status;
        } else {
            $start_time = null;
            $timer_data = null;
            $type =  null;
            $status =  null;
        }

        return response()->json(['start_time' => $start_time, 'timer_data' => $timer_data, 'type' => $type, 'status' => $status]);
    }

    public function last_work_timer_get(Request $request)
    {

        $previousDay = now()->subDay(); // Get the date of the previous day
        $works =  TimeLog::where('user_id', Auth::user()->id)->whereDate('created_at', $previousDay->toDateString())->orderBy('id', 'desc')->first();
        return response()->json(['works' => $works]);
    }

    public function saveReason(Request $request)
    {
        // dd($request->all());
        // $validatedData = $request->validate([
        //     'date' => 'required|date',
        //     'time' => 'required',
        //     'reason' => 'required',
        // ]);

        $workHistory = new TimeLog();
        $workHistory->user_id = Auth::user()->id;
        // $workHistory->start_time = $validatedData['time'];
        $workHistory->start_time = $request->time;
        $workHistory->type = "work";
        $workHistory->status = "end";
        $workHistory->reason = $request->reason;
        $workHistory->created_at = $request->created;
        $workHistory->updated_at = $request->updated;
        $workHistory->save();

        // You can return a response as needed (for example, JSON response)
        return response()->json(['message' => 'Data saved successfully']);
    }



    public function previous_work_timer_get(Request $request)
    {
        $today = Carbon::today();
        $prevWork =  TimeLog::where('user_id', Auth::user()->id)->whereDate('created_at', $today->toDateString())->orderBy('id', 'desc')->first();
        // dd($prevWork);

        // Calculate current time and duration
        $currentTime = Carbon::now();
        $startTime = Carbon::parse($prevWork->start_time);
        $startTime->setTimezone('Asia/Kolkata');
        $elapsedTime = $currentTime->diffInSeconds($startTime);

        // Add the elapsed time to the previous timer_data
        $newTimerData = Carbon::parse($prevWork->timer_data)->addSeconds($elapsedTime)->format('H:i:s');

        if($prevWork){
            $newtime = new TimeLog();
            $newtime->user_id = Auth::user()->id;
            $newtime->start_time = $currentTime->format('H:i:s');
            $newtime->timer_data = $newTimerData;
            $newtime->type = $prevWork->type;
            $newtime->status = $prevWork->status;
            $newtime->save();
        }
        return response()->json(['prevworks' => $prevWork]);
    }
    
    
    

}
