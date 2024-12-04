<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ResultController extends Controller
{
    //
    public function search(Request $request)
    {
        //
        // Gets the query string from our form submission 
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within 
        // our articles titles. Paginates them so we can break up lots of search results.
        $results = DB::table('results')->where('matricno', $query)->paginate(10);
            
        // returns a view and passes the view the list of articles and the original query.
        return view('resultviewer.index')->with('results', $results);
        //return view('resultviewer.index');
    }

    public function thelevel()
    {
        return view('resultviewer.index');
    }

    public function senateIndex()
    {
        return view('senate.index');
    }

    public function senateResult(Request $request){
        // $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        // $level = $request->input('level');
        // $semester = $request->input('semester');

        $student = DB::table('results')
        ->select('students.firstname as Firstname', 'students.surname as Surname', 'students.middlename as Middlename', 'students.matricno as MatricNo', 'results.level as Level', 'students.studentid as StudentID', 'departments.departmentname as departmentname')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('departments', 'departments.departmentid', '=', 'students.department')
        ->where('results.matricno', $matricno)
        ->orderby('Level', 'desc')
        ->first();


        // $department = DB::table('departments')->where('departmentid', $student->department)->first();
        // $departmentname = DB::table('departments')->where('departmentid', $department)->first();
        
        if(!isset($student)){
            return redirect('/academicstanding')->with('error', 'Sorry: Invalid Input');
        }


        $resultcheck = DB::table('results')->where('matricno', $matricno)->max('level');
        $combinationid = DB::table('results')->where('matricno', $matricno)->first();
        


        $level = $student->Level;

        // $thesession = DB::table('sessions')->where('sessionid', $session)->first();
        $results = DB::table('results')
        ->leftjoin('allcombinedcourses', 'courseid', '=', 'results.subjectid')
        ->where('matricno', $matricno)
        // ->where('allcombinedcourses.sessionid', 'results.sessionid')
        // ->where('results.sessionid', 'allcombinedcourse.sessionid')
        ->where('allcombinedcourses.departmentid', $combinationid->DepartmentID)
        ->get();
// return $results;
// if(Auth::user()->Username == 'admin') { dump($results->where('Level', 100));}

        $levels = DB::table('results')
        ->select('level', 'sessionyear', 'results.sessionid as sessionid')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->where('matricno', $matricno)->groupby('level')->orderby('level')
        ->get();
        // ->pluck('level');

        // return $levels;
        // $coll = collect($results);
        // // $colls = $coll->where('level', 100);
        // $coll->all();
        // // return $colls;

        // foreach($levels as $l){
        //     echo $l. ' level <p/>';
        //     foreach($results->where('Level', $l) as $rs){
        //         echo $rs->CA.' Exam: '. $rs->EXAM.' LEVEL: '.$l.'<p/>';
        //     }
        // }
        // return 'james';
        
// dd($level);
        

        $tlevel = DB::table('results')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        // ->where('results.sessionid', '<=', $session)
        ->where('results.matricno', $matricno)
        ->groupby('Level')
        ->get();

       

        $sessions = DB::table('sessions')->get();

        
        return view('senate.index')->with(compact('results', 'levels', 'student', 'department'));

    }

    public function provisionalIndex()
    {
        return view('senate.provisional');
    }

    public function provisionalResult(Request $request){
        // $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        // $level = $request->input('level');
        // $semester = $request->input('semester');

        $student = DB::table('results')
        ->select('students.firstname as Firstname', 'students.surname as Surname', 'students.middlename as Middlename', 'students.matricno as MatricNo', 'results.level as Level', 'students.studentid as StudentID', 'departments.departmentname as departmentname')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('departments', 'departments.departmentid', '=', 'students.department')
        ->where('results.matricno', $matricno)
        ->orderby('Level', 'desc')
        ->first();


        // $department = DB::table('departments')->where('departmentid', $student->department)->first();
        // $departmentname = DB::table('departments')->where('departmentid', $department)->first();
        
        if(!isset($student)){
            return redirect('/academicstanding')->with('error', 'Sorry: Invalid Input');
        }


        $resultcheck = DB::table('results')->where('matricno', $matricno)->max('level');
        $combinationid = DB::table('results')->where('matricno', $matricno)->first();
        


        $level = $student->Level;

        // $thesession = DB::table('sessions')->where('sessionid', $session)->first();
        $results = DB::table('results')
        ->leftjoin('allcombinedcourses', 'courseid', '=', 'results.subjectid')
        ->where('matricno', $matricno)
        // ->where('allcombinedcourses.sessionid', 'results.sessionid')
        // ->where('results.sessionid', 'allcombinedcourse.sessionid')
        ->where('allcombinedcourses.departmentid', $combinationid->DepartmentID)
        ->get();
// return $results;
// if(Auth::user()->Username == 'admin') { dump($results->where('Level', 100));}

        $levels = DB::table('results')
        ->select('level', 'sessionyear', 'results.sessionid as sessionid')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->where('matricno', $matricno)->groupby('level')->orderby('level')
        ->get();
        // ->pluck('level');

        // return $levels;
        // $coll = collect($results);
        // // $colls = $coll->where('level', 100);
        // $coll->all();
        // // return $colls;

        // foreach($levels as $l){
        //     echo $l. ' level <p/>';
        //     foreach($results->where('Level', $l) as $rs){
        //         echo $rs->CA.' Exam: '. $rs->EXAM.' LEVEL: '.$l.'<p/>';
        //     }
        // }
        // return 'james';
        
// dd($level);
        

        $tlevel = DB::table('results')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        // ->where('results.sessionid', '<=', $session)
        ->where('results.matricno', $matricno)
        ->groupby('Level')
        ->get();

       

        $sessions = DB::table('sessions')->get();

        
        return view('senate.provisional')->with(compact('results', 'levels', 'student', 'department'));

    }

    
       
}
