<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Auth;

class CourseformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //StudentID
        $studentid = Auth::user()->StudentID;
        //First Semester
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        $posts =  DB::table('results')
            ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
            ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
            ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*', 'lecturers.firstname as lectfirstname', 'lecturers.surname as lectlastname')
            // ->where('results.matricno', $matricno)
            ->orwhere('results.studentid', $studentid)
            ->where('results.sessionid', $currentsession->SessionID)
            ->where('results.semester', 1)
            ->groupby('results.subjectid')
            ->orderby('subjects.subjectcode')
            ->get();
            // return $posts;


            //Second Semester
            $posts2 =  DB::table('results')
            ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
            ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
            ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*', 'lecturers.firstname as lectfirstname', 'lecturers.surname as lectlastname')
            ->orwhere('results.studentid', $studentid)
            ->where('results.sessionid', $currentsession->SessionID)
            ->where('results.semester', 2)
            ->groupby('results.subjectid')
            ->orderby('subjects.subjectcode')
            ->get();
            

            $posts2year =  DB::table('students')
            //DB::table('students')
            ->join('results', 'students.StudentID', '=', 'results.StudentID')
            ->join('studentimages', 'students.studentid', '=', 'studentimages.studentid')
            ->join('sessions', 'results.sessionid', '=', 'sessions.sessionid')
            ->join('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            
            //->select('students.*', 'jambdetails.*')
            ->select('students.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'results.*', 'sessions.SessionYear as sessionyear', 'studentimages.studentimage as stdimg')
            ->where('students.studentid', $studentid)
            ->where('sessions.currentsession', 1)
            // ->where('results.semester', 2)
            // ->orwhere('results.semester', 1)
            ->first();
            // dd($posts2year);


        $lecturers = DB::table('lecturerprofiles')
        // ->join('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        // ->select('lecturers.firstname as lectfn', 'lecturers.surname as lectsn', 'lecturerprofiles.subjectid as thesubjectid')
        ->get();

        $thestudent=DB::table('students')->where('studentid', $studentid)->first();
        
        
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
