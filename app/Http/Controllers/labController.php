<?php

namespace App\Http\Controllers;
use \App\Departments;
use \App\lab;
use DB;
use Illuminate\Http\Request;

class labController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $data['labs'] = DB::table('labs')
        ->join('departments' , 'departments.department_id' , '=' , 'labs.block_id')
        ->get();
        $data['blocks'] = Departments::all();
        return view("labs.index")->with('data',$data);
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
        
        $check = DB::table('labs')->where('lab_name',$request->input('lab_name'))
        ->where('block_id',$request->input('block_id'))
        ->count();
        if($check>0)
            return back()->withError('Already Exist ');

            $room = new lab;
            $room->lab_name = $request->input('lab_name');
            $room->block_id = $request->input('block_id');
            $room->save();
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
        // dd($request->input('block_id'));
        $check = DB::table('labs')->where('lab_name',$request->input('lab_name'))
        ->where('block_id',$request->input('block_id'))
        ->where('lab_id' , '!=' ,$id)
        ->count();
        if($check>0)
            return back()->withError('Already Exist ');

            $room =lab::find($id);
            $room->lab_name = $request->input('lab_name');
            $room->block_id = $request->input('block_id');
            $room->save();
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
        $room = lab::findOrFail($id);
        $room->delete();
        return back();
    }
}
