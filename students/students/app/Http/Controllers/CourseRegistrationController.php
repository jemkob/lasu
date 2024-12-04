<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        
       //Comment this line to enable registration
    //    if($_SERVER['REMOTE_ADDR'] != '41.242.66.117' && $_SERVER['REMOTE_ADDR'] != '41.223.65.6' && $_SERVER['REMOTE_ADDR'] != '102.67.11.38' && $_SERVER['REMOTE_ADDR'] != '41.242.66.105'){
    //     // if($_SERVER['REMOTE_ADDR'] != '41.242.66.117' ){
    //         return redirect(url()->previous())->with('error', 'Something went wrong, please try again in 30 minutes.'); 
    //     }

    
        $data = $this->checkpayment();
        if($data && $data['status'] == 0){
            return redirect(url()->previous())->with('error', 'Registration is not enabled for you. Proceed to lasupay.fceportal.com:8010 to make your payment.'); 
        }

        $studentmatric = Auth::user()->MatricNo;
        $studentids= Auth::user()->StudentID;
        $student = DB::table('students')->where('studentid', $studentids)->first();

        if(Auth::user()->MatricNo == NULL){
            $matricno = Auth::user()->AdmissionCode;
        }else{
        $matricno = Auth::user()->MatricNo;
        }
        
        // if(Auth::user()->Level == 100 && ($_SERVER['REMOTE_ADDR'] != '41.242.70.137' && $_SERVER['REMOTE_ADDR'] != '41.223.65.6' && $_SERVER['REMOTE_ADDR'] != '41.242.66.117'  && $_SERVER['REMOTE_ADDR'] != '41.242.66.105') ){
        //     return redirect()->back()->with('error', 'Registration closed.');
        // }
       
        $programme = Auth::user()->Department;
        $department = Auth::user()->Department;
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        // $mysessions = DB::table('results')->where('studentid', $studentids)->groupby('sessionid')->pluck('sessionid', 'level');

        // return $mysessions;

        
         /*    $carryover = DB::table('results')
            ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            ->whereraw('ca + exam < 40')
            ->where('sessionid', $currentsession->SessionID - 1)
            ->where('matricno', $studentmatric)
            ->where('subjectvalue', '!=', 'E')
            ->get();
        } else { */
            // $carryover = DB::table('results')
            // ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.courseid')
            // ->whereraw('ca + exam < 40')
            // ->where('results.sessionid', $currentsession->SessionID - 2)
            // ->where('allcombinedcourses.sessionid', $currentsession->SessionID - 2)
            // ->where('studentid', $studentids)
            // ->where('allcombinedcourses.coursecombineid', $department);
            // ->where('subjects.subjectunit','!=', 'R')
            // ->get();

           
            // ->where('subjects.subjectunit','!=', 'R')
           $carryover = DB::table('results')
            ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.courseid')
            ->whereraw('ca + exam < 40')
            ->where('results.sessionid', $currentsession->SessionID - 1)
            ->where('allcombinedcourses.sessionid', $currentsession->SessionID - 1)
            ->where('matricno', $matricno)
            ->where('allcombinedcourses.departmentid', $department)  
            // ->unionall($carryover)
            ->get();
            // return $carryover;
            
       

        
            
        $compulsorycourses = DB::table('allcombinedcourses')
        // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.courseunit as subjectvalueco', 'allcombinedcourses.courseid as subjectid', 'allcombinedcourses.*')
        ->where('departmentid', $programme)
        ->where('sessionid', $currentsession->SessionID-1)
        ->where('courseLevel', $student->Level-100)
        ->where('coursestatus', '!=', 'E')
        ->orderby('coursecode')
        // ->where('subjects.subjectunit', 'E')
        ->get();
        
       

//  return $compulsorycourses;
        $registeredcourses = DB::table('results')
        ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.courseid')
        ->select('results.matricno as matricno', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.courseunit as subjectvalueco', 'allcombinedcourses.courseid as subjectid')
        ->where('results.sessionid', $currentsession->SessionID -1)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID -1)
        ->where('allcombinedcourses.departmentid', $department)
        ->where('studentid', $studentids)
        ->orderby('allcombinedcourses.coursecode')
        ->get();
        // return $registeredcourses;
//  return $student->Level;
       
        $CurrentCourses = DB::table('allcombinedcourses')
        // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->where('departmentid', $programme)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('courseLevel', $student->Level)
        ->orderby('coursecode')
        ->get();
        
        // return $CurrentCourses;
        // $regstatus = DB::table('registration')
        // return redirect()->back()->with('error', 'Registration is currently closed');
        return view('student.courseregistration')->with(compact('compulsorycourses', 'registeredcourses', 'carryover', 'CurrentCourses', 'student', 'data'));
    }
    public function getMinMax(){
        $major = Auth::user()->Major;
        $minor = Auth::user()->Minor;
        $level = Auth::user()->Level;
        $totaltnu = DB::table('results')->where('ca', '>', 39)->get();

        $majormax = DB::table('minmax')->where('Code', $major)->where('level','<=', $level)->get();
        $minormax = DB::table('minmax')->where('Code', $minor)->where('level','<=', $level)->get();
        // return $majormax;
    }
    public function RegisterCourseform(Request $request)
    {
        
        $registered = Auth::user()->Registered;
        $level = Auth::user()->Level;

        // return $registered;

        if($registered != NULL){
            return redirect(url()->previous())->with('error', 'You have registration for this session, please check your courseform.');
        }

        $course = $request->input('course');


        if(empty($course)){
            return redirect(url()->previous())->with('error', 'No selection has been made, kindly select one or more course(s).');
        }

        if(Auth::user()->MatricNo == NULL){
            $matricno = Auth::user()->AdmissionCode;
        }else{
        $matricno = Auth::user()->MatricNo;
        }


        $matric = $matricno;
        $studentids= Auth::user()->StudentID;
        $programme = Auth::user()->Department;
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        $cursession = $currentsession->SessionID;
        
        //cant remember that this line does
        $totaltnu = DB::table('results')
        ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.courseid')        ->select('results.subjectid as subid', 'courseunit as subval')
        // ->select('subjectid', DB::raw('sum(tnu) as alltnu'))
        // ->groupby('results.subjectid')
        ->whereraw('ca + exam > 39')
        ->where('matricno', $matric)
        ->where('level', '<', Auth::user()->Level)
        ->get();
        // return $request->input('course');

        $totaltnu = collect($totaltnu);
        $totaltnu = $totaltnu->unique('subid')->sum('subval');


        // return $course[22];

        $totalvalue = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $allsubjects = DB::table('allcombinedcourses')->where('courseid', $subject)
            ->where('departmentid', $programme)->first();
            // $allsubjects = DB::table('subjects')->where('subjectid', $subject)->first();

            if($level == $allsubjects->CourseLevel){
                $getsubject = DB::table('allcombinedcourses')->where('courseid', $subject)
                ->where('departmentid', $programme)->where('sessionid', $cursession)->first();
            }else{
                //get the session of the carryover
                $pastsession = ($level-$allsubjects->CourseLevel)/100;
                
                $getsubject = DB::table('allcombinedcourses')->where('courseid', $subject)
                ->where('departmentid', $programme)->where('sessionid', $cursession-$pastsession)->first();
            }
            
            // dd($getsubject);
            $totalvalue += $getsubject->CourseUnit;
        }

        

        // $totalunit = $totalvalue + $totaltnu;
        $totalunit = $totalvalue;
        $exceeds = $totalunit-64;
        $lessthan = 64-$totalunit;

        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            // $getsubject = DB::table('subjects')->where('subjectid', $subject)->first();
            // $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
            // ->where('departmentid', $programme->SubjectCombinID)->where('sessionid', $cursession)->first();
            // $allsubjects = DB::table('subjects')->where('subjectid', $subject)->first();
            $allsubjects = DB::table('allcombinedcourses')
            ->where('courseid', $subject)
            ->where('departmentid', $programme)
            ->where('sessionid', $cursession)
            ->first();
            // dd($level);
            if(empty($allsubjects)){
                $allsubjects = DB::table('allcombinedcourses')
                ->where('courseid', $subject)
                ->where('departmentid', $programme)
                ->where('sessionid', $cursession-1)
                ->first();
            }
            if($level == $allsubjects->CourseLevel){
                $getsubject = DB::table('allcombinedcourses')->where('courseid', $subject)
                ->where('departmentid', $programme)->where('sessionid', $cursession)->first();
            }else{
                //get the session of the carryover
                $pastsession = ($level-$allsubjects->CourseLevel)/100;
                
                $getsubject = DB::table('allcombinedcourses')->where('courseid', $subject)
                ->where('departmentid', $programme)->where('sessionid', $cursession-$pastsession)->first();
            }
            

           // echo $matric[$i].' '.$ca[$i].' '.$exam[$i].'<br>';

           
        $registered = Auth::user()->Registered;

        if($registered == 'TRUE'){
            return redirect(url()->previous())->with('error', 'You have registration for this session, please check your courseform.');
        }

           DB::table('results')
            ->insert(
                ['MatricNo'=>$matric,
                'SubjectID'=> $subject,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>$cursession,
                'StudentID'=>Auth::user()->StudentID,
                'DepartmentID'=>$programme,
                'Level'=>Auth::user()->Level
                ]);

                DB::table('students')->where('StudentID', Auth::user()->StudentID)
                ->update(['Registered'=>'TRUE']);
            }
      
    //   return redirect('student/courseregistration')->with('success', 'Course registration form has been created!');
      return redirect('student/courseform');
        
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

    public function checkpayments()
    {
        if(Auth::user()->MatricNo == NULL){
            $matricno = Auth::user()->AdmissionCode;
        }else{
        $matricno = Auth::user()->MatricNo;
        }

        $unpaid = DB::table('results')->where('sessionid', 5)->groupby('studentid')->pluck('matricno');
        
       return count($unpaid);
        $ch = curl_init('http://lasupay.fceportal.com:8010/getpayments');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($ch);
        curl_close($ch);
        $services = json_decode($json, true);

        // return $services;

        $collection = collect($unpaid);
        
        $diff = $collection->diff($services);
        
        $diff->all();
        
        return $diff;
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
