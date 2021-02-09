<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use PDF;

class SummaryPassedController extends Controller
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
          
        return view('summarypassed.index')->with('faculties', $faculties)->with('sessions', $sessions);
     }

     /* public function search(Request $request)
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

        if(($level=='100') && ($semester =='1')){
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
        // return $resultaddup;
       

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
 
        return view('summarypassed.index')->with('results', $results)->with('results1', $results1)->with('results2', $results2)->with('results3', $results3)->with('results4', $results4)->with('resultaddup', $resultaddup)->with('resultaddup2', $resultaddup2)->with('faculties', $faculties)->with('sessions', $sessions)->with('deptcode1', $deptcode1)->with('deptcode2', $deptcode2)->with('deptcode3', $deptcode3)->with('deptcode4', $deptcode4)->with('deptid1', $deptid1)->with('deptid2', $deptid2)->with('deptid3', $deptid3)->with('deptid4', $deptid4)->with('compulsorycourses', $compulsorycourses);
        
     }*/ 
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
        

        $subcom = DB::table('subjectcombinations')->where('subjectcombinid', $programme)->first();
        
        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);
        if($minor =='GBO'){
            $minor = 'IGB';
        }

        $majorminmax = DB::table('minmax')->where('code', $major)->where('level', $level)->where('Semester', $semester)->first();
        $minorminmax = DB::table('minmax')->where('code', $minor)->where('level', $level)->where('Semester', $semester)->first();

        // return $majorminmax;
        view()->share('majorminmax', $majorminmax);
        view()->share('minorminmax', $minorminmax);

        $semester01 = $semester;
        $session01 = $thesession;
        $level01 = $level;
        $dept01 = '';

        if(($level=='100') && ($semester =='1')){
            include('100-1.php');
        } elseif(($level=='100') && ($semester =='2')){
            include('100-2.php');
        } elseif(($level=='200') && ($semester =='1')){
            include('200-1.php');
        } elseif(($level=='200') && ($semester =='2')){
            include('200-2.php');
        } elseif(($level=='300') && ($semester =='1')){
            include('300-1.php');
            view()->share('results5', $results5);
            if(isset($bedas) && !empty($bedas)){
                view()->share('bedas', $bedas);
            }
        } elseif(($level=='300') && ($semester =='2')){
            include('300-2.php');
            view()->share('results5', $results5);
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
        return view('summarypassed.index')->with('results', $results)->with('results1', $results1)->with('results2', $results2)->with('results3', $results3)->with('results4', $results4)->with('resultaddup', $resultaddup)->with('resultaddup2', $resultaddup2)->with('faculties', $faculties)->with('sessions', $sessions)->with('deptcode1', $deptcode1)->with('deptcode2', $deptcode2)->with('deptcode3', $deptcode3)->with('deptcode4', $deptcode4)->with('deptid1', $deptid1)->with('deptid2', $deptid2)->with('deptid3', $deptid3)->with('deptid4', $deptid4)->with('compulsorycourses', $compulsorycourses);
        
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
