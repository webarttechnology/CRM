<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class WorkhistoryController extends Controller
{
    public function create(Request $request){   
          
        $taskdetails = \App\Models\Developertask::find($request->get('job_id'));
        $assignTo = json_decode($taskdetails->assign_to);

       

        if(in_array(Auth::user()->id, $assignTo)){
            $history = new \App\Models\Workhistory([
                'developer_job_id' => $request->get('job_id'),
                'user_id'=> Auth::user()->id,
                'final_status' => $request->get('final_status'),
                'currenttime' => $request->get('currentTime'),
                'delayThen'=> $request->get('delayThen')?$request->get('delayThen'):0
            ]);
            $history->save();
            if($request->get('final_status') == 'start'){
                \App\Models\Developertask::where('id', $request->get('job_id'))->update(['status'=> 1]);
            }else if($request->get('final_status') == 'stop'){
                \App\Models\Developertask::where('id', $request->get('job_id'))->update(['status'=> 3]);
            }

            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0, 'msg'=> "Invalid task"]);
        }
    }
}
