<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

    public function index2()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems2')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

    public function index3()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems3')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

    public function index4()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems4')->with('sessions', $sessions)->with('subject', $subject);
     }

     public function search(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $course = $request->input('course');
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        $thisfaculty = DB::table('faculties')->where('facultyid', $faculty)->first();
        //return $dept;

        $studentcomb = DB::table('students')->select('Major', 'Minor')->where('FacultyName', $thisfaculty->FacultyName)->where('major', '!=',null)->where('minor', '!=',null)->where('major', '!=', '')->where('minor', '!=', '')->where('registered', 'true')->groupby('Major', 'Minor')->get();

        $ideptcode = "";
        foreach($studentcomb as $cdept){
            $ideptcode .= "'".$cdept->Major.'/'.$cdept->Minor."'".', ';
        }

        $thedept = rtrim($ideptcode, ', ');

        $subjectcombine = DB::table('subjectcombinations')->select('subjectcombinid', 'subjectcombinname')
        ->whereRaw('subjectcombinname in ('.$thedept.')')
        ->get();

        $isubcomb = "";
        foreach($subjectcombine as $subcom){
            $isubcomb .= $subcom->subjectcombinid.', ';
        }

        $thesubcomb = rtrim($isubcomb, ', ');

        $dsubcomb = "";
        foreach($subjectcombine as $subcom){
            $dsubcomb .= $subcom->subjectcombinname.', ';
        }

        $ddsubcomb = rtrim($dsubcomb, ', ');

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        // ->where('departments.facultyid', $faculty)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')')
        ->orderby('matricno')
        ->get();
        // return $ddsubcomb.' ===== '.$thesubcomb.' '.$sessions->SessionID.' '.$course.' '.$results;
        $theschool = DB::table('faculties')->where('facultyid', $faculty)->first();
        $theschool = $theschool->FacultyName;
        $thesession = $sessions->SessionYear;
        $subjectlevel = DB::table('subjects')->where('subjectid', $course)->first();
        // $subjectlevel = $subjectlevel->SubjectLevel;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results)->with('theschool', $theschool)->with('thesession', $thesession)->with('subjectlevel', $subjectlevel); 
        
     }

     public function searchems4(Request $request)
     {
        
        // Gets the query string from our form submission 
        // $faculty = $request->input('faculties');
        $departments = $request->input('departments');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $course = $request->input('course');
        // $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        ->orderby('matricno')
        ->get();
        // return $results;
        // $theschool = DB::table('faculties')->where('facultyid', $faculty)->first();
        // $theschool = $theschool->FacultyName;
        $thesession = $sessions->SessionYear;
        $subjectlevel = DB::table('subjects')->where('subjectid', $course)->first();
        // $subjectlevel = $subjectlevel->SubjectLevel;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems4')->with('faculties', $faculties)->with('subject', $subject)->with('results', $results)->with('thesession', $thesession)->with('subjectlevel', $subjectlevel); 
        
     }

     public function searchems2(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $departments = $request->input('departments');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $course = $request->input('course');
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        ->where('departments.departmantid', $departments)
        ->orderby('matricno')
        ->get();
        // return $results;
        $theschool = DB::table('faculties')->where('facultyid', $faculty)->first();
        $theschool = $theschool->FacultyName;
        $thesession = $sessions->SessionYear;
        $subjectlevel = DB::table('subjects')->where('subjectid', $course)->first();
        // $subjectlevel = $subjectlevel->SubjectLevel;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems2')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results)->with('theschool', $theschool)->with('thesession', $thesession)->with('subjectlevel', $subjectlevel); 
        
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
        ->orderby('matricno')
        ->get();
        // return $results;
        $theschool = DB::table('faculties')->where('facultyid', $faculty)->first();
        $theschool = $theschool->FacultyName;
        $thesession = $sessions->SessionYear;
        $subjectlevel = DB::table('subjects')->where('subjectid', $course)->first();
        // $subjectlevel = $subjectlevel->SubjectLevel;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems3')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results)->with('theschool', $theschool)->with('thesession', $thesession)->with('subjectlevel', $subjectlevel); 
        
     }


public function updatesubcom(){
    $dept= DB::table('departments')->orderby('facultyid')->get();

    foreach($dept as $depts){
        DB::table('subjectcombinations')
        ->where('SubjectCombinName', 'like', $depts->DepartmentCode.'/%')
        ->update(['DepartmentID' => $depts->DepartmantID]);

        return redirect('');
    }
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
