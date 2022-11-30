<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Departments;
use App\User;
use App\teacher_info;
class teacherInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teacher'] = DB::table('users')
        ->join('teacher_infos' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->join('departments' , 'teacher_infos.dep_id' , '=' , 'departments.department_id')
        ->where('users.role_name','teacher')
        ->get();
        
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        return view("teacherInfo.index")->with('data',$data);
   
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'cnic' => 'required|unique:student_infos,std_cnic|digits:13|integer',
            'contact' => 'required|max:14',
            'address' => 'required',
            'gender' => 'required',
            'department' => 'required',
          ]);

        if($request->input('department') == 'select')
            return back()->withError('Select Department');

          $mail = explode('@',$request->input('email'));
        //   dd($mail[1]);
        if($mail[1] != 'gmail.com')
          return back()->withError('Mail domain Must bi "cuilahore.edu.pk"');


            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_name = 'teacher';
            $user->password = bcrypt($request->input('cnic'));
            $user->save();

            $teacher_id = $user->id;

            $teacher = new teacher_info;
            $teacher->teacher_cnic = $request->input('cnic');
            $teacher->address = $request->input('address');
            $teacher->gender = $request->input('gender');
            $teacher->contact = $request->input('contact');
            $teacher->dep_id = $request->input('department');
            $teacher->teacher_id = $teacher_id;
            
            $teacher->save();


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
        $data['teacher'] = DB::table('users')
        ->join('teacher_infos' , 'teacher_infos.teacher_id' , '=' , 'users.id')
        ->join('departments' , 'teacher_infos.dep_id' , '=' , 'departments.department_id')
        ->where('users.role_name','teacher')
        ->where('teacher_infos.teacher_info_id','=' ,$id)
        ->get();
        
        $data['dep'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        return view("TeacherInfo.updateTeacher")->with('data',$data);
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
            // 'email' => 'required|unique:users,email',
            // 'cnic' => 'required|unique:student_infos,std_cnic|digits:13|integer',
            'address' => 'required',
            'gender' => 'required',
            'contact' => 'required',
            'department' => 'required',
          ]);


      if($request->input('department') == 'select')
          return back()->withError('Select Department');

        $teacher = teacher_info::find($id);
        // $teacher->teacher_cnic = $request->input('cnic');
        $teacher->address = $request->input('address');
        $teacher->gender = $request->input('gender');
        $teacher->dep_id = $request->input('department');
        $teacher->contact = $request->input('contact');
        $user_id = $teacher->teacher_id;

        $user = User::find($user_id);
        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        $user->role_name = 'teacher';
        // $user->password = bcrypt($request->input('cnic'));
        
        $teacher->save();        
        $user->save();


           

        return redirect()->route('teacher.index');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = teacher_info::find($id);
        $tecid = $teacher->teacher_id;
        $user = User::find($tecid);
        $teacher->delete();
        $user->delete();
        return back();
    }
}
