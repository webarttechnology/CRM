<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Closer;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Models\Upsale;
use App\Models\Comment;
use App\Models\GroupName;
use App\Models\Collection;
use App\Traits\SalesTrait;
use App\Models\Workhistory;
use App\Traits\ClientTrait;
use App\Traits\UpsaleTrait;
use Illuminate\Http\Request;
use App\Models\Developertask;
use App\Traits\CollectionTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use ClientTrait;
    use SalesTrait;
    use UpsaleTrait;
    use CollectionTrait;
    public function login(Request $request){
       if($request -> method() == "POST"){ 
        if(Auth::guard('admin')->attempt(['email' => $request -> input('email'), 'password' => $request -> input('password')])){          
            return redirect() -> route('admin.dashboard');
        }else{
            return redirect() -> route('admin.login');
        }
         
       }else{
        return view("admin.login");
       }
    }

    public function register(Request $request){
        if($request -> method() == "POST"){

        }else{
            return view("admin.register");
        }
    }


    public function dashboard(Request $request){
        if($request -> method() == "POST"){
            
        }else{           
            $month = date('m');          
            
            DB::disableQueryLog();
            $task = $salesGrossAmount = $salesNetAmount = $upsaleGrossAmount = $upsaleNetAmount = $collectionAmount = $salesdata = $upsalesdata = $collections = [];
            $isEdit = $isDelete = 0; 
            $isShow = 0;
            if(in_array(Auth::user()->role_id, [1,2])){
                $salesdata = $this -> getLatestSales();
                $upsalesdata = $this -> getLatestUpsales();
                $collections = $this -> getLatestCollection();
                $salesGrossAmount = \App\Models\Sale::whereMonth('sale_date', $month) ->sum('gross_amount');
                $salesNetAmount = \App\Models\Sale::whereMonth('sale_date', $month)->sum('net_amount');
                $upsaleGrossAmount = \App\Models\Upsale::whereMonth('sale_date', $month)->sum('gross_amount');
                $upsaleNetAmount = \App\Models\Upsale::whereMonth('sale_date', $month)->sum('net_amount');
                $collectionAmount = \App\Models\Collection::whereMonth('sale_date', $month)->where('instalment', '<>', 1) -> sum('net_amount');
            }

            if(in_array(Auth::user()->role_id, [3])){
                $salesdata = $this -> getLatestSales();
            }



            if(in_array(Auth::user()->role_id, [6,7])){
                $isShow = 1;
                $task = \App\Models\Developertask::select(['sales.project_name', 'assignby.name as assign_by_name', 'assignto.name', 'developer_jobs.*'])
                ->join('sales', 'sales.id', '=', 'developer_jobs.sale_id')
                ->join('users as assignby', 'assignby.id', '=', 'developer_jobs.assign_by')
                ->join('users as assignto', 'assignto.id', '=', 'developer_jobs.assign_to')
                ->where('developer_jobs.assign_to', Auth::user()->id)
                ->where('developer_jobs.status', 0)
                ->get();
            }
            

            // $work = Workhistory::where('developer_job_id', 1)->where('user_id', Auth::user()->id)->pluck('currenttime');


            // dd($work);
            

            return view("home", ['sales' => $salesdata, 
                                 'upsales' => $upsalesdata, 
                                 'collections' => $collections, 
                                 'currency' => currency(), 
                                 'isntalment' => instalment(), 
                                 'paymentmode' => payment_mode(),
                                 'sale_gross' => $salesGrossAmount,
                                 'sale_net' => $salesNetAmount,
                                 'upsale_gross' => $upsaleGrossAmount,
                                 'upsale_net' => $upsaleNetAmount,
                                 'collection' => $collectionAmount,
                                 'task' => $task,
                                 'isEdit'=>$isEdit,
                                 'isDelete' => $isDelete,
                                 'isShow' => $isShow 
                                ]);
        }
    }

    public function logout(Request $request){
        if($request ->method() == "GET"){
            Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
            return redirect() -> route('login');
        }
    }

    public function profile(Request $request){
        if($request->method() == "POST"){

            // dd($request->all());

            $request -> validate([
                'name'      => 'required|string',
                'email'     => 'required|email|unique:users,id,'.$request->input('update_id'),
                'mobile_no' => 'required',
                'bio'       =>'required'
            ]); 

            $data = [
                'name'          => $request->name,
                'email'         => $request->email,
                'mobile_no'     => $request->mobile_no,
            ];

            $save = User::where('id',  Auth::id())->update($data);

            if($save){
                return response()->json(['status' => 1, 'successmsg'=> 'Profile updated successfully']);
            }else{
                return response()->json(['status' => 0, 'errmsg'=>' Server error Please try again']);
            }

        }else{
            $userDetails = \App\Models\User::find(Auth::user()->id);
            return view('admin.profile', compact('userDetails'));
        }
    }



    public function show_module_form(Request $request)
    {
    
        if($request->type == 'add_client'){

             if($request->id){
                $client_data = Client::find($request->id);
             }else{
                $client_data = null;
             }

            return view('admin.data.add_client_form', compact('client_data'))->render();

        }elseif($request->type == 'add_sales'){

            if($request->sale == 'comment'){

                $sales = \App\Models\Sale::where('id', $request->id)->first();
                $comment = \App\Models\Comment::where('sale_id', $request->id)->get();   
                $taskid = $request->id;

                return view('admin.data.add_comment_form', compact('sales', 'comment', 'taskid'))->render();
                
            }elseif($request->sale == 'assign'){

                $projectmanager = User::where('role_id', 3)->pluck('name', 'id'); 
                $closer         = Closer::all();
                $agent          = Agent::all();
                $project_type   = project_type();
                $data           = $this->getSalesById($request->id);
                $client         = $this->getClients();
                
                return view('admin.data.add_assign_form', compact('projectmanager', 'closer', 'agent', 'project_type', 'data', 'client'))->render();
                
            }else{

                if($request->id){
                    $sales_data = Sale::find($request->id);
                 }else{
                    $sales_data = null;
                 }
     
                 $getClients = $this->getClients();
     
                return view('admin.data.add_sale_form', compact('sales_data', 'getClients'))->render();
            }

       }elseif($request->type == 'add_upsale'){

        if($request->id){
            $upsale_data = Upsale::find($request->id);
            $project     = Sale::select(['project_name', 'id'])->where(['client_id' => $upsale_data->client_id])->get();         
        }else{
            $upsale_data = null;
            $project     = [];
        }

        $getClients = $this->getClients();

         return view('admin.data.add_upsale_form', compact('upsale_data', 'getClients', 'project'))->render();
     
      }elseif($request->type == 'add_collection'){

        if($request->id){
            $collection_data = Collection::find($request->id);
            $project         = Sale::select(['project_name', 'id'])->where(['client_id' => $collection_data->client_id])->get();         
        }else{
            $collection_data = null;
            $project         = [];
        }

        $clients = $this->getClients();

         return view('admin.data.add_collection_form', compact('collection_data', 'clients', 'project'))->render();

     }elseif($request->type == 'add_user'){

        if($request->id){
            $user_data = User::find($request->id);
        }else{
            $user_data = null;
        }

        $role = role();

        return view('admin.data.add_user_form', compact('user_data', 'role'))->render();

     }elseif($request->type == 'profile'){
        $userDetails = Auth::user();
        return view('admin.data.add_profile_edit_form', compact('userDetails'))->render();

     }elseif ($request->type == 'add_task') {

        if ($request->sale == 'show') {
            $running = 0;
            $paused = 0;
            $data = Developertask::select(['sales.project_name', 'assignby.name as assign_by_name', 'developer_jobs.*'])
                ->join('sales', 'sales.id', '=', 'developer_jobs.sale_id')
                ->join('users as assignby', 'assignby.id', '=', 'developer_jobs.assign_by')
                ->where('developer_jobs.id', $request->id)
                ->first();
            $sales = \App\Models\Sale::where('id', $request->id)->first();
            $comment = Comment::where('sale_id', $request->id)->get();
            $taskid = $request->id;

            $jobStatus = \App\Models\Workhistory::where('developer_job_id', $request->id)->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

            if ($jobStatus?->final_status == 'start') {
                $running = 1;
            }

            if ($jobStatus?->final_status == 'stop') {
                $paused = 1;
                $running = 1;
            }

            $delayThen = $jobStatus?->delayThen;

            $assignToIds = json_decode($data->assign_to);
            $sales = \App\Models\Sale::where('id', $data->sale_id)->first();
            $workhistory = Workhistory::with('users')->whereIn('user_id', $assignToIds)->where('final_status', 'start')->get();


            // $timeIntervals = Workhistory::where('developer_job_id', $request->id)->where('user_id', Auth::user()->id)->pluck('currenttime');

            // // Initialize a Carbon instance with zero time
            // $totalTime = Carbon::createFromFormat('H:i:s', '00:00:00');

            // // dd($timeIntervals);

            // // Loop through each time interval and add it to the total time
            // foreach ($timeIntervals as $timeInterval) {
            //     $time = Carbon::createFromFormat('H:i:s', $timeInterval);
            //     $totalTime->add($time->diff($totalTime));
            // }

            // // Format the total time as desired
            // $totalTimeFormatted = $totalTime->format('H:i:s');

            return view('admin.data.add_task_show_form', compact('data', 'jobStatus', 'paused', 'running', 'delayThen', 'sales', 'comment', 'taskid','workhistory'));
        } elseif ($request->sale == 'comment') {
            $sales = \App\Models\Sale::where('id', $request->id)->first();
            $comment = Comment::where('sale_id', $request->id)->get();
            $taskid = $request->id;
            return view('comment', compact('sales', 'comment', 'taskid'))->render();
        } elseif ($request->sale == 'details') {
            $data = Developertask::select(['sales.project_name', 'assignby.name as assign_by_name', 'developer_jobs.*'])
                ->join('sales', 'sales.id', '=', 'developer_jobs.sale_id')
                ->join('users as assignby', 'assignby.id', '=', 'developer_jobs.assign_by')
                ->where('developer_jobs.id', $request->id)
                ->first();
            $datas = Developertask::where('id', $request->id)->first();
            $assignToIds = json_decode($data->assign_to);
            $sales = \App\Models\Sale::where('id', $data->sale_id)->first();
            $workhistory = Workhistory::with('users')->whereIn('user_id', $assignToIds)->where('final_status', 'start')->get();
            


            // // Calculate total currenttime
            // $totalCurrentTime = $workhistory->reduce(function ($carry, $item) {
            //     // Convert currenttime to seconds
            //     $timeParts = explode(':', $item->currenttime);
            //     $seconds = ($timeParts[0] * 3600) + ($timeParts[1] * 60) + $timeParts[2];

            //     // Add to the carry
            //     return $carry + $seconds;
            // }, 0); // Initial value set to 0

            // // Convert $totalCurrentTime back to HH:MM:SS format if needed
            // $totalCurrentTimeFormatted = gmdate('H:i:s', $totalCurrentTime);
            $taskid = $request->id;
            return view('admin.data.takdetails', compact('sales', 'workhistory', 'taskid', 'data'))->render();
        } else {
            $isEdit = $isDelete = $isShow = 0;
            if (in_array(Auth::user()->role_id, ['6', '7'])) {
                $data = Developertask::where('assign_to', 'LIKE', '%"' . Auth::user()->id . '"%')->orderBy('id', 'desc')->get();
                $isShow = 1;
            } else if (in_array(Auth::user()->role_id, ['2', '3'])) {
                $data = Developertask::where('assign_by', Auth::user()->id)->get();
                $isEdit = $isDelete = 1;
            } else {
                $data = Developertask::orderBy('id', 'desc')->get();
                $isEdit = $isDelete = $isShow = 1;
            }
            $sales = Sale::pluck('project_name', 'id');

            // $developer = \App\Models\User::whereIn('role_id', ["6", "7"])->pluck('name', 'id');   
            $developer = \App\Models\User::pluck('name', 'id');
            $assignBy = \App\Models\User::whereIn('role_id', ["2", "3", "1"])->pluck('name', 'id');

            if ($request->id) {
                $task = Developertask::find($request->id);
                $role = User::whereIn('id', json_decode($task->assign_to))->first(['role_id']);

                $stringRepresentation = $task->assign_to;
                $array_match = json_decode($stringRepresentation);
            } else {
                $task = null;
                $role = null;
                $array_match = [];
            }


            return view('admin.data.add_task_form', compact('data', 'sales', 'developer', 'assignBy', 'isEdit', 'isDelete', 'isShow', 'task', 'role', 'array_match'))->render();
        }
    }elseif ($request->type == 'add_group') {
        if($request->sale == 'invite'){
            $group = \App\Models\GroupName::where('id', $request->id)->first();
            $groupid = $request->id;
            return view('admin.group.invite', compact( 'group', 'groupid'))->render();
        }elseif($request->sale == 'viewmember'){
            $group = \App\Models\GroupName::where('id', $request->id)->first();
            $group_member= \App\Models\GroupMember::with('user')->where('group_id', $request->id)->get();
            $groupid = $request->id;
            return view('admin.group.viewMember', compact( 'group', 'groupid','group_member'))->render();
        }else{
            if ($request->id) {
                $group_data = GroupName::find($request->id);
            } else {
                $group_data = null;
            }
           return view('admin.group.add_group_form', compact('group_data'))->render();
        }
    }


       

    }

    public function show_chat_module()
    {
        return view('admin.chat.chat')->render();
    }


    

    public function chat()
    {
        return view('admin.chat.chat2');
    }



    public function forgotPassword()
    {
        return view('admin.forgotpassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $newToken = Str::random(60);
        $user->remember_token = hash('sha256', $newToken);
        $user->save();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = '/password/resetdata/' . '?token=' . $user->remember_token . '&id=' . $user->id;
        try {
            Mail::to($request->email)->send(new ResetPassword($link));
            return redirect(url('/forgot-password'))->with('successmsg', 'Link send successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function showResetForm(Request $request)
    {
        // $providedToken = $request->token;
        // $hashedProvidedToken = hash('sha256', $providedToken);
        $user = User::where('id', $request->id)->where('remember_token', $request->token)->first();
        if ($user) {
            return view('admin.resetpassword', compact('user'));
        } else {
            return response()->json(['message' => 'Token is invalid'], 401);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = User::where([
            'email' => $request->email,
        ])
            ->first();

        if (!$updatePassword) {
            return response()->json(['status' => 'error', 'type' => 'login', 'msg' => 'Invalid Credential!']);
        }

        $user = User::where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
                'remember_token' => NULL
            ]);

        return redirect('/')->with('message', 'Your password has been changed!');
    }

}
