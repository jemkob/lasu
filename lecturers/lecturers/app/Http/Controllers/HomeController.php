<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturer = Auth::user()->LecturerID;
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        
        
        //current session
        if(count($subjects) > 0){
        $isubject = "";
        foreach($subjects as $subject){
        $isubject .= $subject->subjectid.', ';
        }

        $thesubject = rtrim($isubject, ', ');
        //$thesubject= '['.$thesubject.']';
        $thesubject= $thesubject;
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $studentlist = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->select('studentid', 'matricno', 'ca', 'exam', 'subjectid')
        ->selectraw('count(results.subjectid) as total, subjects.SubjectCode as subjectcode')
        //->where('ca', 0)
        //->where('exam', 0)
        //->where('matricno', '!=', null)
        ->whereRaw('results.subjectid in ('.$thesubject.')')
        // ->where('facultyid', $thesfaculty)
        ->where('sessionid', $sessions->SessionID)
        //->where('registered', 'true')
        ->groupby('results.subjectid')
        ->orderby('matricno', 'desc')
        ->get();
    } else {
        return redirect('lecturer/editprofile')->with('error', 'You have not been assigned to course(s)');
    }

        $studentlist;
        return view('home')->with('subjects', $subjects)->with('faculties', $faculties)->with('studentlist', $studentlist);
    }
}
