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

        echo taskTime($request->id)['totalSecond'];

    }


    public function store_total_workhistory_per_task(Request $request)
    {
  
        $taskdetails = Developertask::find($request->id);
        $assignTo    = json_decode($taskdetails->assign_to);

        if(in_array(Auth::user()->id, $assignTo)){

            $ClockInCheck = TimeLog::whereDate('created_at', date('Y-m-d'))
                            ->where('user_id', Auth::id())
                            ->where('type', 'work')
                            ->where('status', 'start')
                            ->first();

            if($ClockInCheck == null){
                return response()->json(['status' => 0, 'msg'=> "Please first clockin then you can start task"]);
            }


            $data  = [
                'developer_job_id' => $request->id,
                'user_id'          => Auth::user()->id,
                'final_status'     => $request->type,
                'currenttime'      => null, // $request->time,
                'delayThen'        => 0
            ];

            $last = Workhistory::create($data);

            if($request->type == 'start'){

                Developertask::where('id', $request->id)->update(['status'=> 1]);

                Workhistory::whereNot('developer_job_id', $last->developer_job_id)->where('user_id', Auth::user()->id)->update(['final_status'=> 'stop']);

            }else if($request->type == 'stop'){

                Developertask::where('id', $request->id)->update(['status'=> 3]);

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

                $timeWithoutColons = str_replace(":", "", $request->last_counter_time);

                if($timeWithoutColons > 0){
                    Workhistory::create($data);
                }

             }
        }

          return true;
    }

    public function current_task_timer_get(Request $request)
    {
        
       $work =  Workhistory::where('user_id', Auth::user()->id)->latest()->first();
      
       if($work){
         $status  = $work->final_status;
         $time    = taskTime($work->developer_job_id)['timeformat'];
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

    //    $work =  Workhistory::where('user_id', Auth::user()->id)
    //    ->distinct('user_id')->latest()
    //    ->where('final_status', 'stop')
    //    ->orwhere('final_status', 'start')
    //    ->select('user_id', 'developer_job_id', 'final_status')->get();

       $finalStatusArray = ['stop', 'start'];

       $work =  Workhistory::select('user_id', 'developer_job_id', 'final_status', 'created_at')
            ->distinct()
            ->where('user_id', Auth::user()->id)
            ->whereIn('final_status', $finalStatusArray)
            ->orderBy('created_at', 'desc')
            ->get();

       return view('admin.data.working-task', compact('work'))->render();
    }
 

}
