<?php

use App\Models\LogHistory;

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

if(!function_exists('role')){
    function role(){
        $role = collect(['1'=> "Admin", "2"=> "Accounts", "3" => "Project Manager", "4"=> "Sales", "5"=>"Devlopment Maneger", "6"=>"Developer","7"=>"Designer"]);
        return $role;
    }
}

if(!function_exists('assignto')){
    function assignto($taskid){
        $projectManager = \App\Models\Assign::select('users.name')
                                            ->join('users', 'users.id', '=', 'tasks.assign_to')
                                            ->where('tasks.sale_id', $taskid)
                                            ->first();
        return $projectManager?->name;
    }
}

if(!function_exists('getcommentstatus')){
    function getcommentstatus($id){
        $date = date('Y-m-d',  strtotime('-7 days'));
        $dateTime = $date.' 23:59:59';       
        $status = \App\Models\Comment::where('sale_id', $id)->where('date', '>', $dateTime);
        return $status->count();
    }
}

if(!function_exists('projectstatus')){
    function projectstatus(){
        $status = ['Active', 'Inactive', 'Hold', 'Delivery'];
        return $status;
    }
}


if(!function_exists('saleDueamountCalculation')){
    function saleDueamountCalculation($sales_id){
        $dueAmount = \App\Models\Collection::where(['sale_id'=> $sales_id])->sum('collections.net_amount');
        return $dueAmount;
    }
}

if(!function_exists('getTimeInterval')){
    function getTimeInterval(){
        $date1 = strtotime("2023-08-01 10:00:00");
        $date2 = strtotime("2023-08-02 10:00:00");
        $diff = abs($date2 - $date1);
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24)/(30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 -  $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/(60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
        return collect(['year'=> $years, 'months'=> $months, 'days'=> $days, 'hours' => $hours, 'minutes'=> $minutes]);
    }
}

if(!function_exists('getProjectStatus')){
    function getProjectStatus($status){
        $statusArray = collect(['New', 'Inprogress', 'Deactive', 'Hold']);
        return $statusArray[$status];
    }
}



function LogHistoryAdd($client_id, $sale_id, $user_id , $remark) {
    LogHistory::create(['client_id' => $client_id, 'sale_id' => $sale_id, 'user_id' => $user_id, 'remark' => $remark ]);
    return true;
}

?>