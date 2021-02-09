<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use DB;
use Auth;

class ResultviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        //return view('resultviewer.index');
    }

    public function printcount()
	{
		DB::table('printcount')->insert([
            'username' => Auth::user()->Username,
            'print_date' => date('d-m-Y'),
            'print_time' => date('h:i:sa')
        ]);
		
		return 'abc';
    }

    public function printcounter()
	{
		
		
		return view('resultviewer.printcounter');
    }
    public function printcounterstart(Request $request)
	{
        $begin = str_ireplace("/","-",trim($request->input('begin')));
        $end = str_ireplace("/","-",trim($request->input('end')));

        $begin = date_format(date_create_from_format('Y-m-d', $begin), 'd-m-Y');
        $end = date_format(date_create_from_format('Y-m-d', $end), 'd-m-Y');

        $printed = DB::table('printcount')
        ->select(DB::raw('count(*) as printcount, username'))
        ->whereBetween('print_dat', [$begin, $end])
        ->groupBy('username')
        ->get();

 		// return $printed;
		
		return view('resultviewer.printcounter')->with(compact(['printed','begin', 'end']));
    }
    
    public function search(Request $request)
        {
        // Gets the query string from our form submission 
        $sessions = DB::table('sessions')->get();

        $matricno = $request->input('matricno');
            $thesession = $request->input('sessions');
            $semester = $request->input('semester');
            $results = DB::table('results')
            ->join('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectValue as tnu', 'results.CA as CA', 'results.matricno as matricno', 'results.sessionid as sessionid','results.semester as Semester', 'results.EXAM as EXAM', 'subjects.SubjectCode as SubjectCode')
            ->where('MatricNo', $matricno)
            ->where('sessionid', $thesession)
            ->where('results.Semester', $semester)
            ->get();
            // return $results;
            
        // returns a view and passes the view the list of articles and the original query.
        return view('resultviewer.index')->with('results', $results)->with('sessions', $sessions);
        }

        public function sessions(){
        
            $sessions = DB::table('sessions')->get();
            return view('resultviewer.index')->with('sessions', $sessions);
          }
      
          public function results2(Request $request){
            //$faculty_id = Input::get('faculty_id');
            $matricno = $request->input('matricno');
            $thesession = $request->input('session');
            $semester = $request->input('semester');
            $results2 = DB::table('results')
            ->where('MatricNo', $matricno)
            ->where('session', $thesession)
            ->where('Semester', $semester)
            ->get();
            return response()->json($results2);
          }
          public function insertlecturer(){
            
            $insert= DB::table('subjects')
            ->select('departments.departmantid as deptid', 'lecturers.lecturerid as lectid')
            ->leftjoin('allcombineds','subjects.subjectid', '=', 'allcombineds.subjectid')
            ->leftjoin('departments', 'allcombineds.departmentid', '=', 'departments.departmantid')
            ->leftjoin('lecturerprofiles', 'subjects.subjectid','=', 'lecturerprofiles.subjectid')
            ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
            //->where('lecturers.surname', '!=', '')
            ->groupby('lecturers.lecturerid')
            ->get();

            foreach($insert as $linster){
            DB::table('lecturers')->where('lecturerid', $linster->lectid)
            ->update(['departmentid' => $linster->deptid]);
          } 
          return redirect('resultviewer')->with('success', 'departments updates in lecturer.');
        } 

    public function resultslip(Request $request){
        $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        $level = $request->input('level');
        $semester = $request->input('semester');

        $student = DB::table('students')
        ->where('matricno', $matricno)
        ->first();

        $thesession = DB::table('sessions')->where('sessionid', $session)->first();
        
        $major = $student->Major;
        $minor = $student->Minor;
        // return $minor.' '.$major;

        $subcom = DB::table('subjectcombinations')->where('subjectcombinname','like', $major.'/'.$minor.'%')->first();

        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        // $major = substr($subcom->SubjectCombinName, 0,3);
        // $minor = substr($subcom->SubjectCombinName, -3);
        

        $resultslip = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->select('results.*', 'subjects.subjectname as SubjectName', 'subjects.subjectcode as SubjectCode')
        // ->leftjoin('allcombinedcourses', 'results.subjectcombinid', '=', 'allcombinedcourses.subjectcombineid')
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        // ->where('allcombinedcourses.sessionid', $session)
        // ->where('allcombinedcourses.subjectcombineid', $subcom->SubjectCombinID)
        // ->groupby('results.resultid')
        ->get();
        if(count($resultslip) < 1){
            return redirect('/resultslipindex')->with('error', 'Error: Incorrect Information!');
        }

        $regunitf = DB::table('results')
        // ->selectRaw('sum(tnu) as tnu')
        ->select('tnu', DB::raw('results.ca + results.exam as examca'))
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
        
       

        
        // return $deptresults;
        $sessions = DB::table('sessions')->get();

        //compulsory courses
        $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectname as subjectnameco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectlevel as subjectlevel', 'subjects.semester as semester')
        ->where('SubjectCombineID', $resultslip[0]->SubjectCombinID)
        ->where('CurricullumID', 2)
        // ->where('subjects.SubjectLevel', $level)
        // ->where('subjects.Semester', $semester)
        ->where('subjects.subjectunit', 'C')
        ->orderby('subjects.subjectcode')
        ->get();

        if(($level=='100') && ($semester =='1')){

        include('resultslip/100-1.php');
/* 
        if(isset($resultslip) && count($resultslip) > 0){
            DB::table('printcount')->insert([
                'username' => Auth::user()->Username,
                'print_date' => date('d-m-Y'),
                'print_time' => date('h:i:sa')
            ]);
        } */

        return view('resultviewer.resultslip')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('compulsorycourses', $compulsorycourses)->with('summaryco', $summaryco);

        } elseif(($level=='100') && ($semester =='2')){
            include('resultslip/100-2.php');
        } elseif(($level=='200') && ($semester =='1')){
            include('resultslip/200-1.php');
        } elseif(($level=='200') && ($semester =='2')){
            include('resultslip/200-2.php');
        } elseif(($level=='300') && ($semester =='1')){
            include('resultslip/300-1.php');
            //view()->share('results5', $results5);
        } elseif(($level=='300') && ($semester =='2')){
            include('resultslip/300-2.php');
        } elseif(($level=='400') && ($semester =='1')){
            include('resultslip/400-1.php');
        } elseif(($level=='400') && ($semester =='2')){
            include('resultslip/400-2.php');
        }
        

        /* if(isset($resultslip) && count($resultslip) > 0){
            DB::table('printcount')->insert([
                'username' => Auth::user()->Username,
                'print_date' => date('d-m-Y'),
                'print_time' => date('h:i:sa')
            ]);
        } */

        // return $deptsummary;
        return view('resultviewer.resultslip')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('summaryco', $summaryco)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary)->with('compulsorycourses', $compulsorycourses);
    }

    public function resultslipindex(){
       
        $sessions = DB::table('sessions')->get();

        return view('resultviewer.resultslip')->with('sessions', $sessions);
    }

    //Result statement
    public function resultstmt(Request $request){
        $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        $level = $request->input('level');
        $semester = $request->input('semester');

        $student = DB::table('students')
        ->where('matricno', $matricno)
        ->first();

        $thesession = DB::table('sessions')->where('sessionid', $session)->first();

        $resultslip = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->select('results.*', 'subjects.subjectname as SubjectName', 'subjects.subjectcode as SubjectCode')
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
        // return $resultslip;
        if(count($resultslip) < 1){
            return redirect('/resultstmtindex')->with('error', 'Error: Incorrect Information!');
        }

        $regunitf = DB::table('results')
        // ->selectRaw('sum(tnu) as tnu')
        ->select('tnu', DB::raw('results.ca + results.exam as examca'))
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
        
        $subcom = DB::table('subjectcombinations')->where('subjectcombinid', $resultslip[0]->SubjectCombinID)->first();

        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);

        
        // return $deptresults;
        $sessions = DB::table('sessions')->get();

        if(($level=='100') && ($semester =='1')){

        include('statement/100-1.php');
        return view('resultviewer.statementofresult')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults);

        } elseif(($level=='100') && ($semester =='2')){
            include('statement/100-2.php');
        } elseif(($level=='200') && ($semester =='1')){
            include('statement/200-1.php');
        } elseif(($level=='200') && ($semester =='2')){
            include('statement/200-2.php');
        } elseif(($level=='300') && ($semester =='1')){
            include('statement/300-1.php');
            //view()->share('results5', $results5);
        } elseif(($level=='300') && ($semester =='2')){
            include('statement/300-2.php');
        } elseif(($level=='400') && ($semester =='1')){
            include('statement/400-2.php');
        } elseif(($level=='400') && ($semester =='2')){
            include('statement/400-2.php');
        }

        // return $resultslip[0]->SubjectCombinID;
        // return $deptsummary;
        return view('resultviewer.statementofresult')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('compulsorycourses', $compulsorycourses)->with('major', $major)->with('minor', $minor);
        /* return view('resultviewer.statementofresult')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary); */
    }

    public function resultstmtindex(){
       
        $sessions = DB::table('sessions')->get();

        return view('resultviewer.statementofresult')->with('sessions', $sessions);
    }

    //Result Transcript
    public function transcript(Request $request){
        $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        // $level = $request->input('level');
        // $semester = $request->input('semester');

        $student = DB::table('results')
        ->select('students.firstname as Firstname', 'students.surname as Surname', 'students.middlename as Middlename', 'students.matricno as MatricNo', 'results.level as Level', 'students.subcourse as subcourse', 'students.studentid as StudentID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->where('results.matricno', $matricno)
        ->orderby('Level', 'desc')
        ->first();

        if(!isset($student)){
            return redirect('/transcriptindex')->with('error', 'Sorry: Invalid Input');
        }

        if($student->Level < 300){
            return redirect('/transcriptindex')->with('error', 'Sorry: Student not in final year');
        }

        $resultcheck = DB::table('results')->where('sessionid', $session)->where('matricno', $matricno)->max('level');

        if($resultcheck < 300){
            return redirect('/transcriptindex')->with('error', 'Sorry: Please choose the final session for the student.');
        }

        $level = $student->Level;

        $thesession = DB::table('sessions')->where('sessionid', $session)->first();

        $transcript = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->select('results.*','sessions.*', 'subjects.subjectname as SubjectName', 'subjects.subjectcode as SubjectCode')
        ->where('results.sessionid', '<=', $session)
        // ->where('results.level', $level)
        // ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
// dd($level);
        

        $tlevel = DB::table('results')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->where('results.sessionid', '<=', $session)
        ->where('results.matricno', $matricno)
        ->groupby('Level')
        ->get();

        if(count($transcript) < 1){
            return redirect('/transcriptindex')->with('error', 'Error: Incorrect Information!');
        }

        $subcom = DB::table('subjectcombinations')->where('subjectcombinid', $transcript[0]->SubjectCombinID)->first();

        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);

        // dd($subcom);
        // return $deptresults;
        $sessions = DB::table('sessions')->get();
        if($level=='300'){

        include('transcript/300-2.php');
        } elseif($level=='400') {
            include('transcript/400-2.php');
            // return $prevsummary;
        }

        // return $deptsummary;
       /*  if(($level=='100') && ($semester =='1')){

        include('transcript/100-1.php');
        return view('resultviewer.transcript')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults);

        } elseif(($level=='100') && ($semester =='2')){
            include('transcript/100-2.php');
        } elseif(($level=='200') && ($semester =='1')){
            include('transcript/200-1.php');
        } elseif(($level=='200') && ($semester =='2')){
            include('transcript/200-2.php');
        } elseif(($level=='300') && ($semester =='1')){
            include('transcript/300-1.php');
            //view()->share('results5', $results5);
        } elseif(($level=='300') && ($semester =='2')){
            include('transcript/300-2.php');
        }  */

        
        return view('resultviewer.transcript')->with('transcript', $transcript)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('tlevel', $tlevel)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary)->with('compulsorycourses', $compulsorycourses);

        /* return view('resultviewer.transcript')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary); */
    }

    public function transcriptindex(){
       
        $sessions = DB::table('sessions')->get();

        return view('resultviewer.transcript')->with('sessions', $sessions);
    }


    public function academicstanding(Request $request){
        // $session=$request->input('sessions');
        $matricno = $request->input('matricno');
        // $level = $request->input('level');
        // $semester = $request->input('semester');

        $student = DB::table('results')
        ->select('students.firstname as Firstname', 'students.surname as Surname', 'students.middlename as Middlename', 'students.matricno as MatricNo', 'results.level as Level', 'students.subcourse as subcourse', 'students.studentid as StudentID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->where('results.matricno', $matricno)
        ->orderby('Level', 'desc')
        ->first();

        if(!isset($student)){
            return redirect('/academicstanding')->with('error', 'Sorry: Invalid Input');
        }


        $resultcheck = DB::table('results')->where('matricno', $matricno)->max('level');


        $level = $student->Level;

        // $thesession = DB::table('sessions')->where('sessionid', $session)->first();

        $academicstanding = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        ->select('results.*','sessions.*', 'subjects.subjectname as SubjectName', 'subjects.subjectcode as SubjectCode')
        // ->where('results.sessionid', '<=', $session)
        // ->where('results.level', $level)
        // ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
// dd($level);
        

        $tlevel = DB::table('results')
        ->leftjoin('sessions', 'results.sessionid', '=', 'sessions.sessionid')
        // ->where('results.sessionid', '<=', $session)
        ->where('results.matricno', $matricno)
        ->groupby('Level')
        ->get();

        if(count($academicstanding) < 1){
            return redirect('/transcriptindex')->with('error', 'Error: Incorrect Information!');
        }

        $subcom = DB::table('subjectcombinations')->where('subjectcombinid', $academicstanding[0]->SubjectCombinID)->first();

        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);

        // dd($subcom);
        // return $deptresults;
        $sessions = DB::table('sessions')->get();
        /* if($level=='300'){

        include('transcript/300-2.php');
        } elseif($level=='400') {
            include('transcript/400-2.php');
            // return $prevsummary;
        } */

        // return $deptsummary;
        // if(($level=='100') && ($semester =='1')){

        // include('academicstanding/100-1.php');
        

        
        return view('resultviewer.academicstanding')->with('academicstanding', $academicstanding)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('tlevel', $tlevel);

        /* return view('resultviewer.transcript')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary); */
    }

    public function academicindex(){
        $sessions = DB::table('sessions')->get();
        
        return view('resultviewer.academicstanding')->with(compact(['sessions']));
    }

    public function scorerangeindex(){
       
        $program = DB::table('subjectcombinations')->get();
        $sessions = DB::table('sessions')->get();
        return view('resultviewer.scorerange')->with('program', $program)->with('sessions', $sessions);
    }

    public function scoreranges(Request $request){
        $session=$request->input('sessions');
        $programmes = $request->input('program');
        $firstscore = $request->input('firstscore');
        $lastscore = $request->input('lastscore');
        $level = $request->input('level');
        $semester = $request->input('semester');

        $scorerange = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.SubjectCombinID')
        ->select('results.matricno as matricno', 'students.surname as surname', 'students.firstname as firstname', 'subjectcombinations.SubjectCombinName as program', 'subjects.subjectcode as subjectcode', 'results.ca as ca', 'results.exam as exam', DB::raw('results.ca + results.exam as examca'))
        ->where('sessionid', $session)
        ->where('results.subjectCombinID', $programmes)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->havingRaw('results.ca + results.exam between ? and ?', [$firstscore, $lastscore])
        // ->wherebetween('results.ca + results.exam', [$firstscore, $lastscore])
        ->get();

        $program = DB::table('subjectcombinations')->get();
        $sessions = DB::table('sessions')->get();
        return view('resultviewer.scorerange')->with('program', $program)->with('sessions', $sessions)->with('scorerange', $scorerange);

    }

    public function uploadedscoreindex(){
       
        $program = DB::table('subjectcombinations')->get();
        $sessions = DB::table('sessions')->get();
        return view('resultviewer.uploadedscore')->with('program', $program)->with('sessions', $sessions);
    }

    public function uploadedscore(Request $request){
        $session=$request->input('sessions');
        $programmes = $request->input('program');
        $firstscore = $request->input('firstscore');
        $lastscore = $request->input('lastscore');
        $level = $request->input('level');
        $semester = $request->input('semester');

        $uploadedscore = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.SubjectCombinID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->select('lecturers.surname as surname', 'lecturers.firstname as firstname', 'results.matricno as matricno', 'subjectcombinations.SubjectCombinName as program', 'subjects.subjectcode as subjectcode',  DB::raw('count(results.matricno) as total'))
        ->where('sessionid', $session)
        ->where('results.subjectCombinID', $programmes)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.ca', 0)
        ->where('results.exam', 0)
        ->groupby('results.subjectid')
        //->havingRaw('results.ca + results.exam between ? and ?', [$firstscore, $lastscore])
        // ->wherebetween('results.ca + results.exam', [$firstscore, $lastscore])
        ->get();

        $program = DB::table('subjectcombinations')->get();
        $sessions = DB::table('sessions')->get();
        return view('resultviewer.uploadedscore')->with('program', $program)->with('sessions', $sessions)->with('uploadedscore', $uploadedscore);

    }

    public function addanf(){
        $getuser = DB::table('students')->select('studentid', 'matricno')->where('registered', 'True')->where('major', 'ANF')->where('minor', 'ANF')->where('level', 200)->get();
        foreach($getuser as $gu){
           

            DB::table('results')
            ->insert(
                ['MatricNo'=>$gu->matricno,
                'SubjectID'=> 1139,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>7,
                'StudentID'=>$gu->studentid,
                'DepartmentID'=>26,
                'SubjectCombinID'=>58,
                'Level'=>200,
                'TNU'=>2,
                'Semester'=>1,
                'CTCP'=>0,
                'CTNU'=>0,
                'CTNUP'=>0,
                'TCP'=>0,
                'TNUP'=>0]);
            DB::table('results')
            ->insert(
                ['MatricNo'=>$gu->matricno,
                'SubjectID'=> 481,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>7,
                'StudentID'=>$gu->studentid,
                'DepartmentID'=>7,
                'SubjectCombinID'=>58,
                'Level'=>200,
                'TNU'=>1,
                'Semester'=>1,
                'CTCP'=>0,
                'CTNU'=>0,
                'CTNUP'=>0,
                'TCP'=>0,
                'TNUP'=>0]);
        }
       
    }
    public function resetuploadindex(){
        $courses = DB::table('subjects')->orderby('subjectcode')->get();
        return view('resultviewer.resetuploadindex')->with('courses', $courses);
    }

    public function resetupload(Request $request){
        $courses = DB::table('subjects')->orderby('subjectcode')->get();
        $subject = $request->input('subject');
        $currentsession = DB::table('sessions')->max('sessionid');

        DB::table('results')
        ->where('subjectid', $subject)
        ->where('sessionid', $currentsession)
        ->update(['CA' => 0, 'EXAM' => 0, 'LecturerInserted' => NULL, 'uploaded_by' => NULL]);

        return redirect('resetuploadindex')->with('success', 'Subject has been reset')->with('courses', $courses);
    }

    public function uploadresultindex(){
        $subjects = DB::table('subjects')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->get();
            // return $subjects;

        return view('resultviewer.resultupload')->with(compact(['subjects']));
    }
    public function uploadresult(Request $request)
    {
        
      if($request->file('imported-file'))
      {
       $subjectupload = $request->input('subject');//mustshow
        $path = $request->file('imported-file')->getRealPath();
        $thefile = $request->file('imported-file')->getClientOriginalName();
        $thefileExt = $request->file('imported-file')->getClientOriginalExtension();
        //GET only filename without extension
        $filename = pathinfo($thefile, PATHINFO_FILENAME);
        //file name and time
        $filetostore = $filename.'_'.date("Y-m-d-h-i-sa", time()).'.'.$thefileExt;

        $getcourse = DB::table('subjects')->where('subjectid', $subjectupload)->first();
        // if(strlen($getcourse->SubjectCode) > 7){
        //     $coursefilename = substr($thefile, 0, 10);
        // } else {
        //     $coursefilename = substr($thefile, 0, 7);
        // }
        $coursestrlen = strlen($getcourse->SubjectCode);
        $coursefilename = substr($thefile, 0, $coursestrlen);
        // $getcourse = DB::table('subjects')->where('subjectid', $subjectupload)->first();

        if(trim($coursefilename) !== ($getcourse->SubjectCode)) {

            return redirect('lecturer/resultupload')->with('error', 'Sorry the file selected does not match the course selected. You selected "'.$thefile.'" for '.$getcourse->SubjectCode.'.  Kindly follow this order, if course name is e.g. CHE 112, then the file name must begin with CHE 112.');
        }
                $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
                Excel::load($path)->each(function (Collection $csvLine) use($subjectupload) {
                    $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
                    // $lecturerid = Auth::user()->LecturerID;
                    $csvca = $csvLine->get('ca');//ca
                    $csvexam = $csvLine->get('exam');//exam
                    if($csvca == '' || $csvca == NULL){
                        $csvca = 0;
                    }
                    if($csvexam == '' || $csvexam == NULL){
                        $csvexam = 0;
                    }
                    
                    /* DB::table('results')
                        ->where('results.MatricNo', $csvLine->get('matricno'))
                        ->where('results.SubjectID', $subjectupload)
                        ->where('results.sessionid', $sessions->SessionID)
                        ->where('results.CA', 0)
                        ->orWhere('results.EXAM', 0)
                        //->where('SubjectID', $subjectupload)
                        ->update(['CA' => $csvLine->get('ca'),'EXAM' => $csvLine->get('exam')]); */
                    if($csvLine->get('resultid') !== null){
                        //do something
                        DB::table('results')
                        ->where('results.resultid', $csvLine->get('resultid'))
                        ->where('results.EXAM', 0)
                        ->where('results.CA', 0)                        
                        ->update(['CA' => $csvca,'EXAM' => $csvexam, 'LecturerInserted' => 'TRUE', 'uploaded_by' => 'Admin']);
                    }
                        
               });
               //result file on
               $path = $request->file('imported-file')->storeAs('public/osresults', $filetostore);
        return redirect('uploadresultindex')->with('success','Upload Successful.');
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
