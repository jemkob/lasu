<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use PDF;
use Auth;

class RectifyResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessions = DB::table('sessions')->get();
        view()->share('sessions', $sessions);
        return view('rectifyresult.index');
    }

    public function search(Request $request)
    {
        // Gets the query string from our form submission 
        $sessions = DB::table('sessions')->get();

        $matricno = $request->input('matricno');
        $thesession = $request->input('sessions');
        $semester = $request->input('semester');
        $results = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.studentid', '=', 'students.studentid')
        ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.ResultID as resultid', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode',  'subjects.SubjectCode as SubjectCode', 'subjects.SubjectName as SubjectName', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor')
        ->where('results.MatricNo', $matricno)
        ->where('sessionid', $thesession)
        ->where('results.Semester', $semester)
        ->get();
        // return $results;
       /*  $pdf = PDF::loadView('rectifyresult.index', compact('results', 'sessions'));
        return $pdf->download('results.pdf'); */
        // returns a view and passes the view the list of articles and the original query.
        return view('rectifyresult.index')->with('results', $results)->with('sessions', $sessions);
    }
    public function previewdownload(){
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        //$subject = $request->input('subject');
                $prevdownload = DB::table('results')
               ->where('subjectid', 1028)
               ->where('sessionid', $sessions->SessionID)
               ->orderby('matricno')
               //->where('lecturerid', Auth::user()->LecturerID)
               ->get();
               //return $prevdownload;

            //    return view('lecturer/previewdownload')->with('prevdownload', $prevdownload);
         $pdf = PDF::loadView('lecturer/previewdownload', compact('prevdownload'));
        return $pdf->download('results.pdf');
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
        // Gets the query string from our form submission 
        $sessions = DB::table('sessions')->get();

        $results = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('sessions', 'results.SessionID', '=', 'sessions.SessionID')
        ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.ResultID as resultid', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode',  'subjects.SubjectCode as SubjectCode', 'subjects.SubjectName as SubjectName')
        ->where('ResultID', $id)->first();
        // return $results;
       /*  $pdf = PDF::loadView('rectifyresult.index', compact('results', 'sessions'));
        return $pdf->download('results.pdf'); */
        // returns a view and passes the view the list of articles and the original query.
        return view('rectifyresult.edit')->with('results', $results);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        //
        $newca = $request->input('newca');
        $newexam = $request->input('newexam');
        $oldca = $request->input('oldca');
        $oldexam = $request->input('oldexam');
        $resultid = $request->input('resultid');
        $reason = $request->input('reason');
        $course = $request->input('coursecode');
        $matricno = $request->input('matricno');
        $examca = $newca + $newexam;

        
        $getresult = DB::table('results')->where('resultid', $resultid)->first();
        // return $getresult;

        $curResult = DB::table('results')
        ->where('sessionid', $getresult->SessionID + 1)
        ->where('subjectid', $getresult->SubjectID)
        ->where('matricno', $getresult->MatricNo)
        ->first();

            if($examca > 39 && !empty($curResult->MatricNo)){
                DB::table('results')->where('ResultID', $curResult->ResultID)->delete();
            }
            if($examca > 100){
                return redirect('/rectify')->with('error', 'CA and EXAM cannot be more than 100, check your input and enter the correct score');
            }
        DB::table('results')
            ->where('resultID', $resultid)
            ->update(['CA' => $newca, 'EXAM' => $newexam]);

            $info = 'Reason: '.$reason.'<br>';
            $info .= 'MatricNo: '.$matricno.', Course Code: '.$course.', ResultID: '.$resultid.'.<br>';
            $info .= 'Old Score, CA = '.$oldca.', EXAM = '.$oldexam.'.<br>';
            $info .= 'New Score, CA = '.$newca.', EXAM = '.$newexam.'.<br>';
            $info .= 'IP Address: '.$_SERVER['REMOTE_ADDR'];

            DB::table('auditlive')->insert(['UserName' => Auth::user()->Username, 'Activity' => 'Rectify Score', 'Info' => $info ]);
        
            
            return redirect('/rectify')->with('success', 'Result rectified');
            //check if subject is already in carryover table
            /* $checkco = DB::table('carryovers')->where('ResultID', $resultid)->get();
            if(count($checkco) > 0){
                if($examca > 39){
                    DB::table('carryover')->where('ResultID', $resultid)->delete();
                } 
            } else {
                if($examca < 40){
                    DB::table('carryover')->insert(['ResultID' => $resultid]);
                }
            } */
            //DB::table('users')->where('votes', '>', 100)->delete();
    }

    public function update(Request $request, $id)
    {
        //
        $newca = $request->input('newca');
        $newexam = $request->input('newexam');
        DB::table('results')
            ->where('resultID', $id)
            ->update(['CA' => $newca, 'EXAM' => $newexam]);
            return redirect('/rectify')->with('success', 'Result rectified');
            //DB::table('users')->where('votes', '>', 100)->delete();
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
