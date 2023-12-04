<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Traits\SalesTrait;
use App\Traits\UpsaleTrait;
use App\Traits\CollectionTrait;
class AdminController extends Controller
{
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
            
            \DB::disableQueryLog();
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
            $request -> validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,id,'.$request->input('update_id'),
                'mobile_no' => 'required',
                'bio'=>'required'
            ]); 
        }else{
            $userDetails = \App\Models\User::find(Auth::user()->id);
            return view('admin.profile', compact('userDetails'));
        }
    }
}
