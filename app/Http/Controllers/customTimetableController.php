<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Departments;
use App\Programs;
use App\Sections;
use App\User;
use App\Courses;
use App\teacherInfo;
use App\timetable;
use App\teacher_info;
use App\TeacherCourses;
use App\Student;
use App\custom_timetable;
class customTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $dd = DB::table('student_infos')
        ->where('student_id',$id)
        ->get();


        $data['timetable'] = DB::table('custom_timetables')
        ->join('timetables','custom_timetables.timetable_id','timetables.timetable_id')
        ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
        ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
        ->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
        ->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
        ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
        ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
        ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
        // ->join('rooms','rooms.room_id' , '=' ,'timetables.room_id')
        // ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
        ->where('custom_timetables.student_id',$id)
        ->get();

        $data['rooms'] = array();
        $data['labs'] = array();
        foreach($data['timetable'] as $key => $rooms){
          if($rooms->room_id == 0){
            $labs = DB::table('labs')
            ->join('departments','departments.department_id' , '=' ,'labs.block_id')
            ->where('lab_id',$rooms->lab_id)
            ->get();
            // dd($labs);
            $temArray = ['lab_id'=>$labs[0]->lab_id, 'lab_name'=>$labs[0]->lab_name, 'block_name'=>$labs[0]->block_name ];
            array_push($data['labs'],$temArray);
          }else{
            $room= DB::table('rooms')
            ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
            ->where('room_id',$rooms->room_id)
            ->get();
            $temp = ['room_id'=>$room[0]->room_id, 'room_no'=>$room[0]->room_no, 'block_name'=>$room[0]->block_name ];
            array_push($data['rooms'],$temp);
          }
          
        }





        if(count($data['timetable']) != 0){
          $sec_id = $data['timetable'][0]->sec_id;
        
        $data['std']= DB::table('student_infos')
        ->where('student_infos.sec_id',$sec_id)
        ->first();
      }
      
        $data['slot'] = DB::table('slots')->get();
        $data['slotCount'] = DB::table('slots')->count();

        $data['custom'] = DB::table('timetables')
        ->join('sections','timetables.sec_id','sections.section_id')
        ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
        ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
        ->get();
        $data['stdSemester'] = $dd;
        // dd($data);
        return View('student.studenttable')->with('data',$data);
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
    
    
    public function addCustom(Request $request)
    {   $id = auth()->user()->id;
        if($request->prevSub == 0){
            $add = new custom_timetable;
            $add->timetable_id = $request->newSub; 
            $add->student_id = $id; 
            $add->status = 'custom'; 
            $add->save();
        }else{
            $a = DB::table("custom_timetables")
            ->where('timetable_id',$request->prevSub)
            ->where('student_id',$id)
            ->get();
            $b =custom_timetable::find($a[0]->custom_timetable_id);
            $b->timetable_id = $request->newSub; 
            $b->student_id = $id; 
            $b->status = 'custom'; 
            $b->save();
            
        }
        return "done";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
