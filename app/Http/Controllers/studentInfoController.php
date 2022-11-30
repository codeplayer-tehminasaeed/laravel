<?php

namespace App\Http\Controllers;
use DB;
use App\Departments;
use App\Programs;
use App\Sections;
use App\User;
use App\student_info;
use Illuminate\Http\Request;

class studentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['student'] = DB::table('users')
        ->join('student_infos' , 'student_infos.student_id' , '=' , 'users.id')
        ->join('programs' , 'student_infos.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'student_infos.dep_id' , '=' , 'departments.department_id')
        ->join('sections' , 'student_infos.sec_id' , '=' , 'sections.section_id')
        ->where('users.role_name','student')
        ->get();
        
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        $data['prg'] = Programs::all();
        $data['sec'] = Sections::all();
        return view("studentInfo.index")->with('data',$data);

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


    public function checkProgram(Request $request)
    {
        $prg_id = $request->prg_id;
        $sem_id = $request->sem_id;
        $dep_id = $request->dep_id;

        $data['dep'] = DB::table('sections')
        ->join('programs' , 'programs.program_id' , '=' , 'sections.prg_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->where('departments.department_id',$dep_id)
        ->where('programs.program_id',$prg_id)
        ->where('sections.semester',$sem_id)
        ->get();
        // return  $data['dep'];
        $output = '<label>Sections </label><select class="form-control" name="section" ><option>Select Section</option>';
        foreach($data['dep'] as $x){
            $output .= '<option value="'.$x->section_id.'">'.$x->sec_name.'</option>';
        }
        $output .= '</select>';
        return $output;
        // return response()->json(['data'=>$data['dep']]);
        
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'cnic' => 'required|unique:student_infos,std_cnic|digits:13|integer',
            'address' => 'required',
            'gender' => 'required',
            // 'batch_name' => 'required',
            'department' => 'required',
            'program' => 'required',
            'section' => 'required',
            'semester' => 'required',
          ]);
        $mail = explode('@',$request->input('email'));
        //   dd($mail[1]);
        if($mail[1] != 'gmail.com')
        return back()->withError('Mail domain Must bi "cuilahore.edu.pk"');


      if($request->input('semester') == 'select')
          return back()->withError('Select Semester');

      if($request->input('department') == 'select')
          return back()->withError('Select Department');


            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_name = 'student';
            $user->password = bcrypt($request->input('cnic'));
            $user->save();

            $student_id = $user->id;

            $std = new student_info;
            $std->std_cnic = $request->input('cnic');
            $std->address = $request->input('address');
            // $std->batch_name = $request->input('batch_name');
            $std->gender = $request->input('gender');
            $std->dep_id = $request->input('department');
            $std->prg_id = $request->input('program');
            $std->sec_id = $request->input('section');
            $std->semester = $request->input('semester');
            $std->student_id = $student_id;
            
            $std->save();


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
        // $data = expenses::find($id);
        
        $data['student'] = DB::table('users')
        ->join('student_infos' , 'student_infos.student_id' , '=' , 'users.id')
        ->join('programs' , 'student_infos.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'student_infos.dep_id' , '=' , 'departments.department_id')
        ->join('sections' , 'student_infos.sec_id' , '=' , 'sections.section_id')
        ->where('users.role_name','student')
        ->where('student_infos.student_info_id','=' ,$id)
        ->get();
        
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        $data['prg'] = Programs::all();
        $data['sec'] = Sections::all();
        return view("studentInfo.updateStd")->with('data',$data);

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
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            // 'batch_name' => 'required',
            'department' => 'required',
            'program' => 'required',
            'section' => 'required',
            'semester' => 'required',
          ]);

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('department') == 'select')
            return back()->withError('Select Department');
            
            $std = student_info::find($id);
            $std->address = $request->input('address');
            // $std->batch_name = $request->input('batch_name');
            $std->gender = $request->input('gender');
            $std->dep_id = $request->input('department');
            $std->prg_id = $request->input('program');
            $std->sec_id = $request->input('section');
            $std->semester = $request->input('semester');
            $user_id = $std->student_id;
            $std->update();

            $user = User::find($user_id);
            $user->name = $request->input('name');
            $user->update();
            $student_id = $user->id;
            

            return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $std = student_info::find($id);
        $stdid = $std->student_id;
        $user = User::find($stdid);
        $std->delete();
        $user->delete();
        return back();

    }
}
