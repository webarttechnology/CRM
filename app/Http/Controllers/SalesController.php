<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientTrait;

class SalesController extends Controller
{
    use ClientTrait;
    public function showclientlist(Request $request){

        if($request -> method() == "POST"){

        }else{            
            return view("admin.client_list", ["data" => $this -> getClients()]);
        }
    }

    public function addclient(Request $request){
        if($request -> method() == "POST"){

        }else{ 
            
            return view("admin.add_client", ['closers'=> \App\Models\Closer::get(), 'agents'=> \App\Models\Agent::get(), 'countries'=> country()]);
        }
    }
}
