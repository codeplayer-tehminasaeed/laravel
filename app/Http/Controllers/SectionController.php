<?php

namespace App\Http\Controllers;
use DB;
use App\Departments;
use App\Programs;
use App\Sections;
use Illuminate\Http\Request;

class SectionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections['sections'] = DB::table('sections')
        ->join('programs' , 'sections.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->get();
        $sections['programs'] = DB::table('programs')->select('program_id','prg_name')->get()->pluck('prg_name', 'program_id');
        return view("sections.index")->with('sections',$sections);
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

        $check = DB::table('sections')->where('sec_name',$request->input('section_name'))
        ->where('semester',$request->input('semester'))
        ->where('prg_id',$request->input('program'))
        ->count();

        
        $this->validate($request, [
            'section_name' => 'required|regex:/^[a-zA-Z ]*$/',
            'batch_name' => 'required',
            'semester' => 'required',
            'program' => 'required',
          ]);
        if($check > 0)
            return back()->withError('Already Exist ');

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');


          $section = new Sections;
          $section->sec_name = $request->input('section_name');
          $section->batch_name = $request->input('batch_name');
          $section->semester = $request->input('semester');
          $section->prg_id = $request->input('program');

          $section->save();
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
        $check = DB::table('sections')->where('sec_name',$request->input('section_name'))
        ->where('semester',$request->input('semester'))
        ->where('prg_id',$request->input('program'))
        ->where('section_id','!=',$id)
        ->count();;

             
        $this->validate($request, [
            'section_name' => 'required|regex:/^[a-zA-Z ]*$/',
            'semester' => 'required',
            'program' => 'required',
            'batch_name' => 'required',
          ]);

          
        if($check > 0)
        return back()->withError('Already Exist ');

        if($request->input('semester') == 'select')
            return back()->withError('Select Semester');

        if($request->input('program') == 'select')
            return back()->withError('Select Program');

          $section = Sections::find($id);

          $section->sec_name = $request->input('section_name');
          $section->batch_name = $request->input('batch_name');
          $section->semester = $request->input('semester');
          $section->prg_id = $request->input('program');

         
          $section->save();
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
       
        $section = Sections::find($id);
        $section->delete();
        return back();
    }
}
