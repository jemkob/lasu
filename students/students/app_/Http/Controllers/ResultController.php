<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Auth;

class ResultController extends Controller
{
    public function ResultBySemester(Request $request)
    {
        //get current student
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;
        $thelevel = $request->input('level');
        $semester = $request->input('semester');
        //First Semester
        $results =  DB::table('results')
            ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode', 'subjects.SubjectName as SubjectName', 'results.Level as level')
            ->where('results.MatricNo', $studentmatric)
            ->where('results.level', $thelevel)
            ->where('results.semester', $semester)
            ->orderby('results.semester', 'asc')
            ->get(); 

            $level = DB::table('results')
            ->select('Level')
            ->where('matricno', $studentmatric)
            ->groupby('Level')
            ->get();

        
        return view('student.semesterresult')->with('results', $results)->with('level', $level)->with('thelevel', $thelevel)->with('semester', $semester);
    
    }
    public function thelevel()
    {
        //get level
        $studentmatric = Auth::user()->MatricNo;
        $level = DB::table('results')
        ->select('Level')
        ->where('matricno', $studentmatric)
        ->groupby('Level')
        ->get();
        
        return view('student.semesterresult')->with('level', $level);
    }

    //result by level
    public function ResultByLevel(Request $request)
    {
        //get current student
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;
        $thelevel = $request->input('level');
        //$semester = $request->input('semester');
        //First Semester
        $results =  DB::table('results')
            ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode', 'subjects.SubjectName as SubjectName', 'results.Level as level')
            ->where('results.MatricNo', $studentmatric)
            ->where('results.level', $thelevel)
            //->where('results.semester', $semester)
            ->orderby('Semester', 'asc')
            ->get(); 

            $level = DB::table('results')
            ->select('Level')
            ->where('matricno', $studentmatric)
            ->groupby('Level')
            ->get();

        
        return view('student.levelresult')->with('results', $results)->with('level', $level)->with('thelevel', $thelevel);
    }

    public function thelevel2()
    {
        //get level for
        $studentmatric = Auth::user()->MatricNo;
        $level = DB::table('results')
        ->select('Level')
        ->where('matricno', $studentmatric)
        ->groupby('Level')
        ->get();
        
        return view('student.levelresult')->with('level', $level);
    }

    //carryover
    public function CarryOver()
    {
        //get current student
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;
       
        //First Semester
        $results =  DB::table('carryovers')
            ->leftjoin('results', 'carryovers.ResultID', '=', 'results.ResultID')
            ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode', 'subjects.SubjectName as SubjectName', 'results.Level as level')
            ->where('results.MatricNo', $studentmatric)
            //->where('results.level', $thelevel)
            //->where('results.semester', $semester)
            //->orderby('Semester', 'asc')
            ->get(); 

                    
        return view('student.carryover')->with('results', $results);
    }
}
