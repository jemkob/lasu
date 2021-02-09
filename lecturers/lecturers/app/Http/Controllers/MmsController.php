<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class MmsController extends Controller
{
    //
    public function index()
    {
        $faculties = DB::table('faculties')->get();
        $departmentid = Auth::user()->DepartmentID;

        $programme = DB::table('allcombineds')
        ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        ->selectRaw('distinct allcombineds.SubjectCombineID, subjectcombinations.SubjectCombinName as SubjectCombinName, subjectcombinations.SubjectCombinID as SubjectCombinID')
        //->groupBy('subjectcombineid')
        ->where('DepartmentID', $departmentid)->get();

        $department = DB::table('departments')->where('departmantID', $departmentid)->first();
        view()->share('department', $department);
        //$users = DB::table('users')->skip(10)->take(5)->get();
        // $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
        // ->where('SubjectCombinID', 71)->skip(0)->take(4)->get();
        //SELECT DISTINCT(DepartmentID) FROM `results` where SubjectCombinID = 71
        
        //return $getdeptid;
        // $departments = DB::table('departments')->get();
        // $sessions = DB::table('sessions')->get();
        // $programmes = DB::table('subjectcombinations')->get();
       
        
        $sessions = DB::table('sessions')->get();
        //$programmes = DB::table('subjectcombinations')->get();
          
        return view('mms.index')->with('programme', $programme)->with('sessions', $sessions);
     }

     public function search(Request $request)
     {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $department = Auth::user()->DepartmentID;
        $semester = $request->input('semester');
        $thesession = $request->input('sessions');
        $programme = $request->input('programmes');
        $level = $request->input('level');
        $thecourse = $request->input('courses');

        $semester01 = $semester;
        $session01 = $thesession;
        $level01 = $level;
        $dept01 = '';

        $results =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcode', 'subjects.subjectvalue as subjectunit', 'subjects.subjectunit as subjectvalue', 'subjects.subjectname as subjectname')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('results.SubjectID', $thecourse)
        ->get();
        // return $results;

        $programme = DB::table('allcombineds')
        ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        ->selectRaw('distinct allcombineds.SubjectCombineID, subjectcombinations.SubjectCombinName as SubjectCombinName, subjectcombinations.SubjectCombinID as SubjectCombinID')
        //->groupBy('subjectcombineid')
        ->where('DepartmentID', $department)->get();

        view()->share('programme', $programme);

        //gets the first department for display
       
        // return $resultaddup2;
        // return $resultaddup;
        $sessions = DB::table('sessions')->get();
        $department = DB::table('departments')->where('departmantID', $department)->first();
        view()->share('department', $department);
       

    view()->share('level', $level);
    view()->share('semester', $semester);

    return view('mms.index')->with('results', $results)->with('sessions', $sessions);
        
     }
}
