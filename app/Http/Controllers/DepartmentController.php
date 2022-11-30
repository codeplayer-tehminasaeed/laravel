<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Departments;
class DepartmentController extends Controller
{

//     public function __construct()
//     {
// // dd(Auth::user());

//         if(Auth::user()->role_name == "admin")
//         return View("home");
//     }

    
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Departments::all();
        return view("department.index")->with('departments',$departments);
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
            'dep_name' => 'required|unique:departments|regex:/^[a-zA-Z ]*$/',
            'block_name' => 'required|unique:departments',
          ]);
            $dep = new Departments;
            $dep->dep_name = $request->input('dep_name');
            $dep->block_name = $request->input('block_name');
            $dep->save();
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
    public function update(Request $request,$id)
    {
            $dep = Departments::find($id);
            
        $this->validate($request, [
            'dep_name' => 'required|unique:departments,dep_name,'.$id.',department_id',
            'block_name' => 'required|unique:departments,block_name,'.$id.',department_id',
          ]);
            $dep->dep_name = $request->input('dep_name');
            $dep->block_name = $request->input('block_name');
            $dep->save();
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
        
        $dep = Departments::findOrFail($id);
        $dep->delete();
        return back();
    }
    
}
