<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MakeupRequests;
use DB;
class MakeupRequestesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $id = auth()->user()->id;
        $this->validate($request, [
            'sec_id' => 'required',
            'room_id' => 'required',
            'day' => 'required',
            'slot_id' => 'required',
          ]);
          
          $teacherCourseId = DB::table('teacher_courses')
          ->join('teacher_infos','teacher_infos.teacher_info_id','=','teacher_courses.teacher_id')
          ->join('users',"teacher_infos.teacher_id",'=',"users.id")
          ->where('users.id','=',$id)
          ->where('sec_id','=',$request->input('sec_id'))
          ->get();
          $tId = $teacherCourseId[0]->teacher_course_id;

          $ss = DB::table('timetables')
          ->where('t_course_id',$tId)
          ->where('slot_id',$request->input('slot_id'))
          ->where('day',$request->input('day'))
          ->count();
            
          if($ss > 0){
            return back()->withError('This slot is already book');
          }


          
          $makeupRqst = new MakeupRequests;
          $makeupRqst->sec_id = $request->input('sec_id');
          $makeupRqst->room_id = $request->input('room_id');
          $makeupRqst->day = $request->input('day');
          $makeupRqst->slot_id = $request->input('slot_id');
          $makeupRqst->t_course_id = $tId;
          $makeupRqst->requested_teacher_id = $id;

          $makeupRqst->save();

          return back()->withSuccess('Request Has Been Send ');

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
}
