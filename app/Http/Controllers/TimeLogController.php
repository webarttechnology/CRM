<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\TimeLog;
use App\Models\Workhistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function clockin_break_clockout(Request $request)
    {

        // dd($request->all());

        $lastrecord  = TimeLog::whereDate('created_at', date('Y-m-d'))->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        $workHistory = Workhistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        if($lastrecord){


            if($lastrecord->type == 'work'){

                // PERFECT AS HELL
                if($request->type != 'continue' && $request->type != 'clockout'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "stop",
                    ]);
    
                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'break',
                        'status'        => "start",
                    ]);

                }

                // PERFECT AS HELL
                if($request->type == 'continue'){

                    if( $lastrecord->status != 'end' )
                    {
                        TimeLog::create([
                            'user_id'       => Auth::id(),
                            'start_time'    => null,
                            'timer_data'    => null,
                            'type'          => 'break',
                            'status'        => "stop",
                        ]);
                    }

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "start",
                    ]);

                    User::where('id', Auth::id())->update(['user_status' => 'Online']);

                }

                // PERFECT BUT NOT AS HELL
                if($request->type == 'clockout'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "end",
                    ]);

                    User::where('id', Auth::id())->update(['user_status' => 'Offline']);

                }


                if($request->type == 'break' || $request->type == 'clockout'){

                    if($workHistory){
                        if($workHistory->final_status == 'start'){
                            Workhistory::create(
                                [
                                    'developer_job_id' => $workHistory->developer_job_id,
                                    'user_id'          => Auth::user()->id,
                                    'final_status'     => 'stop',
                                    'currenttime'      => null, 
                                    'delayThen'        => 0
                                ]
                            );
                        }
                    }
                }

            }elseif($lastrecord->type == 'break'){

                // dd($request->type);

                // if($request->type != 'continue' && $request->type != 'clockout'){

                //     TimeLog::create([
                //         'user_id'       => Auth::id(),
                //         'start_time'    => null,
                //         'timer_data'    => null,
                //         'type'          => 'break',
                //         'status'        => "stop",
                //     ]);

                //     TimeLog::create([
                //         'user_id'       => Auth::id(),
                //         'start_time'    => null,
                //         'timer_data'    => null,
                //         'type'          => 'work',
                //         'status'        => "start",
                //     ]);
    

                // }

                if($request->type == 'continue'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'break',
                        'status'        => "stop",
                    ]);

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "start",
                    ]);

                    User::where('id', Auth::id())->update(['user_status' => 'Online']);
                    
                }

                if($request->type == 'clockout'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'break',
                        'status'        => "stop",
                    ]);

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "start",
                    ]);

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "end",
                    ]);

                    User::where('id', Auth::id())->update(['user_status' => 'Offline']);

                    if($workHistory){
                        if($workHistory->final_status == 'start'){
                            Workhistory::create(
                                [
                                    'developer_job_id' => $workHistory->developer_job_id,
                                    'user_id'          => Auth::user()->id,
                                    'final_status'     => 'stop',
                                    'currenttime'      => null, 
                                    'delayThen'        => 0
                                ]
                            );
                        }
                    }
                    
                }

            }

        }else{

             TimeLog::create([
                'user_id'       => Auth::id(),
                'start_time'    => null,
                'timer_data'    => null,
                'type'          => 'work',
                'status'        => "start",
            ]);

            User::where('id', Auth::id())->update(['user_status' => 'Online']);

        }


        return ClockBreakTime();

    }

    public function clockin_break_clockout_time(Request $request)
    {
        return ClockBreakTime();
    }

    public function check_previous_clockout(Request $request)
    {

        if(date("l") == 'Monday'){
            $date = date('Y-m-d', strtotime('-3 day'));
        }else{
            $date = date('Y-m-d', strtotime('-1 day'));
        }
       
        $previousclockin = TimeLog::where('user_id', Auth::id())->whereDate('created_at', $date)
        ->where('type', 'work')->where('status', 'start')->first();

        if($previousclockin){

            $previousclockout = TimeLog::where('user_id', Auth::id())->whereDate('created_at', $date)
            ->where('type', 'work')->orderBy('id', 'desc')->first();


            if($previousclockout->status != 'end'){
                 
                $clockin = $previousclockin->created_at->format('Y-m-d h:i:s');

                return response()->json(['status' => 'error', 'clockin' => $clockin, 'msg' => 'Please ClockOut Time Submit']);
            }
        }

        return response()->json(['status' => 'success', 'msg' => 'ok']);

    }


    public function previous_clockout_time_submit(Request $request)
    {

        $validator   =  Validator::make($request->all(), [
            'reason'            => 'required',
            'end_time'          => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'errors', 'message' => $validator->errors()->all()]);
        }

        $convertedTime = date('h:i:s A', strtotime($request->end_time));

        if(date("l") == 'Monday'){
            $end_time = date('Y-m-d', strtotime('-3 day')).' '.$convertedTime;
        }else{
            $end_time = date('Y-m-d', strtotime('-1 day')).' '.$convertedTime;
        }

        $workHistory = new TimeLog();
        $workHistory->user_id = Auth::user()->id;
        $workHistory->type = "work";
        $workHistory->status = "end";
        $workHistory->reason = $request->reason;
        $workHistory->created_at = date('Y-m-d H:i:s', strtotime($end_time));
        $workHistory->updated_at = date('Y-m-d H:i:s');
        $workHistory->save();

        return response()->json(['status' => 'success', 'type' => 'clockout', 'message' => 'Your previous time submit successfully']);

    }


    public function check_user_auth()
    {

       return  Auth::check();

    }
    

}
