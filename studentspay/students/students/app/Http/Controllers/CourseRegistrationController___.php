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

        if(empty($subcomb)){
            return redirect(url()->previous())->with('error', 'Subject Combination Error, Update Combination.');
        }
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
            ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            ->whereraw('ca + exam < 40')
            ->where('sessionid', $currentsession->SessionID - 1)
            ->where('studentid', $studentids)
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
                $compulsorycourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectid as subjectid', 'subjects.*')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', $currentcur)
                ->where('subjects.subjectunit', '!=', 'R')
                ->where('subjects.SubjectLevel', $student->Level-100)
                ->where('subjects.subjectunit', '!=', 'E')
                ->where('subjects.subjectcode', 'not like', 'BEA%')
                ->orderby('subjects.subjectcode')
                // ->where('subjects.subjectunit', 'E')
                ->get();
                    } else {
                        $compulsorycourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectid as subjectid', 'subjects.*')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', $currentcur)
                ->where('subjects.subjectunit', '!=', 'R')
                ->where('subjects.SubjectLevel', $student->Level-100)
                ->where('subjects.subjectunit', '!=', 'E')
                ->where('subjects.subjectcode', 'not like', 'BES%')
                ->orderby('subjects.subjectcode')
                // ->where('subjects.subjectunit', 'E')
                ->get();
                    }
        } else {
            $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectid as subjectid', 'subjects.*')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', $currentcur)
        ->where('subjects.subjectunit', '!=', 'R')
        ->where('subjects.SubjectLevel', $student->Level-100)
        ->where('subjects.subjectunit', '!=', 'E')
        ->orderby('subjects.subjectcode')
        // ->where('subjects.subjectunit', 'E')
        ->get();
        }
       

        if(Auth::user()->Level > 300){
            $compulsorycourses = collect($compulsorycourses)->where('subjectvalueco', '!=', 'E');
            $compulsorycourses->all();
        }
//  return $compulsorycourses;
        $registeredcourses = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectid as subjectid')
        ->where('sessionid', $currentsession->SessionID -1)
        ->where('studentid', $studentids)
        ->orderby('subjects.subjectcode')
        ->get();
        // return $registeredcourses;

        if(Auth::user()->Level >= 300 && $programme == 90){
            if(Auth::user()->SubCourse =='beds'){
                $CurrentCourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', $currentcur)
                ->where('subjects.SubjectLevel', $student->Level)
                ->where('subjects.subjectcode', 'not like', 'BEA%')
                ->orderby('subjects.subjectcode')
                ->get();
            } else {
                $CurrentCourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', $currentcur)
                ->where('subjects.SubjectLevel', $student->Level)
                ->where('subjects.subjectcode', 'not like', 'BES%')
                ->orderby('subjects.subjectcode')
                ->get();
            }
        } else {
        $CurrentCourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', $currentcur)
        ->where('subjects.SubjectLevel', $student->Level)
        ->orderby('subjects.subjectcode')
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
        return $majormax;
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
        $totaltnu = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->select('results.subjectid as subid', 'subjects.subjectvalue as subval')
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

        // return $course;


        $totalvalue = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $getsubject = DB::table('subjects')->where('subjectid', $subject)->where('Semester', '1')->first();
            $totalvalue += $getsubject->SubjectValue;

            // $getsubject = DB::table('subjects')->where('subjectid', $subject)->first();
            // $totalvalue += $getsubject->SubjectValue;
        }
        $totalvaluemin = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $getsubject = DB::table('subjects')->where('subjectid', $subject)->where('semester', 1)->where('subjectunit', 'C')->first();
            $totalvaluemin += $getsubject->SubjectValue;
        }

        $totalvalue2 = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $getsubject = DB::table('subjects')->where('subjectid', $subject)->where('semester', 2)->first();
            $totalvalue2 += $getsubject->SubjectValue;
        }
        $totalvalue2min = 0;
        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $getsubject = DB::table('subjects')->where('subjectid', $subject)->where('semester', 2)->where('subjectunit', 'C')->first();
            $totalvalue2min += $getsubject->SubjectValue;
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

        $totalunit = $totalvalue + $totaltnu;

        $exceeds = $totalvalue - 32;
        $lessthan = $totalvaluemin - $totalvalue;

        //second semester
        $exceeds2 = $totalvalue2 - 32;
        $lessthan2 = $totalvalue2min - $totalvalue2;

        //all
        $allunit = $totalvalue + $totalvalue2;
        $minall = $totalvaluemin + $totalvalue2min;


        // dd($totalunit.' totalvalue ='.$totalvalue.' totaltnu='.$totaltnu.' min='.$allmin.' max='.$allmax);
        //first semester
        if($totalvalue > 32 && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'You have selected excess of '.$exceeds.' Units, kindly delete '.$exceeds.' unit(s) courses to proceed.');
        }elseif($totalvalue < $totalvaluemin && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'Your selected course units is '.$lessthan.' less than the required units, kindly add more course(s) to proceed.');
        }

        //second semester
        if($totalvalue2 > 32 && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'You have selected excess of '.$exceeds2.' Units, kindly delete '.$exceeds.' unit(s) courses to proceed.');
        }elseif($totalvalue2 < $totalvalue2min && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'Your selected course units is '.$lessthan2.' less than the required units, kindly add more course(s) to proceed.');
        }

        /* if($totalunit > $allmax && Auth::user()->Level < 400)
        {
            return redirect(url()->previous())->with('error', 'You have selected excess of '.$exceeds.' Units, kindly delete '.$exceeds.' unit(s) courses to proceed.');
        }elseif($totalunit < $allmin && Auth::user()->Level < 400){
            return redirect(url()->previous())->with('error', 'Your selected course units is '.$lessthan.' less than the required units, kindly add more course(s) to proceed.');
        }elseif(($totalunit >= $allmin && $totalvalue <= $allmax) || Auth::user()->Level > 300){ */

        if(($totalvalue >= $totalvaluemin && $totalvalue2 >= $totalvalue2min && $totalvalue <= 32 && $totalvalue2 <= 32) || Auth::user()->Level > 300){

        for($i=0; $i < count($course); $i++){
            $subject = $course[$i];
            $getsubject = DB::table('subjects')->where('subjectid', $subject)->first();
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
    
    public function getMatric(Request $request){
        $jambno = $request->input('jambno');
        $getmatric = DB::table('students')
        ->select('matricno', 'firstname', 'surname', 'middlename')
        ->where('jambregno', $jambno)
        ->first();

        return view('getmatric')->with('getmatric', $getmatric);
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
