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

        return redirect('/schoolmanager')->with('success', 'School Created');
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

        return redirect('/schoolmanager')->with('success', 'School updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        /* $school = School::find($id);
        $checkschool = DB::table('students')->where('facultyname', $school->FacultyName)->get();
        if(isset($checkschool) && count($checkschool) > 0){
            return redirect('schoolmanager')->with('error', 'There are students in this school, please remove all the students in the school first.');
        } else {
            // $school->delete();
            DB::table('faculties')->where('facultyid', $id)->delete();
        }
        
        return redirect('/schoolmanager')->with('success', 'School Deleted.'); */
    }

    public function deleteSchool(Request $request){
        $schoolid = $request->input('schoolid');

        $school = DB::table('faculties')->where('facultyid', $schoolid)->first();
        
        $checkschool = DB::table('students')->where('FacultyName', $school->FacultyName)->get();

        $checkdept = DB::table('departments')->where('facultyid', $schoolid)->get();
        
        if(isset($checkschool) && count($checkschool) > 0 || isset($checkdept) && count($checkdept) > 0 ){
            return redirect('schoolmanager')->with('error', 'There are students or departments in this school, please remove all the students in the school first.');
        } else {
            // $school->delete();
            DB::table('faculties')->where('facultyid', $school->FacultyID)->delete();
        }
        
        return redirect('/schoolmanager')->with('success', 'School Deleted.');
    }
   
}
