<?php
    namespace App\Traits;
    use Auth;
    use DB;
    trait UpsaleTrait{

        public function getUpsale(){
            \DB::disableQueryLog();
            $upsales = \App\Models\Upsale::select(['clients.name as client_name', 'sales.project_name as project_name', 'upsales.upsale_type', 'upsales.start_date', 'upsales.end_date', 'upsales.others', 'upsales.gross_amount', 'upsales.net_amount', 'upsales.payment_mode', 'upsales.other_payment_mode', 'upsales.id', 'upsales.sale_date'])
                                           ->join('clients', 'clients.id', '=', 'upsales.client_id')
                                            ->join('sales', 'sales.id', '=', 'upsales.sale_id')
                                            ->when(Auth::user()->role_id == 3, function ($query) {
                                                $query->whereExists(function ($subquery) {
                                                    $subquery->select(DB::raw(1))
                                                        ->from('tasks')
                                                        ->whereColumn('tasks.sale_id', 'upsales.sale_id')
                                                        ->where('tasks.assign_to', Auth::user()->id);
                                                });
                                            })
                                            ->orderBy('upsales.id', 'DESC')
                                           ->get();
            return $upsales;
        }

        public function getUpsaleById($upsaleId){
            \DB::disableQueryLog();
            $upsale = \App\Models\Upsale::where('id', $upsaleId)-> first();
            return $upsale;
        }

        public function getLatestUpsales(){
            \DB::disableQueryLog();
            $upsales = \App\Models\Upsale::select(['clients.name as client_name', 'sales.project_name as project_name', 'upsales.upsale_type', 'upsales.start_date', 'upsales.end_date', 'upsales.others', 'upsales.gross_amount', 'upsales.net_amount', 'upsales.payment_mode', 'upsales.other_payment_mode', 'upsales.id', 'upsales.sale_date'])
            ->join('clients', 'clients.id', '=', 'upsales.client_id')
             ->join('sales', 'sales.id', '=', 'upsales.sale_id')
             ->orderBy('id')
             ->take(10)
            ->get();
            return $upsales;
        }
    }
?>