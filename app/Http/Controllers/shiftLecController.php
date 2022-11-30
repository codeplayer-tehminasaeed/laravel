<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\shiftLec;
use App\timetable;
class shiftLecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('shift_lecs')
        ->join('timetables' , 'timetables.timetable_id' ,'shift_lecs.timetable_id')
        ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
        ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
        ->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
        ->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
        ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
        ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
        ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
        ->get();
        // dd($data);
        return view("shiftlec.index")->with('data',$data);
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
        $slot = explode(',',$request->slot_id);
        // dd($slot[1]);
        $id = auth()->user()->id;

        $lec = new shiftLec;
        $lec->timetable_id = $request->input('shiftSlot');
        $lec->shift_day = $request->input('day');
        $lec->shift_slot_id = $slot[0];
        $lec->shift_slot_no = $slot[1];
        $lec->teacher_id = $id;
        $lec->status = 'pending';
        
        $lec->save();
        return back()->withSuccess("Request Submit Successfully");
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


    public function shift(Request $request)
    {
        $d = DB::table("timetables")
        ->where('day',$request->shift_day)
        ->where('slot_id',$request->shift_slot_id)
        ->where('sec_id',$request->sec_id)
        ->count();

        if($d == 0){
            $x = timetable::find($request->timetable_id);
            $x->slot_id = $request->shift_slot_id;
            $x->day = $request->shift_day;
            $x->save();

            $a = shiftLec::find($request->shift_id);
            $a->status = 'approved';
            $a->save();
            return back()->withSuccess("Lecture Shifted");
        }else{
            $y = shiftLec::find($request->shift_id);
            $y->status = 'rejected';
            $y->save();
            return back()->withError("Lecture Not Shifted");
        }
        
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
