<?php

namespace App\Http\Controllers;

use App\Models\Workhistory;
use Illuminate\Http\Request;
use App\Models\Developertask;
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

        dd($request->all());
        
    }

}
