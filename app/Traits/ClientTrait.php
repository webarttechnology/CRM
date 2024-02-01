<?php 

    namespace App\Traits;

    trait ClientTrait{
        
        public function getClients($conditionArray=[]){
            if($conditionArray){
                \DB::disableQueryLog();
                return \App\Models\Client::where($conditionArray)->get();
            }else{
                \DB::disableQueryLog();
                return \App\Models\Client::select(['clients.id', 'clients.client_code', 'clients.name', 'closer_name', 'agent_name', 'clients.email', 'clients.address', 'clients.created_at'])->get();
            }
            
        }


        public function getClientById($id){
            \DB::disableQueryLog();
            return \App\Models\Client::where(['id' => $id])->first();           
        }



    }

?>