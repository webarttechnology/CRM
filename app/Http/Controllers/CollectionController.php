<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CollectionTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    use CollectionTrait;
    public function collectionlist(Request $request){
        if($request -> method() == "POST"){
            $startdate = $request -> input('start_date');
            $enddate = $request -> input('end_date');
            DB::disableQueryLog();
            $collection = \App\Models\Collection::select(['collections.id', 'clients.name as client_name', 'sales.project_name as project_name', 'collections.currency', 'collections.instalment', 'collections.net_amount', 'collections.sale_date', 'collections.payment_mode', 'collections.other_payment_mode'])
                                                ->join('clients', 'clients.id', '=', 'collections.client_id')
                                                ->join('sales', 'sales.id', '=', 'collections.sale_id')
                                                ->whereBetween('collections.sale_date', [$startdate, $enddate])
                                                ->orderBy('collections.id', 'DESC')
                                                ->get();

            $paymentMode = payment_mode();           
            return view("admin.collection.collection_list", ['data' => $collection, 'currency' => currency(), 'instalment' => instalment(), 'paymentmode' => $paymentMode]);
        
        }else{
            $data = $this -> getcollection();          
            $paymentMode = payment_mode();           
            return view("admin.collection.collection_list", ['data' => $data, 'currency' => currency(), 'instalment' => instalment(), 'paymentmode' => $paymentMode]);
        }

    }

    public function addcollection(Request $request){
        if($request -> method() == "POST"){

            $validator   =  Validator::make($request->all(), [
                'client_id' => 'required',
                'project_id' => 'required',
                'currency' => 'required',
                'instalment' => 'required',
                'net_amt' => 'required',
                'sale_date' => 'required',
                'payment_mode' => 'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
            }


            $collections = new \App\Models\Collection([
                'client_id' => $request -> input('client_id'),
                'sale_id' => $request -> input('project_id'),
                'currency' => $request -> input('currency'),
                'instalment' => $request -> input('instalment'),
                'net_amount' => $request -> input('net_amt'),
                'sale_date' => $request -> input('sale_date'),
                'payment_mode' => $request -> input('payment_mode'),
                'other_payment_mode' => $request -> input('other_payment_mode')
            ]);

            $collections -> save();


            $message = 'New collection has been added';
            $url = '/collection/list';
            $adminmessage = 'New collection has been added';
            sendCollectionNotification($collections, $message, $url, $adminmessage);

            $remark = 'Collections '.'('.$request->project_name.')'.' has been Added';

            LogHistoryAdd($request->client_id, $request->id, Auth::id(), $remark);

            return response()->json(['status' => 'success', 'type' => 'store', 'message' => 'Data has been added successfully.']);

        }else{
            return view("admin.collection.add_collection", ['clients' => \App\Models\Client::select(['name', 'id', 'client_code']) -> get()]);
        }
        
    }

    public function updatecollection(Request $request, $updateid = '')
    {
        if ($request->method() == "POST") {

            $validator   =  Validator::make($request->all(), [
                'client_id'     => 'required',
                'project_id'    => 'required',
                'currency'      => 'required',
                'instalment'    => 'required',
                'net_amt' => 'required',
                'sale_date' => 'required',
                'payment_mode' => 'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
            }

            $collections = \App\Models\Collection::find($request->input('update_id'));

            $originalData = $collections->getOriginal();

            $collections->fill([
                'client_id' => $request->input('client_id'),
                'sale_id' => $request->input('project_id'),
                'currency' => $request->input('currency'),
                'instalment' => $request->input('instalment'),
                'net_amount' => $request->input('net_amt'),
                'sale_date' => $request->input('sale_date'),
                'payment_mode' => $request->input('payment_mode'),
                'other_payment_mode' => $request->input('other_payment_mode')
            ]);

            if ($collections->isDirty()) {
                $updatedFields = $collections->getDirty();
                $excludedFields = ['start_date', 'end_date', 'total_time'];

                foreach ($updatedFields as $field => $value) {
                    if (!in_array($field, $excludedFields)) 
                    {
                                                $remark = "Field '$field' has been updated";
                        LogHistoryAdd($collections->client_id, $collections->sale_id, Auth::id(), $remark);
                    }
                }
            }

            $collections->save();

            $collections->save();
            $message = 'Update collection';
            $url = '/collection/list';
            $adminmessage = 'Update collection';
            sendCollectionNotification($collections, $message, $url, $adminmessage);

            return response()->json(['status' => 'success', 'type' => 'store', 'message' => 'Data has been updated successfully.']);

        } else {
            $data = $this->getCollectionById($updateid);
            $project = \App\Models\Sale::where(['client_id' => $data->client_id])->get();
            return view("admin.collection.update_collection", ['clients' => \App\Models\Client::select(['name', 'id', 'client_code'])->get(), 'data' => $data, 'project' => $project]);
        }
    }



    public function getproject(Request $request)
    {
        if($request -> ajax()){
            DB::disableQueryLog();
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

    public function deletecollection(Request $request, $deleteid){
        if(Auth::user() -> role_id == 1){
            $collections = \App\Models\Collection::find($deleteid);
            if($collections){
                $collections -> delete();

                $remark = 'Collections '.'('.$request->project_name.')'.' has been Deleted';

                LogHistoryAdd($request->client_id, $request->id, Auth::id(), $remark);

                return redirect() -> route('collection.list')->with('successmsg', "Data has been deleted successfully!!."); 
            }else{
                return redirect() -> route('collection.list')->with('errmsg', "Error!! Please try agian."); 
            }
        }else{
            return redirect() -> route('collection.list')->with('errmsg', "Permission denied. Can't remove the client details.");  
        }        
    }
}
