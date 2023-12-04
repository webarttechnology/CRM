<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Hash;
use Auth;
class UserController extends Controller
{
    
    public function index(Request $request){
        $user = User::all()->except(1);
        $role = role(); 
        if($request -> method() == "POST"){
            $searchkey = $request -> input('search');
            \DB::disableQueryLog();
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
            $request -> validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'role_id' => 'required|in:2,3,4,5,6,7',
                'password' => 'required'
            ]);

            $user = new User([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'mobile_no' => $request->post('mobile_no'),
                'role_id' => $request->post('role_id'),
                'password' =>  Hash::make($request->post('password'))
           ]);

           if($user -> save()){
            return redirect() -> route('user.index')->with('successmsg', "Data has been added successfully.");
           }else{
            return redirect() -> route('user.index')->with('errmsg', "Data added error. Try again");
           }

        }else{
            $role = role();
            $role = $role->except(1);
            return view('admin.employee.add_user', compact('role'));
        }
    }

    public function update(Request $request, $updateid=''){
        if($request ->method() == "POST"){
            $request -> validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,id,'.$request->input('update_id'),
                'role_id' => 'required|in:2,3,4',
                'is_active' => 'required|in:0,1',
            ]);          

            $user = User::find($request->input('update_id'));
            $user->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id'),
                'mobile_no' => $request->input('mobile_no'),
                'is_active' => $request->input('is_active')
            ]);

            $user-> save();
            return redirect() -> route('user.index')->with('successmsg', "Data has been updated successfully.");


        }else{
            $role = role();
            $role = $role->except(1);
            $user = User::find($updateid);          
            return view('admin.employee.update_user', compact('user', 'role'));
        }
    }

    public function delete(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            \DB::disableQueryLog();
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
}
