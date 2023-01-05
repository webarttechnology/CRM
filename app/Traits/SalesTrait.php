<?php
    namespace App\Traits;

    trait SalesTrait{

        public function saleslists(){
            $sales = \App\Models\Sale::select(['sales.id', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date'])
                                       ->join('clients', 'clients.id', '=', 'sales.client_id')
                                       ->orderBy('sales.id', 'DESC')
                                       ->get();
            return $sales;
        }

        public function getSalesById($id){
            $sales = \App\Models\Sale::where(['id'=> $id])->first();
            return $sales;
        }

        public function getLatestSales(){
            $sales = \App\Models\Sale::select(['sales.id', 'clients.name as client_name', 'sales.project_name', 'sales.project_type', 'sales.closer_name', 'sales.gross_amount', 'sales.net_amount', 'sales.sale_date', 'sales.agent_name'])
                                      ->join('clients', 'clients.id', '=', 'sales.client_id')
                                      ->orderBy("id", "DESC")
                                      ->take(10)
                                      ->get();
            return $sales;
            
        }
    }

?>