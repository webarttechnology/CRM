<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientTrait;
use App\Models\Closer;
use App\Models\Agent;
// use Closer;
use Auth;

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

    public function newsaleslist(Request $request){
        if($request->method() == "POST"){

        }else{
            return view("admin.new_sale_list", ["data" => $this -> getClients()]);
        }
    }

    public function addnewsaleslist(Request $request){
        if($request->method() == "POST"){ 

        }else{
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
            // echo "<pre/>";
            // print_r($project_type);die;
            return view("admin.new_sale_add", ["data" => $this -> getClients(),'project_type'=>$project_type,'closer'=>$closer,'agent'=>$agent]);
        }
    }
}
