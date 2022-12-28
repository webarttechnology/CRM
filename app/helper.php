<?php
if(!function_exists('country')){
    function country(){
        $cantries = array (
            array("name"=>"AUS", "image"=>"assets/uploads/australia.png", "id"=>3, "code" => "+61"),
            array("name"=>"INDIA", "image"=>"assets/uploads/India.png", "id"=>4, "code" => "+91"),
            array("name"=>"UK", "image"=>"assets/uploads/uk.png", "id"=>2, "code" => "+44"),
            array("name"=>"USA", "image"=>"assets/uploads/usa.jpg", "id"=>1, "code" => "+1"),
          );
          return $cantries;
    }
}
?>