<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RenewalController extends Controller
{
    public function domainrenewallist(Request $request){
        \DB::disableQueryLog();
        $currentMonth = date('m');      
        $salesRenewal  = \App\Models\Sale::select(['clients.client_code', 'clients.email', 'clients.name', 'sales.project_name', 'sales.end_date', 'sales.project_type','sales.gross_amount', 'sales.net_amount'])
                                        ->join('clients', 'clients.id', '=', 'sales.client_id')
                                        ->whereIn('sales.project_type', ['2', '7', '8', '9'])->whereMonth('sales.end_date', $currentMonth)->get();
        
        
        $upsalesRenewal  = \App\Models\Upsale::select(['clients.client_code', 'clients.email', 'clients.name', 'sales.project_name', 'upsales.end_date', 'upsales.upsale_type','upsales.gross_amount', 'upsales.net_amount'])
                                            ->join('clients', 'clients.id', '=', 'upsales.client_id')
                                            ->join('sales', 'sales.id', '=', 'upsales.sale_id')
                                            ->whereIn('upsales.upsale_type', ['1', '2', '3'])->whereMonth('upsales.end_date', $currentMonth)->get();
        
              return view("admin.renewal_list", ['sales' => $salesRenewal, 'upsales'=> $upsalesRenewal, 'upsale_type' => upsale_type(), 'project_type' => project_type()]);
    }  
}
