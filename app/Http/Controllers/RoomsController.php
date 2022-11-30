<?php

namespace App\Http\Controllers;
use \App\Departments;
use \App\Rooms;
use DB;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rooms'] = DB::table('rooms')
        ->join('departments' , 'departments.department_id' , '=' , 'rooms.block_id')
        ->get();
        $data['blocks'] = Departments::all();
        return view("Rooms.index")->with('data',$data);
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
        $check = DB::table('rooms')->where('room_no',$request->input('room_no'))
        ->where('block_id',$request->input('block_id'))
        ->count();
        if($check>0)
            return back()->withError('Already Exist ');

            $room = new Rooms;
            $room->room_no = $request->input('room_no');
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
        $check = DB::table('rooms')->where('room_no',$request->input('room_no'))
        ->where('block_id',$request->input('block_id'))
        ->where('room_id' , '!=' ,$id)
        ->count();
        if($check>0)
            return back()->withError('Already Exist ');

            $room =Rooms::find($id);
            $room->room_no = $request->input('room_no');
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
        $room = Rooms::findOrFail($id);
        $room->delete();
        return back();
    }
}
