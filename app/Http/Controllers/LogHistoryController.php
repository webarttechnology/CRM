<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class LogHistoryController extends Controller
{
    
    public function index(){

        $log = Client::orderBy('id', 'desc')->get();

        return view('admin.log.log_list', compact('log'));

    }

    public function details($id){

        $client = Client::find($id);
        
        return view('admin.log.log_list_details', compact('client'));

    }

    

}
