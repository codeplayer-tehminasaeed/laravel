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
use App\teacher_timetable;
class teacherController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$t = DB::table('timetables')
->where('type','makeup')
->get();

foreach($t as $x){
if(time()- strtotime($created_at = $x->created_at) > 86400){
$del = timetable::find($x->timetable_id);
$del->delete();
}

}





$id = auth()->user()->id;
// $user = DB::table('teacher_infos')
// ->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
// ->where('users.id' ,  '=' ,$id)
// ->get();
// $number = $user->contact;
// Nexmo::message()->send([
//     'to'   => $number,
//     'from' => '16105552344',
//     'text' => 'Its Your lecture time'
// ]);

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
->where('users.id',$id)
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



$data['sections'] = DB::table('teacher_courses')
->join('teacher_infos' , 'teacher_infos.teacher_info_id' , '=' , 'teacher_courses.teacher_id')
->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
->join('sections' , 'sections.section_id' , '=' , 'teacher_courses.sec_id')
->join('courses' , 'teacher_courses.course_id' , '=' , 'courses.course_id')
->join('programs' , 'courses.prg_id' , '=' , 'programs.program_id')
->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id' )
->where('users.role_name','teacher')
->where('users.id',$id)
->get();

$data['rooms'] = DB::table('teacher_infos')
->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
->join('rooms' , 'teacher_infos.dep_id' , '=' , 'rooms.block_id')
->join('departments' , 'teacher_infos.dep_id' , '=' ,'departments.department_id')
->where('users.id',$id)
->get();

$data['slot'] = DB::table('slots')->get();
$data['slotCount'] = DB::table('slots')->count();
// dd($data);

return View('teacher.index')->with('data',$data);
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return View('teacher.create');
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

$teacher_id = auth()->user()->id;
$checkId = DB::table('teacher_timetables')
->where('t_info_id',$teacher_id)
->get();



if(count($checkId) >= 1){
$id = $checkId[0]->t_timetable_id;
$table = teacher_timetable::find($id);
$table->table = $request->input('table');
$table->t_info_id = $teacher_id;
$table->update();
}else{
$table = new teacher_timetable;
$table->table = $request->input('table');
$table->t_info_id = $teacher_id;
$table->save();
// $dep->department_id;

}
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
//
}

public function showTable(){
$id = auth()->user()->id;
$data = DB::table('shift_lecs')
->join('timetables' , 'timetables.timetable_id' ,'shift_lecs.timetable_id')
->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
->join('programs','programs.program_id' , '=' ,'sections.prg_id')
->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
->where('shift_lecs.teacher_id',$id)
->get();
return View('teacher.request')->with('data',$data);
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{

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
$teacher_id = auth()->user()->id;
$table = teacher_timetable::find($id);
$table->table = $request->input('table');
$table->t_info_id = $teacher_id;
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
