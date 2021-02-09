<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class CourseformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //First Semester
        $posts =  DB::table('students')
            //DB::table('students')
            ->join('results', 'students.StudentID', '=', 'results.StudentID')
            ->join('sessions', 'results.sessionid', '=', 'sessions.sessionid')
            ->join('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*')
            ->where('students.studentid', 9282)
            ->where('sessions.currentsession', 1)
            ->where('results.semester', 1)
            
            //->where('sessions.currentsession', 1)
            //->join('courses', 'results.Course', '=', 'courses.Guid')
            //->where('students.Level', '100') 
            //FROM lecturers
            // INNER JOIN lecturerprofiles ON lecturers.LecturerID=lecturerprofiles.LecturerID
            // INNER JOIN subjects ON lecturerprofiles.SubjectID=subjects.SubjectID
            ->get(); 

            //Second Semester
            $posts2 =  DB::table('students')
            //DB::table('students')
            ->join('results', 'students.StudentID', '=', 'results.StudentID')
            ->join('sessions', 'results.sessionid', '=', 'sessions.sessionid')
            ->join('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*', 'sessions.SessionYear as sessionyear')
            ->where('students.studentid', 9282)
            ->where('sessions.currentsession', 1)
            ->where('results.semester', 2)
            ->get();

            $posts2year =  DB::table('students')
            //DB::table('students')
            ->join('results', 'students.StudentID', '=', 'results.StudentID')
            ->join('sessions', 'results.sessionid', '=', 'sessions.sessionid')
            ->join('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*', 'sessions.SessionYear as sessionyear')
            ->where('students.studentid', 9282)
            ->where('sessions.currentsession', 1)
            ->where('results.semester', 2)
            ->first();


        $lecturers = DB::table('lecturerprofiles')
        // ->join('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        // ->select('lecturers.firstname as lectfn', 'lecturers.surname as lectsn', 'lecturerprofiles.subjectid as thesubjectid')
        ->get();
        
        
        return view('student.courseform')->with('posts', $posts)->with('lecturers', $lecturers)->with('posts2', $posts2)->with('posts2year', $posts2year);
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
