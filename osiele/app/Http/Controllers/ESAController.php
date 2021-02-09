<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ESAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = DB::table('faculties')->orderby('facultyname')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('resultviewer.esaresults')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

     public function getESA (Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculty'); 
        $sessions = $request->input('sessions');
        $level = $request->input('level');
        $semester = $request->input('semester');

        $results = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->where('results.sessionid', $sessions)
        ->where('results.semester', $semester)
        ->where('results.level', $level)
        ->where('subjects.subjectunit', 'R')
        ->where('students.facultyname', $faculty)
        ->orderby('subjects.subjectcode')
        ->get();
        // return $results;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('resultviewer.esaresults')->with('faculties', $faculties)->with('subject', $subject)->with('results', $results)->with('sessions', $sessions)->with('level', $level); 
        
     }
     public function searchems3(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $programme = $request->input('programmes');
        $course = $request->input('course');
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        //->where('departments.facultyid', $faculty)
        ->where('subjectcombinations.subjectcombinid', $programme)
        ->get();
        // return $results;
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems3')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results); 
        
     }
     public function studentlistindex(){
        return view('statistics.studentlist');
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
        //
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
