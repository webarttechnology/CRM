<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UpsaleTrait;
use Auth;
class UpsaleController extends Controller
{
    use UpsaleTrait;    
    public function upsalelist(Request $request){
        if($request -> method() == "POST"){
            $searchkey = $request -> input('search');
            $upsales = \App\Models\Upsale::select(['clients.name as client_name', 'sales.project_name as project_name', 'upsales.upsale_type', 'upsales.start_date', 'upsales.end_date', 'upsales.others', 'upsales.gross_amount', 'upsales.net_amount', 'upsales.payment_mode', 'upsales.other_payment_mode', 'upsales.id', 'upsales.sale_date'])
                                            ->join('clients', 'clients.id', '=', 'upsales.client_id')
                                            ->join('sales', 'sales.id', '=', 'upsales.sale_id')
                                            ->where('clients.name', 'like', '%'.$searchkey.'%')
                                            ->orWhere('sales.project_name', 'like', '%'.$searchkey.'%')
                                            ->orderBy('upsales.id', 'DESC')
                                            ->get();

            return view("admin.upsale_list", ['data' => $upsales, 'upsaleFor' => upsale_type()]);

        }else{
            $upsaleData = $this -> getUpsale();         
            return view("admin.upsale_list", ['data' => $upsaleData, 'upsaleFor' => upsale_type()]);
        }
    }

    public function addupsale(Request $request){
         if($request -> method() == "POST"){
            $request -> validate([
                'client_id' => 'required',
                'project_id' => 'required',
                'upsale_type' => 'required',
                'gross_amt' => 'required',
                'net_amt' => 'required',
                'sale_date' => 'required',
                'payment_mode' => 'required'
            ]);

            $startDate = null;
            $endDate = null;
            $other = "";
            if($request -> input('upsale_type') == 1 || $request -> input('upsale_type') == 2 || $request -> input('upsale_type') == 3){
                $startDate = $request -> input('start_date');
                $endDate = $request -> input('end_date');
            }else{
                $other = $request -> input('other');
            }

            $upsale = new \App\Models\Upsale([
                'client_id' => $request -> input('client_id'),
                'sale_id' => $request -> input('project_id'),
                'upsale_type' => $request -> input('upsale_type'),
                'gross_amount' => $request -> input('gross_amt'),
                'net_amount' => $request -> input('net_amt'),
                'sale_date' => $request -> input('sale_date'),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'others' => $other,
                'payment_mode' =>$request -> input('payment_mode'),
                'other_payment_mode' =>$request -> input('payment_mode') == 6?$request -> input('other_payment_mode'):'',
            ]);

            $upsale -> save();

            return redirect() -> route('upsale.list')->with('successmsg', "Data has been added successfully.");

        }else{         
            return view("admin.add_upsale", ['clients'=> \App\Models\Client::get()]);
        }
    }

    public function updateupsale(Request $request, $updateid = ''){
        if($request -> method() == "POST"){
            $request -> validate([
                'client_id' => 'required',
                'project_id' => 'required',
                'upsale_type' => 'required',
                'gross_amt' => 'required',
                'net_amt' => 'required',
                'sale_date' => 'required',
                'payment_mode' => 'required'
            ]);

            $startDate = null;
            $endDate = null;
            $other = "";
            if($request -> input('upsale_type') == 1 || $request -> input('upsale_type') == 2 || $request -> input('upsale_type') == 3){
                $startDate = $request -> input('start_date');
                $endDate = $request -> input('end_date');
            }else{
                $other = $request -> input('other');
            }

           

            $upsale = \App\Models\Upsale::find($request -> input('update_id'));

            $upsale -> fill([
                'client_id' => $request -> input('client_id'),
                'sale_id' => $request -> input('project_id'),
                'upsale_type' => $request -> input('upsale_type'),
                'gross_amount' => $request -> input('gross_amt'),
                'net_amount' => $request -> input('net_amt'),
                'sale_date' => $request -> input('sale_date'),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'others' => $other,
                'payment_mode' =>$request -> input('payment_mode'),
                'other_payment_mode' =>$request -> input('payment_mode') == 6?$request -> input('other_payment_mode'):'',
            ]);

            $upsale -> save();

            return redirect() -> route('upsale.list')->with('successmsg', "Data has been added successfully.");

        }else{
            $data = $this -> getUpsaleById($updateid);
            $project = \App\Models\Sale::select(['project_name', 'id'])->where(['client_id' => $data -> client_id])->get();         
            return view("admin.update_upsale", ['clients'=> \App\Models\Client::get(), 'data' => $data, 'project' => $project]);
        }
    }

    public function deleteupsale(Request $request, $deleteid){
        if($request -> method() == "GET"){        
            if(Auth::user() -> role_id == 1){
                $upsale = \App\Models\Upsale::find($deleteid);
                if($upsale){
                    $upsale -> delete();
                    return redirect() -> route('upsale.list')->with('successmsg', "Data has been deleted successfully!!."); 
                }else{
                    return redirect() -> route('upsale.list')->with('errmsg', "Error!! Please try agian."); 
                }
            }else{
                return redirect() -> route('upsale.list')->with('errmsg', "Permission denied. Can't remove the client details.");  
            }
        }
    }

    public function getproject(Request $request){
        if($request -> ajax()){
            $data = \App\Models\Sale::select(['id', 'project_name'])->where(['client_id'=>$request -> get('client_id')])->get();
            $options = '<option value="">Select</option>';
            foreach($data as $val){
                $options .= '<option value='.$val -> id.'>'.$val -> project_name.'</option>';
            }
            echo $options;

        }else{
            $options = '<option value="">Select</option>';          
            echo $options;
        }
    }
}
