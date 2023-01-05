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
            $salesdata = $this -> getLatestSales();
            $upsalesdata = $this -> getLatestUpsales();
            $collections = $this -> getLatestCollection();
            $salesGrossAmount = \App\Models\Sale::whereMonth('sale_date', $month) ->sum('gross_amount');
            $salesNetAmount = \App\Models\Sale::whereMonth('sale_date', $month)->sum('net_amount');
            $upsaleGrossAmount = \App\Models\Upsale::whereMonth('sale_date', $month)->sum('gross_amount');
            $upsaleNetAmount = \App\Models\Upsale::whereMonth('sale_date', $month)->sum('net_amount');
            $collectionAmount = \App\Models\Collection::whereMonth('sale_date', $month) -> sum('net_amount');
          
          
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
                                 'collection' => $collectionAmount
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
}
