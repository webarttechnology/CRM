<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientTrait;
use App\Traits\SalesTrait;
use App\Models\Closer;
use App\Models\Agent;
// use Closer;
use Auth;

class SalesController extends Controller
{
    use ClientTrait;
    use SalesTrait;
    public function showclientlist(Request $request){

        if($request -> method() == "POST"){

            $searchkey = $request -> input('search');
           
            $clients = \App\Models\Client::select(['clients.id', 'clients.client_code', 'clients.name', 'closer_name', 'agent_name', 'clients.email', 'clients.address', 'clients.created_at'])
                                      ->where('clients.name', 'like', '%'. $searchkey .'%') 
                                      ->orWhere('clients.client_code', 'like', '%'. $searchkey .'%') 
                                      ->orWhere('clients.email', 'like', '%'. $searchkey .'%')
                                      ->get();
            return view("admin.client_list", ["data" => $clients]);

        }else{            
            $result = $this -> getClients();          
            return view("admin.client_list", ["data" => $result]);
        }
    }

    public function addclient(Request $request){
        if($request -> method() == "POST"){        
            $request -> validate([
                'name' => 'required|string',
                'country_name' => 'required|string',
                'email' => 'required|email|unique:clients',
                'address' => 'required|string',
                'current_website' => 'nullable|url',
                'agent_name' => 'required',
                'agent_name' => 'required',
                'remarks' => 'required'
            ]);

           $client = new \App\Models\Client([
                'client_code' => rand(100000, 999999),
                'name' => $request -> input('name'),
                'country_name' => $request -> input('country_name'),
                'email' => $request -> input('email'),
                'address' => $request -> input('address'),
                'current_website' => $request -> input('current_website'),
                'agent_name' => $request -> input('agent_name'),
                'closer_name' => $request -> input('closer_name'),
                'remarks' => $request -> input('remarks')
           ]);

           $result = $client -> save();        
           if($result){
                $contactDetailsArray = [];
                $limit = count(array_filter($request -> input('alteremail')));            
                for($i =0; $i < $limit; $i++){
                    $contactDetailsArray[] = [
                        'client_id' => $client -> id,
                        'mobile_no' => $request -> input('mobile_no')[$i],
                        'email_id' => $request -> input('alteremail')[$i],
                    ];
                }
                if($limit){
                    $contactDetails = \App\Models\Contact_detail::insert($contactDetailsArray);
                }
           }

           return redirect() -> route('sales.client.list')->with('successmsg', "Data has been added successfully.");


        }else{             
            return view("admin.add_client", ['closers'=> \App\Models\Closer::get(), 'agents'=> \App\Models\Agent::get(), 'countries'=> country()]);
        }
    }

    public function updateclient(Request $request, $updateid = ''){
        if($request -> method() == "POST"){     
            $request -> validate([
                'name' => 'required|string',
                'country_name' => 'required|string',
                'email' => 'required|email|unique:clients,email,'.$request -> input('update_id'),
                'address' => 'required|string',
                'current_website' => 'nullable|url',
                'agent_name' => 'required',
                'closer_name' => 'required',
                'remarks' => 'required'
            ]);          

            $client = \App\Models\Client::find($request -> input('update_id'));

           $client->fill([
                'name' => $request -> input('name'),
                'country_name' => $request -> input('country_name'),
                'email' => $request -> input('email'),
                'address' => $request -> input('address'),
                'current_website' => $request -> input('current_website'),
                'agent_name' => $request -> input('agent_name'),
                'closer_name' => $request -> input('closer_name'),
                'remarks' => $request -> input('remarks')
           ]);

           $result = $client -> save();      
           \App\Models\Contact_detail::where(['client_id'=> $request ->input('update_id')])->delete();  
           if($result){
                $contactDetailsArray = [];
                $limit = count(array_filter($request -> input('alteremail')));            
                for($i =0; $i < $limit; $i++){
                    $contactDetailsArray[] = [
                        'client_id' => $client -> id,
                        'mobile_no' => $request -> input('mobile_no')[$i],
                        'email_id' => $request -> input('alteremail')[$i],
                    ];
                }
                if($limit){
                    $contactDetails = \App\Models\Contact_detail::insert($contactDetailsArray);
                }
           }

           return redirect() -> route('sales.client.list')->with('successmsg', "Data has been added successfully.");

        }else{ 
            $result = $this -> getClientById($updateid);                   
            return view("admin.update_client", ['closers'=> \App\Models\Closer::get(), 'data' =>  $result, 'agents'=> \App\Models\Agent::get(), 'countries'=> country()]);
        }
    }
    public function deleteclient(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            $client = \App\Models\Client::find($deleteid);
            if($client){
                $client -> delete();
                return redirect() -> route('sales.client.list')->with('successmsg', "Data has been deleted successfully!!."); 
            }else{
                return redirect() -> route('sales.client.list')->with('errmsg', "Error!! Please try agian."); 
            }
        }else{
            return redirect() -> route('sales.client.list')->with('errmsg', "Permission denied. Can't remove the client details.");  
        }
        
    }

    public function newsaleslist(Request $request){
        if($request->method() == "POST"){
            $searchkey = $request -> input('search');
            $result = \App\Models\Sale::select(['sales.id', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date'])
                                        ->join('clients', 'clients.id', '=', 'sales.client_id')
                                        ->where('clients.name', 'like', '%' . $searchkey . '%')
                                        ->orWhere('sales.project_name', 'like', '%' . $searchkey . '%')
                                        ->orderBy('sales.sale_date', 'DESC')
                                        ->get();
            
            return view("admin.new_sale_list", ["data" => $result, 'projectType' => project_type()]);

        }else{
            return view("admin.new_sale_list", ["data" => $this -> saleslists(), 'projectType' => project_type()]);
        }
    }

    public function addnewsaleslist(Request $request){
        if($request->method() == "POST"){ 
            
            $request -> validate([
                'client_id' => 'required|exists:clients,id',
                'project_name' => 'required',
                'project_type' => 'required',
                'closer_name' => 'required',
                'agent_name' => 'required',
                'business_name' => 'required',
                'remark' => 'required',
                'gross_amt' => 'required|integer',
                'net_amt' => 'required|integer',
                'sale_date' => 'required|date',
                'payment_mode' => 'required'
            ]);

            $others = '';
            if($request ->input('cus_project_description') != '' && $request -> input('project_type') == 4){
                $others = $request ->input('cus_project_description');
            }else if($request ->input('gra_project_description') != '' && $request -> input('project_type') == 5){
                $others = $request ->input('gra_project_description');
            }else if($request ->input('ui_project_description') != '' && $request -> input('project_type') == 6){
                $others = $request ->input('ui_project_description');
            }

            $sales = new \App\Models\Sale([
                'client_id' => $request -> input('client_id'),
                'project_name' => $request -> input('project_name'),
                'project_type' => $request -> input('project_type'),                
                'technology' => $request -> input('technology'),
                'type' => $request -> input('type'),
                'others'=> $others,
                'customer_requerment' => $request -> input('customer_requerment'),
                'marketing_plan' =>  $request -> input('project_type') == 2?$request -> input('digital_marketing'):'',
                'smo_on' =>  $request -> input('project_type') == 2?json_encode($request -> input('smo_platfrom')):'',
                'start_date' => $request -> input('start_date'),
                'end_date' => $request -> input('end_date'),
                'platform_name' => $request -> input('mobile_app_platform'),
                'prefer_technology' => $request -> input('preferred_technology'),
                'project_description' => $request -> input('project_description'),                
                'ui_project_description' => $request -> input('ui_project_description'),
                'business_name' => $request -> input('business_name'),
                'closer_name' => $request -> input('closer_name'),
                'agent_name' => $request -> input('agent_name'),
                'reference_sites' => $request -> input('reference_site'),
                'remarks' => $request -> input('remark'),
                'upsale_opportunities' => $request -> input('upsale'),                
                'gross_amount' => $request -> input('gross_amt'),
                'net_amount' => $request -> input('net_amt'),
                'due_amount' => $request -> input('gross_amt') - $request -> input('net_amt'),
                'sale_date' => $request -> input('sale_date'),
                'payment_mode' => $request -> input('payment_mode'),
                'other_pay' => $request -> input('other_pay')
            ]);

            $sales -> save();

            return redirect() -> route('sales.new.list')->with('successmsg', 'Data has been added successfully.');

        }else{
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
         
            return view("admin.new_sale_add", ["data" => $this -> getClients(),'project_type'=>$project_type,'closer'=>$closer,'agent'=>$agent]);
        }
    }

    public function updatenewsaleslist(Request $request, $updateid = ''){
        if($request->method() == "POST"){
          
            $request -> validate([
                'client_id' => 'required|exists:clients,id',
                'project_name' => 'required',
                'project_type' => 'required',
                'closer_name' => 'required',
                'agent_name' => 'required',
                'business_name' => 'required',
                'remark' => 'required',
                'gross_amt' => 'required|integer',
                'net_amt' => 'required|integer',
                'sale_date' => 'required|date',
                'payment_mode' => 'required'
            ]);

            $others = '';
            if($request ->input('cus_project_description') != '' && $request -> input('project_type') == 4){
                $others = $request ->input('cus_project_description');
            }else if($request ->input('gra_project_description') != '' && $request -> input('project_type') == 5){
                $others = $request ->input('gra_project_description');
            }else if($request ->input('ui_project_description') != '' && $request -> input('project_type') == 6){
                $others = $request ->input('ui_project_description');
            }

            $sales = \App\Models\Sale::find($request -> input('update_id'));
            $sales ->fill([
                'client_id' => $request -> input('client_id'),
                'project_name' => $request -> input('project_name'),
                'project_type' => $request -> input('project_type'),                
                'technology' => $request -> input('technology'),
                'type' => $request -> input('type'),
                'others'=> $others,
                'customer_requerment' => $request -> input('customer_requerment'),
                'marketing_plan' =>  $request -> input('project_type') == 2?$request -> input('digital_marketing'):'',
                'smo_on' =>  $request -> input('project_type') == 2?json_encode($request -> input('smo_platfrom')):'',
                'start_date' => $request -> input('start_date'),
                'end_date' => $request -> input('end_date'),
                'platform_name' => $request -> input('mobile_app_platform'),
                'prefer_technology' => $request -> input('preferred_technology'),
                'project_description' => $request -> input('project_description'), 
                'business_name' => $request -> input('business_name'),
                'closer_name' => $request -> input('closer_name'),
                'agent_name' => $request -> input('agent_name'),
                'reference_sites' => $request -> input('reference_site'),
                'remarks' => $request -> input('remark'),
                'upsale_opportunities' => $request -> input('upsale'),                
                'gross_amount' => $request -> input('gross_amt'),
                'net_amount' => $request -> input('net_amt'),
                'due_amount' => $request -> input('gross_amt') - $request -> input('net_amt'),
                'sale_date' => $request -> input('sale_date'),
                'payment_mode' => $request -> input('payment_mode'),
                'other_pay' => $request -> input('payment_mode') == 6?$request -> input('other_pay'):''
            ]);
            $sales -> save();
            return redirect() -> route('sales.new.list')->with('successmsg', 'Data has been updated successfully.');
        }else{
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
         
            return view("admin.new_sale_update", ["client" => $this -> getClients(), 'data' => $this -> getSalesById($updateid) ,'project_type'=>$project_type,'closer'=>$closer,'agent'=>$agent]);
        }
    }

    public function deletesales(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            $sales = \App\Models\Sale::find($deleteid);
            if($sales){
                $sales -> delete();
                return redirect() -> route('sales.new.list')->with('successmsg', "Data has been deleted successfully!!."); 
            }else{
                return redirect() -> route('sales.new.list')->with('errmsg', "Error!! Please try agian."); 
            }
        }else{
            return redirect() -> route('sales.new.list')->with('errmsg', "Permission denied. Can't remove the client details.");  
        }        
    }
}
