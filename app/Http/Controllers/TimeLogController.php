<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // dd($request->all());
        // $timeLog = TimeLog::create($request->all());
        $userId = Auth::id();

        $startTime =  Carbon::parse($request->input('start_time'));
        $startTime->setTimezone('Asia/Kolkata');
        $stopTime = date('Y-m-d H:i:s', strtotime($request->input('stop_time')));
        $date = Carbon::now();

        if ($request->input('type') === "break" && $request->input('work_status') === "start") {
            $timeLog = TimeLog::create([
                'user_id' => $userId,
                'start_time' =>  $startTime->format('H:i:s'),
                'timer_data' =>   $request->input('start_timer_data'),
                'type' => "work",
                'status' => "stop",
            ]);
        }

        if ($request->input('type') === "break" && $request->input('work_status') === "stop") {
            $timeLog = TimeLog::create([
                'user_id' => $userId,
                'start_time' =>  $startTime->format('H:i:s'),
                'timer_data' =>   $request->input('break_timer_data'),
                'type' =>  $request->input('type'),
                'status' =>  $request->input('work_status'),
            ]);
        }

        if ($request->input('type') === "break" && $request->input('work_status') === "start") {
            $timeLog = TimeLog::create([
                'user_id' => $userId,
                'start_time' =>  $startTime->format('H:i:s'),
                'timer_data' =>   $request->input('break_timer_data'),
                'type' =>  $request->input('type'),
                'status' =>  $request->input('work_status'),
            ]);
        } elseif($request->input('type') !== "break" || $request->input('work_status') !== "stop") {
            $timeLog = TimeLog::create([
                'user_id' => $userId,
                'start_time' =>  $startTime->format('H:i:s'),
                'timer_data' =>   $request->input('start_timer_data'),
                'type' => $request->input('type'),
                'status' => $request->input('work_status'),
                // 'stop_time' => $stopTime,
                // 'break_hours' => $request->input('break_hours'),
                // 'current_date' =>  Carbon::parse($date)->toDateString(),
            ]);
        }

        return response()->json($timeLog, 201);
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

        $lastrecord = TimeLog::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();

        if($lastrecord){

            if($lastrecord->type == 'work'){

            
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


                if($request->type == 'continue'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "start",
                    ]);

                }

                if($request->type == 'clockout'){

                    TimeLog::create([
                        'user_id'       => Auth::id(),
                        'start_time'    => null,
                        'timer_data'    => null,
                        'type'          => 'work',
                        'status'        => "end",
                    ]);

                }

            }elseif($lastrecord->type == 'break'){

                if($request->type != 'continue' && $request->type != 'clockout'){

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
                        'type'          => 'break',
                        'status'        => "stop",
                    ]);

                }

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
                        'status'        => "end",
                    ]);
                    
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
        }


        return ClockBreakTime();

    }

}
