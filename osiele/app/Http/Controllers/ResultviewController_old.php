<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

        $resultslip = DB::table('results')
        ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
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
        
        $subcom = DB::table('subjectcombinations')->where('subjectcombinid', $resultslip[0]->SubjectCombinID)->first();

        // $majorminor = str_ireplace("/",", ",$subcom->SubjectCombinName);
        $major = substr($subcom->SubjectCombinName, 0,3);
        $minor = substr($subcom->SubjectCombinName, -3);

        
        // return $deptresults;
        $sessions = DB::table('sessions')->get();

        //compulsory courses
        $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectname as subjectnameco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('SubjectCombineID', $resultslip[0]->SubjectCombinID)
        ->where('CurricullumID', 2)
        ->where('subjects.SubjectLevel', $level)
        ->where('subjects.Semester', $semester)
        ->where('subjects.subjectunit', 'C')
        ->orderby('subjects.subjectcode')
        ->get();

        if(($level=='100') && ($semester =='1')){

        include('resultslip/100-1.php');
        return view('resultviewer.resultslip')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('compulsorycourses', $compulsorycourses);

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
        } 

        

        // return $summary;
        return view('resultviewer.resultslip')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary)->with('compulsorycourses', $compulsorycourses);
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
        ->where('results.sessionid', $session)
        ->where('results.level', $level)
        ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();
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
        } 

        return view('resultviewer.statementofresult')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('regunitf', $regunitf)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('compulsorycourses', $compulsorycourses);
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
        ->select('students.firstname as Firstname', 'students.surname as Surname', 'students.middlename as Middlename', 'students.matricno as MatricNo', 'results.level as Level', 'students.subcourse as subcourse')
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
        ->where('results.sessionid', '<=', $session)
        // ->where('results.level', $level)
        // ->where('results.semester', $semester)
        ->where('results.matricno', $matricno)
        ->get();

        

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

        
        // return $deptresults;
        $sessions = DB::table('sessions')->get();
        include('transcript/300-2.php');
        // return $prevsummary;
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

        
        return view('resultviewer.transcript')->with('transcript', $transcript)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('tlevel', $tlevel)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary);

        /* return view('resultviewer.transcript')->with('resultslip', $resultslip)->with('sessions', $sessions)->with('student', $student)->with('subcom', $subcom)->with('thesession', $thesession)->with('summary', $summary)->with('deptsummary', $deptsummary)->with('deptresults', $deptresults)->with('prevdeptresults', $prevdeptresults)->with('prevsummary', $prevsummary); */
    }

    public function transcriptindex(){
       
        $sessions = DB::table('sessions')->get();

        return view('resultviewer.transcript')->with('sessions', $sessions);
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
