<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MakeupRequests;
use DB;
use \App\timetable;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  DB::table('makeup_requests')
        ->join('teacher_courses' , 'makeup_requests.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
        ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
        ->join('slots','makeup_requests.slot_id' , '=' ,'slots.slot_id') 
        ->join('sections','makeup_requests.sec_id' , '=' ,'sections.section_id')
        ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
        ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
        ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')->join('rooms','rooms.room_id' , '=' ,'makeup_requests.room_id')
        ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
        ->get();
    //    dd($data);
        return View('requests.index')->with('data',$data);
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
        $checkRoom = DB::table('timetables')
        ->where('timetables.slot_id','=',$request->input('slot_id')) 
        ->where('timetables.day','=',$request->input('day'))
        ->where('timetables.room_id','=',$request->input('room_id'))
        ->count();
        $i = 0;
        $room_id = $request->input('room_id');
        if($checkRoom>0){
            $freeRoom = DB::table('rooms')
            ->where('block_id',$request->dep_id)
            ->get();
            foreach($freeRoom as $x){
                $checkFreeRoom = DB::table('timetables')
                ->where('timetables.slot_id','=',$request->input('slot_id')) 
                ->where('timetables.day','=',$request->input('day'))
                ->where('timetables.room_id','=',$x->room_id)
                ->count();
                if($checkFreeRoom == 0){
                    $room_id = $x->room_id;
                    $i = 1;
                }
            }

            if($i == 0)
            return back()->withError("Room Not Available");
        }
        $checkcheckSec = DB::table('timetables')
        ->where('timetables.slot_id','=',$request->input('slot_id')) 
        ->where('timetables.day','=',$request->input('day'))
        ->where('timetables.sec_id','=',$request->input('sec_id'))
        ->count();
        if($checkcheckSec>0){
            return back()->withError("Class is not Available");            
        }
        $time = new timetable;
        $time->t_course_id = $request->input('t_course_id');
        $time->slot_id = $request->input('slot_id');
        $time->day = $request->input('day');
        $time->sec_id = $request->input('sec_id');
        $time->type = 'makeup';
        $time->room_id = $room_id;
        $time->lab_id = 0;
        $time->save();
        $rqst = MakeupRequests::find($request->input('makeup_request_id'));
        $rqst->delete();
        if($i==1)
        return back()->withSuccess("Makeup Lecture has Been Assigned in other room");
        else
        return back()->withSuccess("Makeup Lecture has Been Assigned");

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
        $rqst = MakeupRequests::find($id);
        $rqst->status = 'rejected';
        $rqst->update();
        return back();
        // $rqst->delete();
    }
}
