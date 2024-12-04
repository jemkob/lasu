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
        $matricdetails = DB::table('students')->where('matricno', $matricno)->first();
        $matricno = DB::table('students')->where('matricno', $matricno)->first();

        
        if(!empty($matricno)){
            $deptid = $matricno->Department;
            $matricno = $matricno->MatricNo;
        } else{
            return redirect()->back()->with('error', 'Student registration not found!');
        }
        
        // $semester = $request->input('semester');
        // $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();

        // dd($matricno);

        $courseview = DB::table('results')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('departments', 'departments.DepartmentID', '=', 'results.DepartmentID')
        ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->select( 'allcombinedcourses.coursetitle as subjectname', 'allcombinedcourses.coursecode as subjectcode', 'allcombinedcourses.courseunit as subjectunit', 'allcombinedcourses.coursestatus as subjectvalue', 'allcombinedcourses.courseid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'results.resultid as resultid', 'results.matricno as matricno', 'results.studentid as studentid', 'results.ca as ca', 'results.exam as exam', 'results.sessionid as sessionid', 'results.level as resultlevel', 'results.departmentid as departmentid')
        ->where('results.matricno', $matricno)
        // ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.departmentid', $deptid)
        ->orderby('allcombinedcourses.coursecode')
        // ->where('results.semester', $semester)
        ->get();
// return $courseview;

        if(isset($courseview) && count($courseview) < 1){

            return redirect()->back()->with('error', 'No course registration found for the student.');
        }


        $subjects = DB::table('allcombinedcourses')
        ->where('sessionid', $currentsession->SessionID)
        ->where('departmentid', $courseview[0]->departmentid)
        ->orderby('coursecode')
        ->get();

        //get all data again
        $sessions = DB::table('sessions')->get();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.index')->with('courseview', $courseview)->with('sessions', $sessions)->with('subjects', $subjects)->with('currentsession', $currentsession);
        }

        public function searchByAdmissionCode(Request $request)
        {
        
        // Gets the query string from our form submission 
        //$faculty = $request->input('faculties');
        $matricno = $request->input('matricno');
        $matricdetails = DB::table('students')->where('admissioncode', $matricno)->first();
        $matricno = DB::table('students')->where('admissioncode', $matricno)->first();

       
        
        if(!empty($matricno)){ 
            $deptid = $matricno->Department;
            $matricno = $matricno->AdmissionCode;
        } else{
            return redirect()->back()->with('error', 'Student registration not found!');
        }
        
        // $semester = $request->input('semester');
        // $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();

        // dd($matricno);

        $courseview = DB::table('results')
        ->leftjoin('students', 'results.matricno', '=', 'students.admissioncode')
        ->leftjoin('departments', 'departments.DepartmentID', '=', 'results.DepartmentID')
        ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->select( 'allcombinedcourses.coursetitle as subjectname', 'allcombinedcourses.coursecode as subjectcode', 'allcombinedcourses.courseunit as subjectunit', 'allcombinedcourses.coursestatus as subjectvalue', 'allcombinedcourses.courseid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'results.resultid as resultid', 'results.matricno as matricno', 'results.studentid as studentid', 'results.ca as ca', 'results.exam as exam', 'results.sessionid as sessionid', 'results.level as resultlevel', 'results.departmentid as departmentid')
        ->where('results.matricno', $matricno)
        // ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.departmentid', $deptid)
        ->orderby('allcombinedcourses.coursecode')
        // ->where('results.semester', $semester)
        ->get();
// return $courseview;

        if(isset($courseview) && count($courseview) < 1){

            return redirect()->back()->with('error', 'No course registration found for the student.');
        }


        $subjects = DB::table('allcombinedcourses')
        ->where('sessionid', $currentsession->SessionID)
        ->where('departmentid', $courseview[0]->departmentid)
        ->orderby('coursecode')
        ->get();

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
        $matricno = DB::table('students')->where('matricno', $matricno)->first();
        $deptid = $matricno->Department;

        if(!empty($matricno)){
            $matricno = $matricno->MatricNo;
        } else{
            $matricno = $request->input('matricno');
        }
        // $semester = $request->input('semester');
        $sessionid = $request->input('sessions');
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $currentsession = DB::table('sessions')->where('sessionid', $sessionid)->first();

        $courseview = DB::table('results')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->leftjoin('departments', 'departments.DepartmentID', '=', 'results.DepartmentID')
        ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->select( 'allcombinedcourses.coursetitle as subjectname', 'allcombinedcourses.coursecode as subjectcode', 'allcombinedcourses.courseunit as subjectunit', 'allcombinedcourses.coursestatus as subjectvalue', 'allcombinedcourses.courseid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'results.resultid as resultid', 'results.matricno as matricno', 'results.studentid as studentid', 'results.ca as ca', 'results.exam as exam', 'results.sessionid as sessionid', 'results.level as resultlevel', 'results.departmentid as departmentid')
        ->where('results.matricno', $matricno)
        // ->orwhere('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.departmentid', $deptid)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->orderby('allcombinedcourses.coursecode')
        ->get();

        $subjects = DB::table('allcombinedcourses')
        ->where('sessionid', $currentsession->SessionID)
        ->where('departmentid', $deptid)
        ->orderby('coursecode')
        ->get();

        //get all data again
        $sessions = DB::table('sessions')->get();
        // returns a view and passes the view the list of articles and the original query.
        return view('courseregistration.courseformbysession')->with('courseview', $courseview)->with('sessions', $sessions)->with('subjects', $subjects)->with('currentsession', $currentsession);
        }


        public function addcourse(Request $request){
            $resultid = $request->input('resultid');
            $subject = $request->input('addsubject');
            $matric = $request->input('matric');
            $cursession = $request->input('cursession');
            $resultlevel = $request->input('resultlevel');
            $currentsession = DB::table('sessions')->where('currentsession', true)->first();
            $department = $request->department;

            $getsubject = DB::table('courses')->where('id', $subject)->first();

            $getstudent = DB::table('students')->where('matricno', $matric)->orwhere('AdmissionCode', $matric)->first();
           

            $getdetails = DB::table('results')
            ->where('resultid', $resultid)
            ->first();

            $checksubject = DB::table('results')
            ->where('matricno', $matric)
            // ->where('studentid', $getstudent->StudentID)
            ->where('sessionid', $cursession)
            ->where('subjectid', $subject)
            ->get();
           
            if(count($checksubject) > 0){
                return redirect('/courseregistration')->with('error', $getsubject->CourseCode.' already exist in the course form of student with Matric No.: '.$getdetails->MatricNo);
            } else {
            DB::table('results')
            ->insert(
                ['MatricNo'=>$matric,
                'StudentID'=>$getstudent->StudentID,
                'SubjectID'=> $subject,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>$cursession,
                'DepartmentID'=>$department,
                'Level'=>$resultlevel,
                ]);

            return redirect('/courseregistration')->with('success', $getsubject->CourseCode.' has been added to the course form of student with Matric No.: '.$getdetails->MatricNo);
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
            ->leftjoin('courses', 'courses.id', '=', 'results.subjectid')
            ->select('courses.coursecode as subjectcode', 'results.matricno as matricno')
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
        

        if(!empty($matricno->MatricNo)){
            $matricno = $matricno->StudentID;
        } else{
            $matricno = $request->input('matricno');
        }
        // $sessionid = $request->input('sessions');
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();
        //$programme = $request->input('programmes');
        //$level = $request->input('level');
        $thestudent=DB::table('students')->where('matricno', $request->matricno)->first();
        // dd($thestudent);
        $program = DB::table('subjectcombinations')->where('subjectcombinname', $thestudent->Major.'/'.$thestudent->Minor)->first();

        if($thestudent->Level < 400){
        $courseview = DB::table('results')
        ->leftjoin('allcombinedcourses', 'allcombinedcourses.subjectid', '=', 'results.subjectid')
        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        // ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->select( 'allcombinedcourses.subjectname as subjectname', 'allcombinedcourses.subjectcode as subjectcode', 'allcombinedcourses.subjectunit as subjectunit', 'allcombinedcourses.subjectvalue as subjectvalue', 'allcombinedcourses.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        // ->where('results.matricno', $matricno)
        ->where('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.subjectcombineid', $program->SubjectCombinID)
        ->where('results.semester', 1)
        ->groupby('results.subjectid')
        // ->orderby('subjects.subjectcode')
        ->orderby('allcombinedcourses.subjectcode');

        $courseview = DB::table('results')
        ->leftjoin('allcombinedcourses', 'allcombinedcourses.subjectid', '=', 'results.subjectid')
        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        // ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->select( 'allcombinedcourses.subjectname as subjectname', 'allcombinedcourses.subjectcode as subjectcode', 'allcombinedcourses.subjectunit as subjectunit', 'allcombinedcourses.subjectvalue as subjectvalue', 'allcombinedcourses.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        // ->where('results.matricno', $matricno)
        ->where('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID-1)
        ->where('allcombinedcourses.subjectcombineid', $program->SubjectCombinID)
        ->where('results.semester', 1)
        ->groupby('results.subjectid')
        // ->orderby('subjects.subjectcode')
        ->orderby('allcombinedcourses.subjectcode')
        ->unionall($courseview)
        ->get();

        $courseview = $courseview->unique('subjectcode')->sortBy('subjectcode');

        $courseview->values()->all();

        $courseview1 = DB::table('results')
        ->leftjoin('allcombinedcourses', 'allcombinedcourses.subjectid', '=', 'results.subjectid')
        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        // ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->select( 'allcombinedcourses.subjectname as subjectname', 'allcombinedcourses.subjectcode as subjectcode', 'allcombinedcourses.subjectunit as subjectunit', 'allcombinedcourses.subjectvalue as subjectvalue', 'allcombinedcourses.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        // ->where('results.matricno', $matricno)
        ->where('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.subjectcombineid', $program->SubjectCombinID)
        ->where('results.semester', 2)
        ->groupby('results.subjectid')
        // ->orderby('subjects.subjectcode')
        ->orderby('allcombinedcourses.subjectcode');

        $courseview1 = DB::table('results')
        ->leftjoin('allcombinedcourses', 'allcombinedcourses.subjectid', '=', 'results.subjectid')
        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('lecturerprofiles', 'results.subjectid', '=', 'lecturerprofiles.subjectid')
        ->leftjoin('lecturers', 'lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        // ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        ->select( 'allcombinedcourses.subjectname as subjectname', 'allcombinedcourses.subjectcode as subjectcode', 'allcombinedcourses.subjectunit as subjectunit', 'allcombinedcourses.subjectvalue as subjectvalue', 'allcombinedcourses.subjectid as subjectid', 'students.surname as surname', 'students.firstname as firstname', 'students.middlename as middlename', 'students.major as major', 'students.minor as minor', 'lecturers.surname as lsurname', 'lecturers.firstname as lfirstname')
        // ->where('results.matricno', $matricno)
        ->where('results.studentid', $matricno)
        ->where('results.sessionid', $currentsession->SessionID)
        ->where('allcombinedcourses.sessionid', $currentsession->SessionID-1)
        ->where('allcombinedcourses.subjectcombineid', $program->SubjectCombinID)
        ->where('results.semester', 2)
        ->groupby('results.subjectid')
        // ->orderby('subjects.subjectcode')
        ->orderby('allcombinedcourses.subjectcode')
        ->unionall($courseview1)
        ->get();

        $courseview1 = $courseview1->unique('subjectcode')->sortBy('subjectcode');

        $courseview1->values()->all();
        } else {
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
        }


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
    public function cancelRegIndex(){
        return view('courseregistration.cancel');
    }

    public function cancelRegistration(Request $request){
        $studentid = $request->input('studentid');
        $student = DB::table('students')->where('matricno', $studentid)->orwhere('jambregno', $studentid)->first();
        if(!$student){
            return redirect()->back()->with('error', 'Invalid student information.');
        }
        // $combination = DB::table('subjectcombination')->where('subjectcombinName', $student->Major.'/'.$student->Minor)->first();

        // if(!$combination){
        //     return redirect()->back()->with('error', 'Invalid Subject combination.');
        // }
        
        $currentsession = DB::table('sessions')->where('currentsession', true)->first();

        $results = DB::table('results')->where('studentid', $student->StudentID)->where('sessionid', $currentsession->SessionID)->get();
        
        $examca = 0;
        foreach($results as $res){
            $examca += $res->EXAM + $res->CA;
        }
        if($examca > 0){
            return redirect()->back()->with('error', 'Registration cannot be nullified, Student has scores for this session.');
        }
        DB::table('results')
        ->where('studentid', $student->StudentID)
        ->where('sessionid', $currentsession->SessionID)
        ->delete();

        DB::table('students')->where('studentid', $student->StudentID)->update(['Registered'=> NULL]);

        return redirect()->back()->with('success', 'Registration has been cancelled for student with '.$studentid.'.');
        

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
