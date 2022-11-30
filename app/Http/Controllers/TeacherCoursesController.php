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
use App\teacher_info;
use App\TeacherCourses;
class TeacherCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teacherCourse'] = DB::table('teacher_courses')
        ->join('teacher_infos' , 'teacher_infos.teacher_info_id' , '=' , 'teacher_courses.teacher_id')
        ->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->join('sections' , 'sections.section_id' , '=' , 'teacher_courses.sec_id')
        ->join('courses' , 'teacher_courses.course_id' , '=' , 'courses.course_id')
        ->join('programs' , 'courses.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id' )
        ->where('users.role_name','teacher')
        ->get();
        
        $data['labTec'] = DB::table('teacher_courses')
        ->join('teacher_infos' , 'teacher_infos.teacher_info_id' , '=' , 'teacher_courses.teacher_id')
        ->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->where('users.role_name','teacher')
        ->where('teacher_courses.lec_type','lab')
        ->get();
        // dd($data);
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        return view("teacherCourses.index")->with('data',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->lab_tec);
        $check = DB::table('teacher_courses')
        ->select('course_id', DB::raw('count(*) as total'))
        ->where('teacher_id','=',$request->input('teacher'))
        ->groupBy('course_id')  
        ->get();
        // echo "<pre/>";
        $count = count($check);
        foreach($check as $cc){
            if($cc->course_id == $request->input('courses'))
             --$count;
        }
       
        $checkV = DB::table('teacher_courses')
        ->where('teacher_id',$request->input('teacher'))
        ->where('sec_id' , $request->input('section'))
        ->where('lec_type' , 'regular')
        ->count(); 

        $checkVv = DB::table('teacher_courses')
        ->where('sec_id',$request->input('section'))
        ->where('course_id' , $request->input('courses'))
        ->groupBy('course_id')  
        ->count();

        // if($count > 1)
        //     return back()->withError('This Teacher Has Already Been Assigned Two Courses');
        if($checkV > 0)
            return back()->withError('This Teacher Has Been Already Assigned to This Section');
        if($checkVv > 0)
            return back()->withError('This Course Has Already Been Assigned to This Section');

        $this->validate($request, [
                'section' => 'required',
                'teacher' => 'required',
                'courses' => 'required',
              ]);

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');

        //   $course = Courses::find($request->input('courses'));
        //    if($course->lab == 'yes'){
            //    $lec = '2';
        //    }else{
        //        $lec = '2';
        //    } 

        if($request->lab_tec == null){
            $teacherCourse = new TeacherCourses;
            $teacherCourse->sec_id = $request->input('section');
            $teacherCourse->teacher_id = $request->input('teacher');
            $teacherCourse->course_id = $request->input('courses');
            $teacherCourse->no_lectures = '2';
            $teacherCourse->lec_type = 'regular';
            $teacherCourse->save();
        }else{
            $teacherCourse = new TeacherCourses;
            $teacherCourse->sec_id = $request->input('section');
            $teacherCourse->teacher_id = $request->input('teacher');
            $teacherCourse->course_id = $request->input('courses');
            $teacherCourse->no_lectures = '2';
            $teacherCourse->lec_type = 'regular';
            $teacherCourse->save();

            $teacherCou = new TeacherCourses;
            $teacherCou->sec_id = $request->input('section');
            $teacherCou->teacher_id = $request->input('lab_tec');
            $teacherCou->course_id = $request->input('courses');
            $teacherCou->no_lectures = '2';
            $teacherCou->lec_type = 'lab';
            $teacherCou->save();
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
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['teacherCourse'] = DB::table('teacher_courses')
        ->join('teacher_infos' , 'teacher_infos.teacher_info_id' , '=' , 'teacher_courses.teacher_id')
        ->join('users' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->join('sections' , 'sections.section_id' , '=' , 'teacher_courses.sec_id')
        ->join('courses' , 'teacher_courses.course_id' , '=' , 'courses.course_id')
        ->join('programs' , 'courses.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id' )
        ->where('users.role_name','teacher')
        ->where('teacher_course_id' , '=' , $id)
        ->get();
        
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        $data['prg'] = Programs::all();
        $data['sec'] = Sections::all();
        $data['course'] = Courses::all();
        $data['teacher'] = DB::table('users')
        ->join('teacher_infos' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->join('departments' , 'teacher_infos.dep_id' , '=' , 'departments.department_id')
        ->where('users.role_name','teacher')
        ->get();
        
        return view("teacherCourses.update")->with('data',$data);
    }

    public function checkDepartment(Request $request)
    {
        $id = $request->id;

        $data['dep'] = DB::table('programs')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->where('departments.department_id',$id)
        ->get();
        // return  $data['dep'];
        $output = '<label>Programs </label><select class="form-control" name="program" id="program"><option>Select Program</option>';
        foreach($data['dep'] as $x){
            $output .= '<option value="'.$x->program_id.'">'.$x->prg_name.'</option>';
        }
        $output .= '</select>';
        return $output;
        // return response()->json(['data'=>$data['dep']]);
        
    }


    public function checklab(request $request)
    {
        $id = $request->id;

        $dd = DB::table('courses')
        ->where('course_id',$id)
        ->get();
        $output = '';
        if($dd[0]->lab == 'yes'){
            $data['tec'] = DB::table('teacher_infos')
            ->join('users' , 'users.id' , '=' , 'teacher_infos.teacher_id')
            ->get();

            $output .= '<label> Lab Teacher </label>
            <select class="form-control" id="lab_tec" name="lab_tec">
            <option>Select Course </option>';
            foreach($data['tec'] as $x){
                $output .= '<option value="'.$x->teacher_info_id.'">'.$x->name.'</option>';
            }
            $output .= '</select><br>';
        }

        return $output;
    }



    public function checkProgram(Request $request)
    {
        $dep_id = $request->dep_id;
        $prg_id = $request->prg_id;
        $sem_id = $request->sem_id;

        $data['sec'] = DB::table('sections')
        ->join('programs' , 'programs.program_id' , '=' , 'sections.prg_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->where('departments.department_id',$dep_id)
        ->where('programs.program_id',$prg_id)
        ->where('sections.semester',$sem_id)
        ->get();


        $data['courses'] = DB::table('courses')
        ->join('programs' , 'programs.program_id' , '=' , 'courses.prg_id')
        ->where('programs.program_id',$prg_id)
        ->where('courses.semester',$sem_id)
        ->get();
        
        
        $data['tec'] = DB::table('teacher_infos')
        ->join('users' , 'users.id' , '=' , 'teacher_infos.teacher_id')
        ->where('teacher_infos.dep_id',$dep_id)
        ->get();

        $output = '<label>Sections </label><select class="form-control" name="section" ><option>Select Section</option>';
        foreach($data['sec'] as $x){
            $output .= '<option value="'.$x->section_id.'">'.$x->sec_name.'</option>';
        }
        $output .= '</select><br>';

        // return  $data['dep'];
        $output .= '<label> Courses </label>
        <select class="form-control" id="cou" name="courses">
        <option>Select Course </option>';
        foreach($data['courses'] as $x){
            $output .= '<option value="'.$x->course_id.'" >'.$x->course_name.'</option>';
        }
        $output .= '</select><br>';
        
        $output .= '<label> Teachers </label><select class="form-control" name="teacher" ><option>Select Teacher </option>';

        foreach($data['tec'] as $x){
            $output .= '<option value="'.$x->teacher_info_id.'">'.$x->name.'</option>';
        }
        $output .= '</select>';
        return $output;
        // return response()->json(['data'=>$data['dep']]);
        
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
        $check = DB::table('teacher_courses')
        ->select('course_id', DB::raw('count(*) as total'))
        ->where('teacher_id','=',$request->input('teacher'))
        ->where('teacher_course_id','!=',$id)
        ->groupBy('course_id')  
        ->get();

        $checkV = DB::table('teacher_courses')
        ->where('teacher_id',$request->input('teacher'))
        ->where('sec_id' , $request->input('section'))
        ->where('teacher_course_id','!=',$id)
        ->count(); 

        $checkVv = DB::table('teacher_courses')
        ->where('sec_id',$request->input('section'))
        ->where('course_id' , $request->input('courses'))
        ->where('teacher_course_id','!=',$id)
        ->groupBy('course_id')  
        ->count();

        if(count($check) > 2)
            return back()->withError('This Teacher Has Already Been Assigned Two Courses');
        if($checkV > 0)
            return back()->withError('This Teacher Has Already Been Assigned This Course to This Section');
        if($checkVv > 0)
            return back()->withError('This Teacher Has Already Been Assigned to This Section');

        $this->validate($request, [
                'section' => 'required',
                'teacher' => 'required',
                'courses' => 'required',
              ]);

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');


            $course = Courses::find($request->input('courses'));
            if($course->lab == 'yes'){
                $lec = '4';
            }else{
                $lec = '2';
            } 
          $teacherCourse =TeacherCourses::find($id);
          $teacherCourse->sec_id = $request->input('section');
          $teacherCourse->teacher_id = $request->input('teacher');
          $teacherCourse->course_id = $request->input('courses');
          $teacherCourse->no_lectures = $lec;
          $teacherCourse->save();
          return redirect()->route('teacherCourses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t = TeacherCourses::find($id);
        // dd($teacherCourse);
        $dd = DB::table('teacher_courses')
        ->where('course_id',$t->course_id)
        ->where('sec_id',$t->sec_id)
        ->where('lec_type','lab')
        ->get();
        if(count($dd) > 0){
           $tt = TeacherCourses::find($dd[0]->teacher_course_id);
           $tt->delete();
        }

        $t->delete();
        return back();
    }
}
