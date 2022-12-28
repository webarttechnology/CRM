<?php 
    namespace App\Traits;

    trait ClientTrait{
        
        public function getClients($conditionArray=[]){
            if($conditionArray){
                return \App\Models\Client::where($conditionArray)->get();
            }else{
                return \App\Models\Client::get();
            }
            
        }
    }

?>