<?php
if(!function_exists('currency')){
    function currency(){
        $p = [1=> "USD", 2=> "AUD", 3 => "GBP", 4 => "INR"];
        return $p;
    }
}

if(!function_exists('instalment')){
    function instalment(){
        $p = [1=> "1st Installment", 2=> "2nd Installment", 3 => "3rd Installment", 4 => "4th Installment", 5=> "5th Installment", 6 => "Final Peyment"];
        return $p;
    }
}

if(!function_exists('project_type')){
    function project_type(){
        $p_type = array ("1" => "Websites", "2" => "Digital Marketing", "3" => "Mobile Applications", "4" => "Customised Platforms",
                         "5" => "Videos and Graphics", "6" => "UI/UX (psd and figma screens)", "7" => "Hosting",
                         "8" => "SSL", "9" => "Website Maintenance"
          );
          return $p_type;
    }
}

if(!function_exists('upsale_type')){
    function upsale_type(){
        $p_type = array ("1" => "Hosting", "2" => "SSL", "3" => "Website Maintenance", "4" => "Others");
          return $p_type;
    }
}


if(!function_exists('website_technology')){
    function website_technology(){
        $web_technology = array ( "1" => "Wordpress", "2"=>"Custom Php","3"=>"Laravel","4"=>"React / Node");
          return $web_technology;
    }
}

if(!function_exists('website_technology_type')){
    function website_technology_type(){
        $technology_type = array ( "1" => "Basic informative (5/6 pages, Contact form)", "2"=>"Advanced Informative ( 15+ pages, appointment, enquiry)","3"=>"Basic ECommerce ( guest checkout, 5/6 category, 1 payment gateway)","4"=>"Advanced E-commerce ( buyer account, order history, wish list, coupon codes)","5"=>"Custom Requirements");
          return $technology_type;
    }
}

if(!function_exists('mobile_application')){
    function mobile_application(){
        $mobile = array ( "1" => "Andriod", "2"=>"iOS","3"=>"Andriod + iOS");
          return $mobile;
    }
}

if(!function_exists('mobile_application_preferred')){
    function mobile_application_preferred(){
        $mobile_preferred = array ( "1" => "React Native", "2"=>"Flutter");
          return $mobile_preferred;
    }
}

if(!function_exists('ui_reference_site')){
    function ui_reference_site(){
        $reference_site = array ( "1" => "multiple", "2"=>"separate by comma");
          return $reference_site;
    }
}

if(!function_exists('payment_mode')){ 
    function payment_mode(){
        $payment = array ( "1" => "Payoneer", "2"=>"Stripe","3"=>"Wise","4"=>"RazorPay","5"=>"Google Pay","6"=>"Other");
          return $payment;
    }
}

if(!function_exists('country')){
    function country(){
        $cars = array (
            array("name"=>"AUS", "image"=>"assets/uploads/australia.png", "id"=>"AUS", 'code' => "+61"),
            array("name"=>"Canada", "image"=>"assets/uploads/India.png", "id"=>"Canada", 'code' => "+1"), 
            array("name"=>"INDIA", "image"=>"assets/uploads/India.png", "id"=>"INDIA", 'code' => "+91"),
            array("name"=>"UK", "image"=>"assets/uploads/uk.png", "id"=>"UK", 'code' => "+44"),
            array("name"=>"USA", "image"=>"assets/uploads/usa.jpg", "id"=>"USA", 'code' => "+1"),
          );
          return $cars;
    }
}


?>