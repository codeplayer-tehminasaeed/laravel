<?php

namespace App\Http\Controllers;
use DB;
use App\Departments;
use App\Programs;
use App\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses['courses'] = DB::table('courses')
        ->join('programs' , 'courses.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->get();
        $courses['programs'] = DB::table('programs')->select('program_id','prg_name')->get()->pluck('prg_name', 'program_id');
        return view("courses.index")->with('courses',$courses);
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
        $xx = DB::table('courses')
        ->where('course_code',$request->input('course_code'))
        ->where('semester',$request->input('semester'))
        ->where('prg_id',$request->input('program'))
        ->count();

        $check = DB::table('courses')
        ->where('course_name',$request->input('course_name'))
        ->where('semester',$request->input('semester'))
        ->where('prg_id',$request->input('program'))
        ->count();

           
        $this->validate($request, [
            'course_name' => 'required|regex:/^[a-zA-Z ]+$/u',
            // 'course_code' => 'required',
            'semester' => 'required',
            'program' => 'required',
            'credit_hours' => 'required',
          ]);
          
        if($check > 0)
            return back()->withError('This Course code Already Exist in this Program ');

        if($check > 0)
            return back()->withError('Already Exist ');

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('credit_hours') == 'select')
            return back()->withError('Select Credit Hours');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');
            
          $courses = new Courses;
          $courses->course_name = $request->input('course_name');
          $courses->course_code = $request->input('course_code');
          $courses->semester = $request->input('semester');
          $courses->credit_hours = $request->input('credit_hours');
          $courses->lab = $request->input('lab');
          $courses->prg_id = $request->input('program');

          $courses->save();
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
        
        $check = DB::table('courses')->where('course_name',$request->input('course_name'))
        ->where('semester',$request->input('semester'))
        ->where('prg_id',$request->input('program'))
        ->where('course_id','!=',$id)
        ->count();;

       
        $this->validate($request, [
            'course_name' => 'required|regex:/^[a-zA-Z ]+$/u',
            // 'course_code' => 'required|unique:courses,course_code,'.$id.',course_id',
            'semester' => 'required',
            'program' => 'required',
            'credit_hours' => 'required',
          ]);
        if($check > 0)
            return back()->withError('Already Exist ');

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');
            
        if($request->input('credit_hours') == 'select')
            return back()->withError('Select Credit Hours');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');


          $courses = Courses::find($id);
          $courses->course_name = $request->input('course_name');
          $courses->course_code = $request->input('course_code');
          $courses->semester = $request->input('semester');
          $courses->credit_hours = $request->input('credit_hours');
          $courses->lab = $request->input('lab');
          $courses->prg_id = $request->input('program');

          $courses->save();
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
       
        $courses = Courses::find($id);
        $courses->delete();
        return back();
    }
}
