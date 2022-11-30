<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slots;
use DB;
class SlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slots = Slots::all();
        return view("slots.index")->with('slots',$slots);
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
            'slot_no' => 'required|unique:slots,slot_no',
            'slot_time' => 'required|unique:slots,slot_time',
          ]);
            $sl = DB::table('slots')->count();
            // dd($sl);
            if($sl >= 8)
            return back()->withError('8 slots already Exist');
 
            $slots = new Slots;
            $slots->slot_no = $request->input('slot_no');
            $slots->slot_time = $request->input('slot_time');
            $slots->save();
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
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'slot_no' => 'required|unique:slots,slot_no,'.$id.',slot_id',
            'slot_time' => 'required|unique:slots,slot_time,'.$id.',slot_id',
          ]);
            $slots = Slots::find($id);
            $slots->slot_no = $request->input('slot_no');
            $slots->slot_time = $request->input('slot_time');
            $slots->save();
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
        
        $slots = Slots::findOrFail($id);
        $slots->delete();
        return back();
    }
    
}
