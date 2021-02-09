<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use PDF;

class MmsGraduatingController extends Controller
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
          
        return view('mmsgraduating.index')->with('faculties', $faculties)->with('sessions', $sessions);
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
        $bedas = $request->input('bedasi');

        $facultyname = DB::table('faculties')->select('facultyname')->where('facultyid', $faculty)->first();
        $CourseDept = DB::table('departments')->select('departmantid')->where('Facultyid', $faculty)->get();

        $ideptcode = "";
        foreach($CourseDept as $cdept){
            $ideptcode .= $cdept->departmantid.', ';
        }

        $thedept = rtrim($ideptcode, ', ');

        $subjectcombine = DB::table('allcombineds')->select('subjectcombineid')
        ->whereRaw('departmentid in ('.$thedept.')')
        ->groupby('subjectcombineid')
        ->get();

        $isubcomb = "";
        foreach($subjectcombine as $subcom){
            $isubcomb .= $subcom->subjectcombineid.', ';
        }

        $thesubcomb = rtrim($isubcomb, ', ');
        
        // return $thesubcomb;
        $subcom = DB::table('subjectcombinations')->whereRaw('subjectcombinid in ('.$thesubcomb.')')->first();
        
        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);
        if($minor =='GBO'){
            $minor = 'IGB';
        }
        if($major =='GBO'){
            $major = 'IGB';
        }

        $majorminmax = DB::table('minmax')->where('code', $major)->where('level', $level)->where('Semester', $semester)->first();
        $minorminmax = DB::table('minmax')->where('code', $minor)->where('level', $level)->where('Semester', $semester)->first();

        if($level > 200){
        $tpminmax = DB::table('minmax')->where('code', 'TP')->first();
        view()->share('tpminmax', $tpminmax);
        }

        // return $majorminmax;
        view()->share('majorminmax', $majorminmax);
        view()->share('minorminmax', $minorminmax);

        

        $semester01 = $semester;
        $session01 = $thesession;
        $level01 = $level;
        $dept01 = '';

        if(($level=='300') && ($semester =='2')){
            include('300graduating.php');
            if(isset($bedas) && !empty($bedas)){
                view()->share('bedas', $bedas);
            }
        } 
        // return $results5;
        // echo $subcom;
        // return $getdeptid;
        // return $results1.' sdfdf  '. $results2;
        // return $deptcode1;
        // dd($getdeptcode1);
        // return $getid.' === '.$deptcode2.' === '.$deptcode3.' === '.$deptcode4.' === '.$deptcode1;
        // return $resultaddup;


        $theprogramme = DB::table('subjectcombinations')->whereRaw('subjectcombinid in ('.$thesubcomb.')')->first();
        $theschool = DB::table('faculties')->where('FacultyID', $faculty)->first();
        $thisession = DB::table('sessions')->where('SessionID', $session01)->first();
 
     view()->share('level', $level);
     view()->share('semester', $semester);
     view()->share('session01', $session01);
     view()->share('theprogramme', $theprogramme);
     view()->share('theschool', $theschool);
     view()->share('thisession', $thisession);
     
     //share data for print page
     view()->share('department', $department);
     view()->share('faculty', $faculty);
     view()->share('programme', $programme);
       

    

    /* $pdf = PDF::loadView('mms1.index', compact('results', 'sessions', 'results1', 'results2', 'results3', 'results4', 'resultaddup', 'resultaddup2', 'faculties', 'deptcode1', 'deptcode2','deptcode3', 'deptcode4', 'deptid1', 'deptid2', 'deptid3', 'deptid4', 'compulsorycourses'));
    return $pdf->download('results.pdf');
 */
        return view('mmsgraduating.index')->with('results', $results)->with('results1', $results1)->with('resultaddup', $resultaddup)->with('resultaddup2', $resultaddup2)->with('faculties', $faculties)->with('sessions', $sessions)->with('compulsorycourses', $compulsorycourses);
        
     }

     public function CanGraduate($matricno){
        DB::table('graduate')
        ->insert(['matricno' => $matricno]);
     }

     public function print(Request $request)
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

       /*  if(($level=='100') && ($semester =='1')){
            include('100-1.php');
        } elseif(($level=='100') && ($semester =='2')){
            include('100-2.php');
        } elseif(($level=='200') && ($semester =='1')){
            include('200-1.php');
        } elseif(($level=='200') && ($semester =='2')){
            include('200-2.php');
        } elseif(($level=='300') && ($semester =='1')){
            include('300-1.php');
        } elseif(($level=='300') && ($semester =='2')){
            include('300-2.php');
        } 
        dump($results4); */

        $results = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         ->groupBy('results.MatricNo')
        ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->get();
        // ->get();

        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->get();
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
        ->where('results.DepartmentID', $getid)
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
        ->where('CurricullumID', 2)
        ->where('subjects.SubjectLevel', $level01)
        ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', '!=', 'R')
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
     
     //share data for print page
     view()->share('department', $department);
     view()->share('faculty', $faculty);
     view()->share('programme', $programme);
       

    

    /* $pdf = PDF::loadView('mms1.index', compact('results', 'sessions', 'results1', 'results2', 'results3', 'results4', 'resultaddup', 'resultaddup2', 'faculties', 'deptcode1', 'deptcode2','deptcode3', 'deptcode4', 'deptid1', 'deptid2', 'deptid3', 'deptid4', 'compulsorycourses'));
    return $pdf->download('results.pdf');
 */
        return view('mms1.index')->with('results', $results)->with('results1', $results1)->with('results2', $results2)->with('results3', $results3)->with('results4', $results4)->with('resultaddup', $resultaddup)->with('resultaddup2', $resultaddup2)->with('faculties', $faculties)->with('sessions', $sessions)->with('deptcode1', $deptcode1)->with('deptcode2', $deptcode2)->with('deptcode3', $deptcode3)->with('deptcode4', $deptcode4)->with('deptid1', $deptid1)->with('deptid2', $deptid2)->with('deptid3', $deptid3)->with('deptid4', $deptid4)->with('compulsorycourses', $compulsorycourses);
        
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
