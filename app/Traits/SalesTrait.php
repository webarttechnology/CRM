<?php
    namespace App\Traits;
    use Auth;
    trait SalesTrait{

        public function saleslists($status=''){
            \DB::disableQueryLog();
            $sales = \App\Models\Sale::select(['sales.id', 'sales.status', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date'])
            ->join('clients', 'clients.id', '=', 'sales.client_id');
            if($status){
                $sales = $sales->where('sales.status', $status);
            }
            $sales = $sales->orderBy('sales.id', 'DESC')->get();                                      
                                      
            return $sales;
        }

        public function getSalesById($id){
            \DB::disableQueryLog();
            $sales = \App\Models\Sale::where(['id'=> $id])->first();
            return $sales;
        }

          public function getLatestSales(){
            \DB::disableQueryLog();
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                $sales = \App\Models\Sale::select(['sales.id', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date', 'sales.agent_name'])
                ->join('clients', 'clients.id', '=', 'sales.client_id')
                ->orderBy("id", "DESC")
                ->take(10)
                ->get();
            }else{
                $sales = \App\Models\Sale::select(['sales.id', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date', 'sales.agent_name'])
                ->join('clients', 'clients.id', '=', 'sales.client_id')
                ->join('tasks', 'tasks.sale_id', '=', 'sales.id')
                ->where('tasks.assign_to', Auth::user()->id)
                ->orderBy("id", "DESC")
                ->take(10)
                ->get();
            }
            
            return $sales;
            
        }
    }

?>