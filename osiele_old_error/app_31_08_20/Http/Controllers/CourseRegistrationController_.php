<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('sessions')->get();

        return view('courseregistration.index')->with('sessions', $sessions);
    }
    public function printindex()
    {
        $sessions = DB::table('sessions')->get();

        return view('courseregistration.printcourseform')->with('sessions', $sessions);
    }
    public function printbysessionindex()
    {
        $sessions = DB::table('sessions')->get();

        return view('courseregistration.printcourseformbysession')->with('sessions', $sessions);
    }
    public function coursesessionindex()
    {
        $sessions = DB::table('sessions')->get();

        return view('courseregistration.courseformbysession')->with('sessions', $sessions);
    }
    public function editindex()
    {
        $sessions = DB::table('sessions')->get();

        return view('courseregistration.editcourseform')->with('sessions', $sessions);
    }

    public function search(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricno = DB::table('students')->where('matricno', $matricno)->orwhere('jambregno', $matricno)->first();
        if(!empty($matricno)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }
        
        // $semester = $request->input('semester');
        // $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();

        $courseview = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'results.resultid as resultid', 'results.matricno as matricno', 'results.studentid as studentid', 'results.ca as ca', 'results.exam as exam', 'results.sessionid as sessionid', 'results.level as resultlevel')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->orderby('results.semester')
        ->orderby('subjects.subjectcode')
        // ->where('results.semester', $semester)
        ->get();

        $subjects = DB::table('subjects')->orderby('subjectcode')->get();

        //get all data again
        $sessions = DB::table('sessions')->get();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.index')->with('courseview', $courseview)->with('sessions', $sessions)->with('subjects', $subjects)->with('currentsession', $currentsession);
        }

        public function searchbysession(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricno = DB::table('students')->where('matricno', $matricno)->orwhere('jambregno', $matricno)->first();
        if(!empty($matricno)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }
        // $semester = $request->input('semester');
        $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $currentsession = DB::table('sessions')->where('sessionid', $sessionid)->first();

        $courseview = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'results.resultid as resultid', 'results.matricno as matricno', 'results.studentid as studentid', 'results.ca as ca', 'results.exam as exam', 'results.sessionid as sessionid', 'results.level as resultlevel')
        ->where('results.matricno', $matricno) 
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $sessionid)
        ->orderby('results.semester')
        ->orderby('subjects.subjectcode')
        // ->where('results.semester', $semester)
        ->get();

        $subjects = DB::table('subjects')->orderby('subjectcode')->get();

        //get all data again
        $sessions = DB::table('sessions')->get();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.courseformbysession')->with('courseview', $courseview)->with('sessions', $sessions)->with('subjects', $subjects)->with('currentsession', $currentsession);
        }


        public function addcourse(Request $request){
            $resultid = $request->input('resultid');
            $subject = $request->input('addsubject');
            $studentid = $request->input('studentid');
            $matric = $request->input('matric');
            $cursession = $request->input('cursession');
            $resultlevel = $request->input('resultlevel');
            $currentsession = DB::table('sessions')->where('currentsession', true)->first();

            $getsubject = DB::table('subjects')->where('subjectid', $subject)->first();

            $getstudent = DB::table('students')->where('studentid', $studentid)->first();
            $studentLevel = $getstudent->Level;
            if(empty($getstudent->Registered)){
                $studentLevel = $studentLevel - 100;
            }

            $deptcode = substr($getsubject->SubjectCode, 0, 3);
            if($deptcode=='BES' || $deptcode =='BEA'){
                $deptcode = 'BED';
            }
            

            $getsubjectdept = DB::table('departments')->where('departmentcode', 'like', '%'.$deptcode.'%')->first();

            if($deptcode == 'ESA'){
                $getsubjectdept = DB::table('departments')->where('departmentcode', 'DEWS')->first();
            }

            if($getsubject->SubjectCode == 'EDU 311'){
                $getsubjectdept = DB::table('departments')->where('departmentcode', 'TP')->first();
            }

            $getdetails = DB::table('results')
            ->where('resultid', $resultid)
            ->first();

            $checksubject = DB::table('results')
            // ->where('matricno', $matric)
            ->where('studentid', $getstudent->StudentID)
            // ->where('sessionid', $currentsession->SessionID)
            ->where('sessionid', $cursession)
            ->where('subjectid', $subject)
            ->get();
           
            if(count($checksubject) > 0){
                return redirect('/courseregistration')->with('error', $getsubject->SubjectCode.' already exist in the course form of student with Matric No.: '.$getdetails->MatricNo);
            } else {
            DB::table('results')
            ->insert(
                ['MatricNo'=>$matric,
                'SubjectID'=> $subject,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>$cursession,
                'StudentID'=>$studentid,
                'DepartmentID'=>$getsubjectdept->DepartmantID,
                'SubjectCombinID'=>$getdetails->SubjectCombinID,
                'Level'=>$resultlevel,
                'TNU'=>$getsubject->SubjectValue,
                'Semester'=>$getsubject->Semester,
                'CTCP'=>0,
                'CTNU'=>0,
                'CTNUP'=>0]);

            return redirect('/courseregistration')->with('success', $getsubject->SubjectCode.' has been added to the course form of student with Matric No.: '.$getdetails->MatricNo);
            }//end else checksubject
        }

        public function deletecourse(Request $request){
            $resultid = $request->input('resultid');

            $iresultid ="";
            for($i=0; $i < count($resultid); $i++){
                // echo $resultid[$i].'<br>';
               $iresultid .= $resultid[$i].', ';
              } 

              $iresultid = rtrim($iresultid, ', ');

             $getdetails = DB::table('results')
            ->leftjoin('subjects', 'results.subjectid', '=', 'subjects.subjectid')
            ->select('subjects.subjectcode as subjectcode', 'results.matricno as matricno')
            // ->where('resultid', $resultid)
            ->whereRaw('resultid in ('.$iresultid.')')
            ->get(); 
            $deletedcourses = "";
            foreach($getdetails as $details){
                $deletedcourses .= $details->subjectcode.', ';
            }
            $deletedcourses = rtrim($deletedcourses, ', ');

            DB::table('results')
            ->whereRaw('resultid in ('.$iresultid.')')
            ->delete();         
            

            
            return redirect('/courseregistration')->with('success', $deletedcourses.' has been deleted from the course form of student with Matric No.: '.$getdetails[0]->matricno);
        }

        public function printcourse(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricno = DB::table('students')->where('matricno', $matricno)->orwhere('jambregno', $matricno)->first();
        if(empty($matricno->MatricNo)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }
        // $sessionid = $request->input('sessions');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        //$programme = $request->input('programmes');
        //$level = $request->input('level');

        $courseview = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('results.semester', 1)
        ->groupby('results.subjectid')
        ->orderby('subjects.subjectcode')
        ->get();

        $courseview1 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('results.semester', 2)
        ->groupby('results.subjectid')
        ->orderby('subjects.subjectcode')
        ->get();


        $students = DB::table('students')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();
        $studentimage = DB::table('studentimages')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();

        //get all data again
        $sessions = DB::table('sessions')->get();
        $ses = DB::table('sessions')->where('sessionid', $currentsession->SessionID)->first();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.printcourseform')->with('courseview', $courseview)->with('courseview1', $courseview1)->with('sessions', $sessions)->with('ses', $ses)->with('students', $students)->with('studentimage', $studentimage);
        }

        public function printcoursebysession(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricno = DB::table('students')->where('matricno', $matricno)->orwhere('jambregno', $matricno)->first();
        if(!empty($matricno)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }

        $sessionid = $request->input('sessions');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        //$programme = $request->input('programmes');
        //$level = $request->input('level');

        $courseview = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $sessionid)
        ->where('results.semester', 1)
        ->groupby('results.subjectid')
        ->orderby('subjects.subjectcode')
        ->get();

        $courseview1 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $sessionid)
        ->where('results.semester', 2)
        ->groupby('results.subjectid')
        ->orderby('subjects.subjectcode')
        ->get();


        $students = DB::table('students')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();
        $studentimage = DB::table('studentimages')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();

        //get all data again
        $sessions = DB::table('sessions')->get();
        $ses = DB::table('sessions')->where('sessionid', $sessionid)->first();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.printcourseformbysession')->with('courseview', $courseview)->with('courseview1', $courseview1)->with('sessions', $sessions)->with('ses', $ses)->with('students', $students)->with('studentimage', $studentimage);
        }

        public function editcourse(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricno = DB::table('students')->where('matricno', $matricno)->orwhere('jambregno', $matricno)->first();
        if(!empty($matricno)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }

        $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');

        $courseview = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $sessionid)
        ->where('results.semester', 1)
        ->get();

        $courseview1 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor')
        ->where('results.matricno', $matricno)
        ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $sessionid)
        ->where('results.semester', 2)
        ->get();


        $students = DB::table('students')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();
        $studentimage = DB::table('studentimages')->where('matricno', $matricno)->orwhere('studentid', $matricno)->first();

        //get all data again
        $sessions = DB::table('sessions')->get();
        $ses = DB::table('sessions')->where('sessionid', $sessionid)->first();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.printcourseform')->with('courseview', $courseview)->with('courseview1', $courseview1)->with('sessions', $sessions)->with('ses', $ses)->with('students', $students)->with('studentimage', $studentimage);
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
