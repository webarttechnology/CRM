<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developertask;
use App\Models\Sale;
use Auth;
class DeveloperController extends Controller
{
    public function task(Request $request){
        if($request->method() == "POST"){

            $startDate = date("Y-m-d H:i:s", strtotime($request->input('start_date')));
            $endDate = date("Y-m-d H:i:s", strtotime($request->input('end_date')));
            $totalTime = getTimeInterval($startDate, $endDate);
           
            $request->validate([
                'sale_id' => 'required',
                'assign_to' => 'required',
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
            ]);


            $assignTo = json_encode($request->input('assign_to'));
           

            if($request->input('update_id') != ''){
                $task = Developertask::find($request->input('update_id'));
                $task -> fill([
                    'sale_id' => $request->input('sale_id'),
                    'assign_to' => $assignTo,
                    'assign_by' => Auth::user()->id,
                    'title' => $request->input('title'),
                    'details' => $request->input('details'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'total_time' => $totalTime,
                    'remarks' => $request -> input('remarks')?$request -> input('remarks'):''
                ]);
            }else{
                $task = new Developertask([
                    'sale_id' => $request->input('sale_id'),
                    'assign_to' => $assignTo,
                    'assign_by' => Auth::user()->id,
                    'title' => $request->input('title'),
                    'details' => $request->input('details'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'total_time' => $totalTime,
                    'status'=> 0,
                    'remarks' => $request -> input('remarks')?$request -> input('remarks'):''
                ]);
            }          

            $task -> save();            
            if($task){
                return response()->json(['status' => 1, 'successmsg'=> $request->input('update_id') == ''?'New job has been created successfully.':'New job has been updated successfully']);
            }else{
                return response()->json(['status' => 0,'errmsg'=>'Job creation error. Please try again']);
            }


        }else if($request->method() == "GET"){ 
                
                $isEdit = $isDelete = $isShow = 0; 
                if(in_array(Auth::user() -> role_id, ['6', '7'])){
                    $data = Developertask::where('assign_to','LIKE','%"'.Auth::user() -> id.'"%') -> get(); 
                    $isShow = 1;       
                }else if(in_array(Auth::user() -> role_id, ['2', '3'])){
                    $data = Developertask::where('assign_by', Auth::user() -> id)->get();                      
                    $isEdit = $isDelete = 1;         
                }else{
                    $data = Developertask::get(); 
                    $isEdit = $isDelete = $isShow = 1;   
                }         
                $sales = Sale::pluck('project_name', 'id');
                $developer = \App\Models\User::whereIn('role_id', ["6", "7"])->pluck('name', 'id');     
                $assignBy = \App\Models\User::whereIn('role_id', ["2","3","1"])->pluck('name', 'id');            
                return view("admin.developer.task", compact('data','sales', 'developer', 'assignBy', 'isEdit', 'isDelete', 'isShow'));                     
        }
    }

    public function edit(Request $request){
        $task = Developertask::find($request->get('task_id'));
        return response()->json(['status' => 1, 'data'=>$task]);
    }

    public function delete(Request $request){
        if($request->method() == 'GET'){
            $task = \App\Models\Developertask::find($request->get('deleteid'));          
            if($task){
                $task -> delete();
                return redirect() -> route('developer.task')->with('successmsg', "Data has been deleted successfully!!."); 
            }else{
                return redirect() -> route('developer.task')->with('errmsg', "Error!! Please try agian."); 
            }
        }
    }

    public function show(Request $request, $id){       
        if($request->method() == 'GET'){
            $running = 0;
            $paused = 0;
            $data = Developertask::select(['sales.project_name', 'assignby.name as assign_by_name', 'developer_jobs.*'])
                                 ->join('sales', 'sales.id', '=', 'developer_jobs.sale_id')
                                 ->join('users as assignby', 'assignby.id', '=', 'developer_jobs.assign_by')
                                 ->where('developer_jobs.id', $id)
                                 ->first();
         
            $jobStatus = \App\Models\Workhistory::where('developer_job_id', $id)->where('user_id', Auth::user()->id)->latest()->first();        
           
            if($jobStatus?->final_status == 'start'){
                $running = 1;
            }     
            
            if($jobStatus?->final_status == 'stop'){
                $paused = 1;
                $running = 1;
            }
      
            $delayThen = $jobStatus?->delayThen;

            return view('admin.developer.show', compact('data', 'jobStatus', 'paused', 'running', 'delayThen'));
        }
    }

  
}
