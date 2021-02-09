<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 
        $school = School::all();
        //$users = DB::table('students')->take(10)->get();
          
        return view('schoolmanager.index')->with('school', $school);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schoolmanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new School;
        $student->FacultyName = $request->input('facultyname');
        $student->FacultyCode = $request->input('facultycode');
        
        $student->save();

        return redirect('/schoolmanager')->with('success', 'Faculty Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showstudent = School::find($id);

        return view('schoolmanager.show')->with('showstudent', $showstudent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showstudent = School::find($id);

        return view('schoolmanager.edit')->with('showstudent', $showstudent);
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
        $student = School::find($id);
        $student->FacultyName = $request->input('facultyname');
        $student->FacultyCode = $request->input('facultycode');
        
        $student->save();

        return redirect('/schoolmanager')->with('success', 'Faculty updated');
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
