<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use App\Departments;
use App\Programs;
class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs['programs'] = DB::table('programs')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->get();
        $programs['depart'] = DB::table('departments')->select('department_id','dep_name')->get()->pluck('dep_name', 'department_id');
        return view("programs.index")->with('programs',$programs);
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
        $check = DB::table('programs')->where('prg_name',$request->input('prg_name'))
        ->where('dep_id',$request->input('department_id'))
        ->count();
 
        $this->validate($request, [
            'prg_name' => 'required',
            'no_of_semesters' => 'required',
            'department_id' => 'required',
          ]);

          
        if($check > 0)
        return back()->withError('Already Exist ');
        
        if($request->input('no_of_semesters') == 'select')
            return back()->withError('Select Semester');

        if($request->input('department_id') == 'select')
            return back()->withError('Select Departments');   
   
          $programs = new Programs;
          $programs->prg_name = $request->input('prg_name');
          $programs->no_of_semesters = $request->input('no_of_semesters');
          $programs->dep_id = $request->input('department_id');

          $programs->save();
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
        
        $check = DB::table('programs')->where('prg_name',$request->input('prg_name'))
        ->where('dep_id',$request->input('department_id'))
        ->where('program_id','!=',$id)
        ->count();

            
        $this->validate($request, [
            'prg_name' => 'required',
            'no_of_semesters' => 'required',
            'department_id' => 'required',
          ]);
          
        if($check > 0)
        return back()->withError('Already Exist ');
        
        if($request->input('no_of_semesters') == 'select')
            return back()->withError('Select Semester');

        if($request->input('department_id') == 'select')
            return back()->withError('Select Departments');

          $programs = Programs::find($id);
          $programs->prg_name = $request->input('prg_name');
          $programs->no_of_semesters = $request->input('no_of_semesters');
          $programs->dep_id = $request->input('department_id');

          $programs->save();
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
       
        $programs = Programs::find($id);
        $programs->delete();
        return back();
    }
}
