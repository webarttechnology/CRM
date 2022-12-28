<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    
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
            return view("home");
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
}
