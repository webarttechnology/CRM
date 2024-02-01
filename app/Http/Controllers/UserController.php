<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use \App\Models\User;
use App\Models\TimeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index(Request $request){
        $user = User::all()->except(1);
        $role = role(); 

        if($request -> method() == "POST"){
            $searchkey = $request -> input('search');
            DB::disableQueryLog();
            $user = User::select(['id', 'name', 'email', 'mobile_no', 'role_id', 'is_active', 'created_at'])
                                      ->where('users.name', 'like', '%'. $searchkey .'%') 
                                      ->orWhere('users.email', 'like', '%'. $searchkey .'%')
                                      ->get();

            return view("admin.employee.user_list", compact('user', 'role'));

        }else{   

            return view('admin.employee.user_list', compact('user', 'role'));
            
        }

    }

    public function add(Request $request){
        if($request ->method() == "POST"){

        
            $validator   =  Validator::make($request->all(), [
                'name'          => 'required|string',
                'email'         => 'required|email|unique:users',
                'role_id'       => 'required|in:2,3,4,5,6,7,8,9',
                'profile_image' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
                'password'      => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
            }


            if(isset($request->profile_image)){
                $file = $request->file('profile_image');
                $new_file = rand().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('admin/Employee');
                $file->move($destinationPath, $new_file);
                $image = url('/').'/admin/Employee/'.$new_file;
            }else{
                $image = null;
            }


            $user = new User([
                'name'      => $request->name,
                'email'     => $request->email,
                'mobile_no' => $request->mobile_no,
                'role_id'   => $request->role_id,
                'user_image'=> $image,
                'password'  => Hash::make($request->password)
           ]);

           if($user -> save()){
            return response()->json(['status' => 'success', 'type' => 'store', 'message' => 'Data has been added successfully.']);
           }else{
            return response()->json(['status' => 'error', 'message' => 'Data added error. Try again']);
           }

        }else{
            $role = role();
            $role = $role->except(1);
            return view('admin.employee.add_user', compact('role'));
        }
    }

    public function update(Request $request, $updateid=''){
        if($request ->method() == "POST"){

         
            $validator   =  Validator::make($request->all(), [
                'name'      => 'required|string',
                'email'     => 'required|email|unique:users,id,'.$request->input('update_id'),
                'role_id'   => 'required|in:1,2,3,4,5,6,7,8,9',
                'is_active' => 'required|in:0,1',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
            }

            if(isset($request->profile_image)){

                $validator   =  Validator::make($request->all(), [
                    'profile_image' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
                }

                $file = $request->file('profile_image');
                $new_file = rand().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('admin/Employee');
                $file->move($destinationPath, $new_file);
                $image = url('/').'/admin/Employee/'.$new_file;
            }else{
                $image = $request->old_image;
            }


            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'mobile_no' => $request->mobile_no,
                'role_id'   => $request->role_id,
                'user_image'=> $image,
                'is_active' => $request->is_active 
            ];

            User::where('id', $request->update_id)->update($data);

            $message = 'Your profile has been updated';
            $url = '/employee';
            $adminmessage = 'Your profile has been updated';
            sendEmployeeNotification($data, $message, $url, $adminmessage);

            return response()->json(['status' => 'success', 'type' => 'store', 'message' => 'Data has been updated successfully.']);

        }else{
            $role = role();
            $role = $role->except(1);
            $user = User::find($updateid);          
            return view('admin.employee.update_user', compact('user', 'role'));
        }
    }

    public function delete(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1 || Auth::user()->role_id == 9){
            DB::disableQueryLog();
            $users = \App\Models\User::find($deleteid);
            if($users){
                $users -> delete();
                return redirect() -> route('user.index')->with('successmsg', "Data has been deleted successfully!!."); 
            }else{
                return redirect() -> route('user.index')->with('errmsg', "Error!! Please try agian."); 
            }
        }else{
            return redirect() -> route('user.index')->with('errmsg', "Permission denied. Can't remove the client details.");  
        } 
    }


    public function time_log(Request $request, $id)
    {


       $form = $request->from;
       $to = $request->to;


       if($form && $to){

            $timelog = TimeLog::select(['id', 'type', 'status', 'created_at'])
            ->where('user_id', $id)
            ->orderBy('id', 'asc')
            ->orderBy('created_at', 'asc')
            ->whereBetween('created_at', [$form, $to])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

       }elseif($form){

            $timelog = TimeLog::select(['id', 'type', 'status', 'created_at'])
            ->where('user_id', $id)
            ->orderBy('id', 'asc')
            ->orderBy('created_at', 'asc')
            ->whereBetween('created_at', [$form, date('Y-m-d')])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

       }else{

        $timelog = TimeLog::select(['id', 'type', 'status', 'created_at'])
        ->where('user_id', $id)
        ->orderBy('id', 'asc')
        ->orderBy('created_at', 'asc')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

       }


        return view('admin.employee.time_log_list', compact('timelog'));

    }

}
