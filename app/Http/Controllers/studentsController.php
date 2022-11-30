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

class studentsController extends Controller
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


        $data['timetable'] = DB::table('timetables')
        ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
        ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
        ->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
        ->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
        ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
        ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
        ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
        // ->join('rooms','rooms.room_id' , '=' ,'timetables.room_id')
        // ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
        ->where('timetables.sec_id',$dd[0]->sec_id)
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

        $tt = DB::table('custom_timetables')
        ->where('student_id',$id)
        ->count();
        if($tt == 0){
          foreach($data['timetable'] as $x){
            $ct = new custom_timetable;
            $ct->timetable_id = $x->timetable_id;
            $ct->student_id = $id;
            $ct->save();
          }
        }
        

        return View('student.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'table' => 'required',
          ]);
          $std_id = auth()->user()->id;
          $checkId = DB::table('Students')
          ->where('s_id',$std_id)
          ->get();
  
          
          
          if(count($checkId) >= 1){
            $id = $checkId[0]->s_timetable_id;
            $table = student::find($id);
            $table->table = $request->input('table');
            $table->s_id = $std_id;
            $table->update();
          }else{
            $table = new student;
            $table->table = $request->input('table');
            $table->s_id = $std_id;
            $table->save();
          }
            // $dep->department_id;
            
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function showTable(){
        $data = DB::table('students')->get();
        return View('student.studenttable')->with('data',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->validate($request, [
            'table' => 'required',
          ]);
            $std_id = auth()->user()->id;
            $table =student::find($id);
            $table->table = $request->input('table');
            $table->s_id = $std_id;
            $table->save();
            // $dep->department_id;
            
            return View('student.');
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
        $this->validate($request, [
            'table' => 'required',
          ]);
            $std_id = auth()->user()->id;
            $table =student::find($id);
            $table->table = $request->input('table');
            $table->s_id = $std_id;
            $table->save();
            // $dep->department_id;
            
            return back();
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
