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
        if(Auth::user()->MatricNo == NULL){
            $matricno = Auth::user()->AdmissionCode;
        }else{
        $matricno = Auth::user()->MatricNo;
        }

        $data = $this->checkpayment();
        if($data && $data['status'] == 0){
            return redirect(url()->previous())->with('error', 'Registration is not enabled for you. Proceed to lasupay.fceportal.com:8010 to make your payment.'); 
        }

        //StudentID
        $studentid = Auth::user()->StudentID;
        //First Semester
        $currentsession = DB::table('sessions')->where('currentsession', 1)->first();
        // dd($currentsession->SessionID);
        // return $studentid;
        $thestudent=DB::table('students')->where('studentid', $studentid)->first();
        $program =Auth::user()->Department;

        $studentprogramme = DB::table('department')->where('departmentid', $program)->first();

        // $getsubject = DB::table('allcombinedcourses')->where('courseid', $subject)
                // ->where('departmentid', $programme)->where('sessionid', $cursession)->first();

        
                $posts =  DB::table('results')
                // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
                ->leftjoin('allcombinedcourses', 'allcombinedcourses.courseid', '=', 'results.subjectid')
                ->where('results.studentid', $studentid)
                ->where('results.sessionid', $currentsession->SessionID)
                ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
                ->where('allcombinedcourses.departmentid', $program)
                // ->groupby('results.subjectid')
                ->orderby('coursecode')
                // ->orderby('subjects.subjectcode')
                ->get();
            

            // $posts = $posts->unique('coursecode')->sortBy('coursecode');

            // $posts->values()->all();

            // if($_SERVER['REMOTE_ADDR'] != '41.223.65.6'){
            //     // return $posts;
            //     // dd($studentprogramme);
            //     return redirect(url()->previous())->with('error', 'Registration closed for maintenance.');
            // }

        
        return view('student.courseform')->with(compact('posts', 'program', 'matricno', 'currentsession', 'studentprogramme'));
    }

    public function checkpayment()
    {
        // if(Auth::user()->MatricNo == NULL){
            $matricno = Auth::user()->AdmissionCode;
        // }else{
        // $matricno = Auth::user()->MatricNo;
        // }

       
        $ch = curl_init('http://lasupay.fceportal.com:8010/getpayment/'.$matricno);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($ch);
        curl_close($ch);
        $services = json_decode($json, true);

        return $services;
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
