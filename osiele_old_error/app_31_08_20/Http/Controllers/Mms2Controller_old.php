<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;

class Mms2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = DB::table('faculties')->get();
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
          
        return view('mms2.index')->with('faculties', $faculties)->with('sessions', $sessions);
     }

     public function search(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $department = $request->input('departments');
        $semester = $request->input('semester');
        $thesession = $request->input('sessions');
        $programme = $request->input('programmes');
        $level = $request->input('level');


        $semester01 = $semester;
        $session01 = $thesession;
        $level01 = $level;
        $dept01 = '';


        $results = DB::table('results')
                ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         ->groupBy('results.MatricNo')
                ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
                ->where('results.Level', $level01)
                //->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                // ->paginate(20);
                ->get();
        
                $resultaddup =DB::table('results')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->get();
                //return $resultaddup;

                //result header
                $resultheader = DB::table('results')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->first();
                //return $resultaddup;
        
                //gets the first department for display
                
                $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
                ->where('SubjectCombinID', $programme)->skip(2)->take(1)->get();
                $getid = $getdeptid[0]->DepartmentID;
        
                //get department code for result display
                $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
                $deptcode1 = $getdeptcode1->DepartmentCode;
                $deptid1 = $getdeptcode1->DepartmantID;
        
                $results1 = DB::table('results')
                ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                //->where('results.DepartmentID', $getid)
                ->groupBy('matricno')
                ->get();
        // return $results1;
        
                
        
                //$arrayed = $results->first()->matricno;
                $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
                ->where('SubjectCombinID', $programme)->skip(3)->take(1)->get();
                $getid = $getdeptid[0]->DepartmentID;
        
                //get department code for result display
                $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
                $deptcode2 = $getdeptcode1->DepartmentCode;
                $deptid2 = $getdeptcode1->DepartmantID;
                
        
                $results2 = DB::table('results')
                ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->groupBy('matricno')
                ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->where('departments.DepartmantID', $getid)
                ->get();
                // return $results2;
        
                
                $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
                ->where('SubjectCombinID', $programme)->skip(0)->take(1)->get();
                $getid = $getdeptid[0]->DepartmentID;
        
                //get department code for result display
                $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
                $deptcode3 = $getdeptcode1->DepartmentCode;
                $deptid3 = $getdeptcode1->DepartmantID;
                //return $deptcode3;
        
                $results3 = DB::table('results')
                ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->groupBy('matricno')
                ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->where('departments.DepartmantID', $getid)
                ->get();
                //dd($results3);
        
                $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
                ->where('SubjectCombinID', $programme)->skip(1)->take(1)->get();
                $getid = $getdeptid[0]->DepartmentID;
        
                //get department code for result display
                $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
                $deptcode4 = $getdeptcode1->DepartmentCode;
                $deptid4 = $getdeptcode1->DepartmantID;
        
                $results4 = DB::table('results')
                ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->groupBy('matricno')
                //subjectvalue must be greater than 40 to get tnup for total unit passed
                ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->where('departments.DepartmantID', $getid)
                ->get();
                // return $results4;
                //->take(100)
                
                $sessions = DB::table('sessions')->get();
                $faculties = DB::table('faculties')->get();
                //$programmes = DB::table('subjectcombinations')->get();
        
                //Getting all courses for the faculty based on subject combination ie major/minor courses
                    /* SELECT * FROM `allcombineds` 
                    LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
                    WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */
        
                $compulsorycourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', 1)
                ->where('subjects.SubjectLevel', $level01)
                ->where('subjects.Semester', $semester01)
                ->get();
                // return $compulsorycourses;
        
                $resultaddup2 = DB::table('results')
                ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
                ->where('results.Level', $level01)
                ->where('results.Semester', $semester01)
                ->where('results.SessionID', $session01)
                ->where('results.SubjectCombinID', $programme)
                ->get();
                // return $resultaddup2;
       $theprogramme = DB::table('subjectcombinations')->where('SubjectCombinID', $programme)->first();
       $theschool = DB::table('faculties')->where('FacultyID', $faculty)->first();
       $thisession = DB::table('sessions')->where('SessionID', $session01)->first();

    view()->share('level', $level);
    view()->share('semester', $semester);
    view()->share('session01', $session01);
    view()->share('theprogramme', $theprogramme);
    view()->share('theschool', $theschool);
    view()->share('thisession', $thisession);
    
       

          
        return view('mms2.index')->with('results', $results)->with('results1', $results1)->with('results2', $results2)->with('results3', $results3)->with('results4', $results4)->with('resultaddup', $resultaddup)->with('resultaddup2', $resultaddup2)->with('faculties', $faculties)->with('sessions', $sessions)->with('deptcode1', $deptcode1)->with('deptcode2', $deptcode2)->with('deptcode3', $deptcode3)->with('deptcode4', $deptcode4)->with('deptid1', $deptid1)->with('deptid2', $deptid2)->with('deptid3', $deptid3)->with('deptid4', $deptid4)->with('compulsorycourses', $compulsorycourses);
        
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
