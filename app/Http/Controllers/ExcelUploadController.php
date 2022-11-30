<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Users;
use \App\ExcelUpload;
class ExcelUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ExcelUpload::get();
        return View('uploads.index')->with('data',$data);
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
        $this->validate($request,[
            'file' => 'nullable|max:1999'
        ]);
        if($request->hasFile('file')){
            // Get file name with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            // Get Extension of file
            $extension = $request->file('file')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName. '_'.time().'.'.$extension;
            // Upload file
        //    dd($extension);
            if($extension!="xls")
                if($extension!= 'xlsx')
                    return back()->withError('File must be of xcl type');

            $path = $request->file('file')->storeAs('public/files',$fileNameToStore);  

            $upload = new ExcelUpload;
            $upload->file = $fileNameToStore;
            $upload->admin_id = auth()->user()->id;

            $upload->save();

            return back()->withSuccess("File Uploaded Successfully");

        
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
