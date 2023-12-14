<?php

namespace App\Http\Controllers;

use App\Models\Workhistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request){
        if($request->method() == "POST"){

        }else{

    

            $projectType = project_type();
            $task = \App\Models\Assign::select(['sales.project_name', 'sales.project_type', 'tasks.assign_date', 'tasks.assign_by', 'users.name as assign_by', 'sales.remarks', 'sales.id'])
                                       ->join('sales', 'sales.id', '=', 'tasks.sale_id')
                                       ->join('users', 'users.id', '=', 'tasks.assign_by')
                                       ->where('assign_to', Auth::user()->id)
                                       ->orderBy('tasks.assign_date', 'DESC')
                                       ->get();           
            return view('admin.task.task', compact('task', 'projectType'));
        }
    }
}
