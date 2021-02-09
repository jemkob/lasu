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
        $studentmatric = Auth::user()->MatricNo;
        $studentids= Auth::user()->StudentID;
        $student = DB::table('students')->where('studentid', $studentids)->first();
        
        $subcomb = DB::table('subjectcombinations')->where('subjectcombinname', $student->Major.'/'.$student->Minor)->first();
        $programme = $subcomb->SubjectCombinID;
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();

        
         /*    $carryover = DB::table('results')
            ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            ->whereraw('ca + exam < 40')
            ->where('sessionid', $currentsession->SessionID - 1)
            ->where('matricno', $studentmatric)
            ->where('subjectvalue', '!=', 'E')
            ->get();
        } else { */
            $carryover = DB::table('results')
            ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.subjectid')
            ->whereraw('ca + exam < 40')
            ->where('results.sessionid', $currentsession->SessionID - 1)
            ->where('allcombinedcourses.sessionid', $currentsession->SessionID - 1)
            ->where('studentid', $studentids)
            ->where('allcombinedcourses.subjectcombineid', $subcomb->SubjectCombinID)
            // ->where('subjects.subjectunit','!=', 'R')
            ->get();
            
        if(Auth::user()->Level > 300){
            $carryover = collect($carryover)->whereNotIn('subjectunit', 'E');
            $carryover->all();
        }
        // return $carryover;

        //current curricullum
        $currentcur = DB::table('curricullums')->max('CurricullumID');
        if(Auth::user()->Level > 200){
            $currentcur = 1;
        }

        if(Auth::user()->Level >= 300 && $programme == 90){
            if(Auth::user()->SubCourse =='beds'){
                $compulsorycourses = DB::table('allcombinedcourses')
                // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectid as subjectid', 'allcombinedcourses.*')
                ->where('SubjectCombineID', $programme)
                ->where('sessionid', $currentsession->SessionID)
                ->where('subjectunit', '!=', 'R')
                ->where('SubjectLevel', $student->Level-100)
                ->where('subjectunit', '!=', 'E')
                ->where('subjectcode', 'not like', 'BEA%')
                ->orderby('subjectcode')
                // ->where('subjects.subjectunit', 'E')
                ->get();
                    } else {
                        $compulsorycourses = DB::table('allcombinedcourses')
                // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectid as subjectid', 'allcombinedcourses.*')
                ->where('SubjectCombineID', $programme)
                ->where('sessionid', $currentsession->SessionID)
                ->where('subjectunit', '!=', 'R')
                ->where('SubjectLevel', $student->Level-100)
                ->where('subjectunit', '!=', 'E')
                ->where('subjectcode', 'not like', 'BES%')
                ->orderby('subjectcode')
                // ->where('subjects.subjectunit', 'E')
                ->get();
                    }
        } else {
            $compulsorycourses = DB::table('allcombinedcourses')
        // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectid as subjectid', 'allcombinedcourses.*')
        ->where('SubjectCombineID', $programme)
        ->where('sessionid', $currentsession->SessionID)
        ->where('subjectunit', '!=', 'R')
        ->where('SubjectLevel', $student->Level-100)
        ->where('subjectunit', '!=', 'E')
        ->orderby('subjectcode')
        // ->where('subjects.subjectunit', 'E')
        ->get();
        }
       

        if(Auth::user()->Level > 300){
            $compulsorycourses = collect($compulsorycourses)->where('subjectvalueco', '!=', 'E');
            $compulsorycourses->all();
        }
//  return $compulsorycourses;
        $registeredcourses = DB::table('results')
        ->leftjoin('allcombinedcourses', 'results.subjectid', '=', 'allcombinedcourses.subjectid')
        ->select('results.matricno as matricno', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectid as subjectid')
        ->where('results.sessionid', $currentsession->SessionID -1)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID -1)
        ->where('subjectcombineid', $subcomb->SubjectCombinID)
        ->where('studentid', $studentids)
        ->orderby('allcombinedcourses.subjectcode')
        ->get();
        // return $registeredcourses;

        if(Auth::user()->Level >= 300 && $programme == 90){
            if(Auth::user()->SubCourse =='beds'){
                $CurrentCourses = DB::table('allcombinedcourses')
                // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->where('SubjectCombineID', $programme)
                ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
                ->where('subjectLevel', 300)
                ->where('subjectcode', 'not like', 'BEA%')
                ->orderby('subjectcode')
                ->get();
            } else {
                $CurrentCourses = DB::table('allcombinedcourses')
                // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->where('SubjectCombineID', $programme)
                ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
                ->where('SubjectLevel', 300)
                ->where('subjectcode', 'not like', 'BES%')
                ->orderby('subjectcode')
                ->get();
            }
        } else {
        $CurrentCourses = DB::table('allcombinedcourses')
        // ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->where('SubjectCombineID', $programme)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('SubjectLevel', $student->Level)
        ->orderby('subjectcode')
        ->get();
        }

        return view('student.courseregistration')->with('compulsorycourses', $compulsorycourses)->with('registeredcourses', $registeredcourses)->with('carryover', $carryover)->with('CurrentCourses', $CurrentCourses)->with('student', $student);
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
        $course = $request->input('course');

        if(empty($course)){
            return redirect(url()->previous())->with('error', 'No selection has been made, kindly select one or more course(s).');
        }


        $matric = Auth::user()->MatricNo;
        $studentids= Auth::user()->StudentID;
        $majorminor = Auth::user()->Major.'/'.Auth::user()->Minor;
        $programme = DB::table('subjectcombinations')->where('subjectcombinname', $majorminor)->first();
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        $cursession = $currentsession->SessionID;
        $major = Auth::user()->Major;
        $minor = Auth::user()->Minor;
        $level = Auth::user()->Level;
        
        //cant remember that this line does
        $totaltnu = DB::table('results')
        // ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->select('results.subjectid as subid', 'results.tnu as subval')
        // ->select('subjectid', DB::raw('sum(tnu) as alltnu'))
        // ->groupby('results.subjectid')
        ->whereraw('ca + exam > 39')
        ->where('studentid', $studentids)
        ->where('level', '<', Auth::user()->Level)
        ->get();
        // return $request->input('course');

        $totaltnu = collect($totaltnu);
        $totaltnu = $totaltnu->unique('subid')->sum('subval');

        /* $majormax = DB::table('minmax')
        ->select('level', DB::raw('sum(maximum) as max, SUM(minimum) as min, sum(edumin) as edumin, sum(edumax) as edumax, sum(gsemin) as gsemin, sum(gsemax) as gsemax'))
        ->where('Code', $major)->where('level','<=', $level)->get(); */
        $majormax = DB::table('minmax')
        ->select(DB::raw('maximum + edumax + gsemax as allmax'))
        ->where('Code', $major)->where('level', $level)->where('semester', 2)->first();
        $majormin = DB::table('minmax')
        ->select(DB::raw('minimum + edumin + gsemin as allmin'))
        ->where('Code', $major)->where('level', $level)->where('semester', 2)->first();
        $minormax = DB::table('minmax')
        ->select(DB::raw('maximum as allmaxminor'))
        ->where('Code', $minor)->where('level', $level)->where('semester', 2)->first();
        $minormin= DB::table('minmax')
        ->select(DB::raw('minimum as allminminor'))
        ->where('Code', $minor)->where('level', $level)->where('semester', 2)->first();

        // return $course[22];

        $totalvalue = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $allsubjects = DB::table('subjects')->where('subjectid', $subject)->first();

            if($level == $allsubjects->SubjectLevel){
                $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
                ->where('subjectcombineid', $programme->SubjectCombinID)->where('sessionid', $cursession)->first();
            }else{
                //get the session of the carryover
                $pastsession = ($level-$allsubjects->SubjectLevel)/100;
                
                $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
                ->where('subjectcombineid', $programme->SubjectCombinID)->where('sessionid', $cursession-$pastsession)->first();
            }
            
            // dd($getsubject);
            $totalvalue += $getsubject->SubjectValue;
        }

        if($level > 300){
            $allmax = 1;
            $allmin =1;
        }elseif($level == 300){
            if($major !== $minor){
                $allmax = $majormax->allmax + $minormax->allmaxminor + 6;
                $allmin = $majormin->allmin + $minormin->allminminor + 6;
                } else{
                $allmax = $majormax->allmax + 6;
                $allmin = $majormin->allmin + 6;
                }
        } else {
            if($major !== $minor){
            $allmax = $majormax->allmax + $minormax->allmaxminor;
            $allmin = $majormin->allmin + $minormin->allminminor;
            } else{
            $allmax = $majormax->allmax;
            $allmin = $majormin->allmin;
            }
        }
        // dd($allmin.' '.$allmax);

        // $totalunit = $totalvalue + $totaltnu;
        $totalunit = $totalvalue;
        $exceeds = $totalunit-64;
        $lessthan = 64-$totalunit;
        // dd($totalunit.' totalvalue ='.$totalvalue.' totaltnu='.$totaltnu.' min='.$allmin.' max='.$allmax);
        if($totalunit > 64 && Auth::user()->Level < 400)
        {
            return redirect(url()->previous())->with('error', 'You have selected excess of '.$exceeds.' Units, kindly delete '.$exceeds.' unit(s) courses to proceed.');
        }elseif($totalunit < 1 && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'Your selected course units is '.$lessthan.' less than the required units, kindly add more course(s) to proceed.');
        }elseif(($totalunit >= 2 && $totalvalue <= 64) || Auth::user()->Level > 300){

        

        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            // $getsubject = DB::table('subjects')->where('subjectid', $subject)->first();
            // $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
            // ->where('subjectcombineid', $programme->SubjectCombinID)->where('sessionid', $cursession)->first();
            $allsubjects = DB::table('subjects')->where('subjectid', $subject)->first();

            if($level == $allsubjects->SubjectLevel){
                $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
                ->where('subjectcombineid', $programme->SubjectCombinID)->where('sessionid', $cursession)->first();
            }else{
                //get the session of the carryover
                $pastsession = ($level-$allsubjects->SubjectLevel)/100;
                
                $getsubject = DB::table('allcombinedcourses')->where('subjectid', $subject)
                ->where('subjectcombineid', $programme->SubjectCombinID)->where('sessionid', $cursession-$pastsession)->first();
            }
            

            $deptcode = substr($getsubject->SubjectCode, 0, 3);
            if($deptcode == 'BEA' || $deptcode == 'BES'){
                $deptcode = 'BED';
            }
            $getsubjectdept = DB::table('departments')->where('departmentcode', $deptcode)->first();
            
            if($deptcode == 'ESA'){
                $getsubjectdept = DB::table('departments')->where('departmentcode', 'DEWS')->first();
            }

            if($getsubject->SubjectCode == 'EDU 311'){
                $getsubjectdept = DB::table('departments')->where('departmentcode', 'TP')->first();
            }
           // echo $matric[$i].' '.$ca[$i].' '.$exam[$i].'<br>';

           DB::table('results')
            ->insert(
                ['MatricNo'=>$matric,
                'SubjectID'=> $subject,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>$cursession,
                'StudentID'=>Auth::user()->StudentID,
                'DepartmentID'=>$getsubjectdept->DepartmantID,
                'SubjectCombinID'=>$programme->SubjectCombinID,
                'Level'=>Auth::user()->Level,
                'TNU'=>$getsubject->SubjectValue,
                'SubjectValue'=>$getsubject->SubjectUnit,
                'Semester'=>$getsubject->Semester,
                'CTCP'=>0,
                'CTNU'=>0,
                'CTNUP'=>0,
                'TCP'=>0,
                'TNUP'=>0]);

                DB::table('students')->where('studentid', Auth::user()->StudentID)
                ->update(['Registered'=>'True']);
            }
      
    //   return redirect('student/courseregistration')->with('success', 'Course registration form has been created!');
      return redirect('student/courseform');
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
