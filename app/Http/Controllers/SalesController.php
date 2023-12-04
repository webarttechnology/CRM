<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ClientTrait;
use App\Traits\SalesTrait;
use App\Models\Closer;
use App\Models\Agent;
use App\Models\User;
// use Closer;
use Auth;

class SalesController extends Controller
{
    use ClientTrait;
    use SalesTrait;
    public function showclientlist(Request $request){

        if($request -> method() == "POST"){
            $searchkey = $request -> input('search');
            \DB::disableQueryLog();
            $clients = \App\Models\Client::select(['clients.id', 'clients.client_code', 'clients.name', 'closer_name', 'agent_name', 'clients.email', 'clients.address', 'clients.created_at'])
                                      ->where('clients.name', 'like', '%'. $searchkey .'%') 
                                      ->orWhere('clients.client_code', 'like', '%'. $searchkey .'%') 
                                      ->orWhere('clients.email', 'like', '%'. $searchkey .'%')
                                      ->get();
            return view("admin.client.client_list", ["data" => $clients]);

        }else{            
            $result = $this -> getClients();          
            return view("admin.client.client_list", ["data" => $result]);
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
                'closer_name' => 'required',
                'remarks' => 'required'
            ]);
          \DB::disableQueryLog();
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
            return view("admin.client.add_client", ['closers'=> \App\Models\Closer::get(), 'agents'=> \App\Models\Agent::get(), 'countries'=> country()]);
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
            \DB::disableQueryLog();
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
            return view("admin.client.update_client", ['closers'=> \App\Models\Closer::get(), 'data' =>  $result, 'agents'=> \App\Models\Agent::get(), 'countries'=> country()]);
        }
    }
    public function deleteclient(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            \DB::disableQueryLog();
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
            \DB::disableQueryLog();
            $searchkey = $request -> input('search');
           
            $result = \App\Models\Sale::select(['sales.id', 'sales.status', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date', 'sales.status'])
                                        ->join('clients', 'clients.id', '=', 'sales.client_id')
                                        ->where('clients.name', 'like', '%' . $searchkey . '%')
                                        ->orWhere('sales.project_name', 'like', '%' . $searchkey . '%')
                                        ->orderBy('sales.sale_date', 'DESC')
                                        ->get();          
            $status =$request->get('status')?$request->get('status'):'';           
            return view("admin.sale.new_sale_list", ["data" => $result, 'projectType' => project_type(), 'status' => $status]);
        }else{
            $status =$request->get('status')?$request->get('status'):'';             
            return view("admin.sale.new_sale_list", ["data" => $this -> saleslists($status), 'projectType' => project_type(), 'status' => $status]);       
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
                'gross_amt' => 'required|numeric',
                'net_amt' => 'required|numeric',
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

            
            \DB::disableQueryLog();
            $sales = new \App\Models\Sale([
                'client_id' => $request -> input('client_id'),
                'project_name' => $request -> input('project_name'),
                'project_type' => $request -> input('project_type'),                
                'technology' => $request -> input('technology'),
                'type' => $request -> input('type'),
                'others'=> $others,
                'customer_requerment' => $request -> input('type') == 5?$request -> input('customer_requerment'):'',
                'marketing_plan' =>  $request -> input('project_type') == 2?$request -> input('digital_marketing'):'',
                'smo_on' =>  $request -> input('project_type') == 2?json_encode($request -> input('smo_platfrom')):'',
                'start_date' => $request -> input('start_date')!= "1970-01-01"?$request -> input('start_date'):null,
                'end_date' => $request -> input('end_date') != "1970-01-01"?$request -> input('end_date'):null,
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
                'currency' => $request->input('currency'),
                'sale_date' => $request -> input('sale_date'),
                'payment_mode' => $request -> input('payment_mode'),
                'other_pay' => $request -> input('other_pay')
            ]);

           $saleId = $sales -> save();          

           if($saleId){
                $collectionData = new \App\Models\Collection([
                    'client_id' => $request -> input('client_id'),
                    'sale_id' => $sales->id,
                    'currency' => $request -> input('currency'),
                    'instalment' => 1,
                    'net_amount' => $request -> input('net_amt'),
                    'sale_date' => $request -> input('sale_date'),
                    'payment_mode' => $request -> input('payment_mode'),
                    'other_payment_mode' => $request -> input('other_pay')
                ]);

                $collectionData -> save();                
           }

            return redirect() -> route('sales.new.list')->with('successmsg', 'Data has been added successfully.');

        }else{
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
         
            return view("admin.sale.new_sale_add", ["data" => $this -> getClients(),'project_type'=>$project_type,'closer'=>$closer,'agent'=>$agent,'countries'=> country()]);
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
                'gross_amt' => 'required|numeric',
                'net_amt' => 'required|numeric',
                'sale_date' => 'required|date',
                'payment_mode' => 'required',
                'status' => 'required',
                'currency' => 'required'
            ]);

            $others = '';
            if($request ->input('cus_project_description') != '' && $request -> input('project_type') == 4){
                $others = $request ->input('cus_project_description');
            }else if($request ->input('gra_project_description') != '' && $request -> input('project_type') == 5){
                $others = $request ->input('gra_project_description');
            }else if($request ->input('ui_project_description') != '' && $request -> input('project_type') == 6){
                $others = $request ->input('ui_project_description');
            }
            \DB::disableQueryLog();
            $sales = \App\Models\Sale::find($request -> input('update_id'));
           
            $sales ->fill([
                'client_id' => $request -> input('client_id'),
                'project_name' => $request -> input('project_name'),
                'project_type' => $request -> input('project_type'),                
                'technology' => $request -> input('technology'),
                'type' => $request -> input('type'),
                'others'=> $others,
                'customer_requerment' => $request -> input('type') == 5?$request -> input('customer_requerment'):'',
                'marketing_plan' =>  $request -> input('project_type') == 2?$request -> input('digital_marketing'):'',
                'smo_on' =>  $request -> input('project_type') == 2?json_encode($request -> input('smo_platfrom')):'',
                'start_date' => $request -> input('start_date')!= "1970-01-01"?$request -> input('start_date'):null,
                'end_date' => $request -> input('end_date') != "1970-01-01"?$request -> input('end_date'):null,
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
                'other_pay' => $request -> input('payment_mode') == 6?$request -> input('other_pay'):'',
                'status' => $request->input('status'),
                'currency' => $request->input('currency')
            ]);
            $sales -> save();


            $collection = \App\Models\Collection::where(['sale_id'=> $request -> input('update_id'), 'instalment'=>1])->update(
                [
                    'currency' => $request->input('currency'),
                    'net_amount' => $request->input('net_amt'),
                    'payment_mode' => $request->input('payment_mode'),
                    'other_payment_mode' => $request->input('other_payment_mode')
                ]);

            return redirect() -> route('sales.new.list')->with('successmsg', 'Data has been updated successfully.');
        }else{
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
         
            return view("admin.sale.new_sale_update", ["client" => $this -> getClients(), 'data' => $this -> getSalesById($updateid) ,'project_type'=>$project_type,'closer'=>$closer,'agent'=>$agent]);
        }
    }

    public function salesviewById(Request $request,$saleid =''){
            if($request->method() == "GET"){
                $closer = Closer::all();
                $agent =Agent::all();
                $project_type = project_type();
                $technology_type = website_technology_type();
                $technology = website_technology(); 
                $payment = payment_mode();
                $mobile = mobile_application();
                $t_preferred = mobile_application_preferred();
                $client = $this -> getClients();
                $data = $this -> getSalesById($saleid); 
                $comment = \App\Models\Comment::select('comments.message', 'users.name', 'comments.date')
                                                ->join('users', 'users.id', '=', 'comments.comment_by')
                                                ->join('sales', 'sales.id', '=', 'comments.sale_id')
                                                ->where('sales.id', $saleid)
                                                ->get();  
                                                
            

            return view("admin.sale.sales_view", compact('closer', 'agent', 'project_type', 'technology_type', 'technology', 'payment', 'mobile', 't_preferred', 'client', 'data', 'comment'));
            }
    }

    public function deletesales(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            \DB::disableQueryLog();
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

    public function assign(Request $request, $assignid=''){
        if($request -> method() == 'POST'){

            if(\App\Models\Assign::where('sale_id', $request -> input('update_id'))->count()){

                $assign = \App\Models\Assign::where('sale_id', $request -> input('update_id'))->first();              
                $assign -> fill([
                    'assign_to' => $request -> input('assign_to'),
                    'assign_by' => Auth::user()->id,
                    'assign_date' => date('Y-m-d')
                ]);

            }else{
                $assign = new \App\Models\Assign([
                    'sale_id' => $request -> input('update_id'),
                    'assign_to' => $request -> input('assign_to'),
                    'assign_by' => Auth::user()->id,
                    'assign_date' => date('Y-m-d')
                   ]);
            }

          

           if($assign -> save()){
            return redirect() -> route('sales.new.list')->with('successmsg', 'Task assign successfully.');
           }else{
            return redirect() -> route('sales.new.list')->with('errmsg', 'Task assign error. Please try again.');
           }          

        }else{
            $projectmanager = User::where('role_id', 3)->pluck('name', 'id'); 
            $closer = Closer::all();
            $agent =Agent::all();
            $project_type = project_type();
            $data = $this -> getSalesById($assignid);
            $client = $this -> getClients();
            return view('admin.task.assign_job', compact('projectmanager', 'closer', 'agent', 'project_type', 'data', 'client'));
        }
    }
}
