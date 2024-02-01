<?php
    namespace App\Traits;
    use Auth;
    use DB;
    trait CollectionTrait{
        public function getcollection(){
            \DB::disableQueryLog();
            $collection = \App\Models\Collection::select(['collections.id', 'clients.name as client_name', 'sales.project_name as project_name', 'collections.currency', 'collections.instalment', 'collections.net_amount', 'collections.sale_date', 'collections.payment_mode', 'collections.other_payment_mode'])
                                                ->join('clients', 'clients.id', '=', 'collections.client_id')
                                                ->join('sales', 'sales.id', '=', 'collections.sale_id')
                                                ->when(Auth::user()->role_id == 3, function ($query) {
                                                    $query->whereExists(function ($subquery) {
                                                        $subquery->select(DB::raw(1))
                                                            ->from('tasks')
                                                            ->whereColumn('tasks.sale_id', 'collections.sale_id')
                                                            ->where('tasks.assign_to', Auth::user()->id);
                                                    });
                                                })
                                                ->orderBy('collections.id', 'DESC')
                                                ->get();
            return $collection;
        }

        public function getCollectionById($id){
            \DB::disableQueryLog();
            return \App\Models\Collection::where(['id' => $id]) -> first();
        }

        public function getLatestCollection(){
            \DB::disableQueryLog();
            $collection = \App\Models\Collection::select(['collections.id', 'clients.name as client_name', 'sales.project_name as project_name', 'collections.currency', 'collections.instalment', 'collections.net_amount', 'collections.sale_date', 'collections.payment_mode', 'collections.other_payment_mode'])
            ->join('clients', 'clients.id', '=', 'collections.client_id')
            ->join('sales', 'sales.id', '=', 'collections.sale_id')
            ->orderBy('id', 'DESC')
            ->where('instalment', '<>', 1)
            ->take(10)
            ->get();
            return $collection;
        }
    }
?>