<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Allcombined;
use App\AllcombinedCourse;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();
        // $programmes = DB::table('subjectcombinations')->get();
        $faculties = DB::table('faculties')->get();

        $curriculums = DB::table('allcombinedcourses')
        ->paginate(50);

        return view('CurriculumManager.index')->with(compact('curriculums', 'faculties', 'departments', 'sessions'));
    }

    public function search(Request $request)
        {
        //get all data again
        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();


        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $department = $request->input('departments');
        $thesession = $request->input('sessions');
        $level = $request->input('level');

        $faculties = DB::table('faculties')->get();
            

        $curriculumsview = DB::table('allcombinedcourses')
        // ->join('subjects', 'allcombinedcourses.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('department', 'allcombinedcourses.DepartmentID', '=', 'department.DepartmentID')
        ->select('allcombinedcourses.*', 'allcombinedcourses.coursetitle as coursetitle', 'allcombinedcourses.coursecode as coursecode', 'allcombinedcourses.courseunit as courseunit', 'allcombinedcourses.coursestatus as coursestatus', 'allcombinedcourses.courseid as courseid')
        ->where('allcombinedcourses.departmentid', $department)
        ->where('allcombinedcourses.sessionid', $thesession)
        // ->where('subjects.semester', $semester)
        ->where('allcombinedcourses.courselevel', $level)
        // ->where('curricullumID', $curriculuminplace)
        //->where('departments.facultyid', $faculty)
        ->orderby('allcombinedcourses.coursecode')
        ->get();


            
            
        // returns a view and passes the view the list of curriculum and the original query.
        return view('CurriculumManager.index')->with('curriculumsview', $curriculumsview)->with('faculties', $faculties)->with('departments', $departments)->with('sessions', $sessions);
        }

        public function editcourse(Request $request){

        }

        public function deletecourse(Request $request){
            $subcurricullum = $request->input('subcurricullum');
            $subjectid = $request->input('subjectid');

           /*  $iresultid ="";
            for($i=0; $i < count($resultid); $i++){
                // echo $resultid[$i].'<br>';
               $iresultid .= $resultid[$i].', ';
              } 

              $iresultid = rtrim($iresultid, ', '); */

             $getdetails = DB::table('courses')
            ->select('coursecode')
            ->where('id', $subjectid)
            // ->whereRaw('resultid in ('.$iresultid.')')
            ->first(); 

            /* $deletedcourses = "";
            foreach($getdetails as $details){
                $deletedcourses .= $details->subjectcode.', ';
            }
            $deletedcourses = rtrim($deletedcourses, ', '); */
            $course = DB::table('allcombinedcourses')->where('id', $subcurricullum)->first();

            // $resultcheck = DB::table('results')->where('subjectcombinid', $course->SubjectCombineID)
            // ->where('subjectid', $course->SubjectID)
            // ->where('sessionid', $course->sessionid)
            // ->where('subjectcombinid', $course->SubjectCombineID)
            // ->get();

            // $examca = 0;
            // foreach($resultcheck as $result){
            //     $examca = $examca + $result->CA + $result->EXAM;
            // }
            // if($examca > 0){
            //     return redirect(url()->previous())->with('error','You cannot delete a course with score.');
            // }
            
            // DB::table('results')
            // ->where('subjectid', $course->SubjectID)
            // ->where('sessionid', $course->sessionid)
            // ->where('subjectcombinid', $course->SubjectCombineID)
            // ->delete();

            // dd($subcurricullum);

            DB::table('allcombinedcourses')
            // ->whereRaw('resultid in ('.$iresultid.')')
            ->where('id', $subcurricullum)
            ->delete();

            $theurl = url()->previous();            

            
            return redirect($theurl)->with('success', $getdetails->coursecode.' has been deleted from the Curriculum');
        }


        public function jsfaculties(){
            $jsfaculties = DB::table('faculties')->get();
            return view('CurriculumManager.searches')->with('jsfaculties', $jsfaculties);
          }
      
          //autoload departments
          public function jsdepartments(Request $request){
            $faculty_id = $request->input('faculty_id');
            $jsdepartments = DB::table('departments')->where('FacultyID', '=', $faculty_id)->orderby('departmentname')->get();
            return response()->json($jsdepartments);
          }
      
          public function jsprogrammes(Request $request){
        //     $department_id = $request->input('department_id');
        //     //SELECT DISTINCT SubjectCombineID FROM `allcombineds` WHERE DepartmentID = 7

        //     /* $jsprogrammes = DB::table('allcombineds')
        // ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        // ->selectRaw('distinct allcombineds.SubjectCombineID, subjectcombinations.SubjectCombinName as SubjectCombinName, subjectcombinations.SubjectCombinID as SubjectCombinID')
        // //->groupBy('subjectcombineid')
        // ->where('DepartmentID', $department_id)->get(); */

        //     $thedepartment = DB::table('departments')->where('DepartmantID', $department_id)->first();
        //     $deptcode = $thedepartment->DepartmentCode;
        //     $deptlike = $deptcode.'%';
        //     //$deptlike2 = '%'.$deptcode;
        //     $jsprogrammes = DB::table('subjectcombinations')->where('SubjectCombinName', 'like', $deptlike)->orderby('SubjectCombinName')->get();
        //     return response()->json($jsprogrammes);
          }

    public function curriculumcourses(Request $request){
        // $combination = 'isc/che';
        // $level = 300;
        // $combinationid = 80;
        // $session = 8;

        $department = $request->input('combination');
        $level = $request->input('level');
        $session = $request->input('sessions');

        $departments = DB::table('departments')->where('departmentid', $department)->first();

        $lev= substr($level, 0,1);


        $getcoursesincurriculum = DB::table('allcombinedcourses')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('CourseLevel='.$level.' and sessionid = '.$session.' and departmentid='.$combinationid)
        ->pluck('courseid');

        $getcourses = DB::table('courses')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('CourseLevel='.$level)
        ->whereNotIn('Id', $getcoursesincurriculum)
        ->get();

        
        
        
        // return $getcourses;

        

        return response()->json($getcourses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newcurriculum(Request $request)
    {
        //get form contents
        $faculties = $request->input('faculties');
        $department = $request->input('departments');
        $thesession = $request->input('sessions');
        $level = $request->input('level');
        
        $course = $request->input('subjectid');
        $active = 1;

        for($i=0; $i < count($course); $i++){
            $course = $course[$i];
            $getsubject = DB::table('courses')->where('id', $course)->first();
            
            $getsubjectdept = DB::table('department')->where('departmentid', $department)->first();
            
           
           // echo $matric[$i].' '.$ca[$i].' '.$exam[$i].'<br>';

           DB::table('allcombinedcourses')
            ->insert(
                [
                'CourseID'=>$getsubject->Id,
                'CurricullumID'=>$thesession,
                'SessionID'=>$thesession,
                
                'DepartmentID'=>$programme,
                'CourseLevel'=>$getsubject->CourseLevel,
                'CourseCode'=>$getsubject->CourseCode,
                'CourseTitle'=>$getsubject->CourseTitle,
                'CourseUnit'=>$getsubject->CourseUnit,
                'CourseStatus'=>$getsubject->CourseStatus
                ]);
            }

        /* $subjects = new Course;
        $subjects->SubjectName = $coursetitle;
        $subjects->SubjectCode = $coursecode;
        $subjects->SubjectValue = $coursestatus;
        $subjects->SubjectUnit = $courseunit;
        $subjects->Semester = $semester;
        $subjects->SubjectLevel = $level;
        $subjects->Active = $active;
        $subjects->save(); */

        // return response()->json('Curriculum Added Successfully.');

        $departments = DB::table('department')->get();
        $sessions = DB::table('sessions')->get();
        $programmes = DB::table('department')->get();
        
        // DB::table('subjects')->insert(
        //     [
        //         'SubjectName' => $coursetitle,
        //         'SubjectCode' => $coursecode,
        //         'SubjectValue' => $coursestatus,
        //         'SubjectUnit' => $courseunit,
        //         'Active' => 1,
        //         'Semester' => $semester,
        //         'SubjectLevel' => $level,
        //         'DepartmentID' => $department
        //         ]
        // );

        return redirect('CurriculumManager/create')->with('sessions', $sessions)->with('departments', $departments)->with('success', 'Curriculum Added');
    }

    public function addtocurriculum(Request $request)
    {
        //get form contents
        $faculties = $request->input('faculties');
        $department = $request->input('departments');
        $thesession = $request->input('sessions');
        $level = $request->input('level');
        
        $course = $request->input('course');
        $active = 1;

        // for($i=0; $i < count($course); $i++){
            
            $getsubject = DB::table('courses')->where('id', $course)->first();
            
            $getsubjectdept = DB::table('department')->where('departmentid', $department)->first();
           
            // }
            DB::table('allcombinedcourses')
            ->insert(
                [
                'CourseID'=>$getsubject->Id,
                'SessionID'=>$thesession,
                
                'DepartmentID'=>$department,
                'CourseLevel'=>$getsubject->CourseLevel,
                'CourseCode'=>$getsubject->CourseCode,
                'CourseTitle'=>$getsubject->CourseTitle,
                'CourseUnit'=>$getsubject->CourseUnit,
                'CourseStatus'=>$getsubject->CourseStatus
                ]);
            
    

        // return response()->json('Curriculum Added Successfully.');

        $departments = DB::table('department')->get();
        $sessions = DB::table('sessions')->get();
        $programmes = DB::table('department')->get();
        $faculties = DB::table('faculties')->get();
        

        return redirect('CurriculumManager/create')->with('sessions', $sessions)->with('departments', $departments)->with('success', 'Course added to Curriculum.');
    }

    public function thecur(Request $request){

        $level = $request->input('level');
        $session = $request->input('session');

        $combination = DB::table('subjectcombinations')->get();
        

        foreach($combination as $combi){

            $combination = $combi->SubjectCombinName;
            $combinationid = $combi->SubjectCombinID;

            $major = substr($combination, 0,3);
            $minor = substr($combination, -3);

        if($major == 'BED' && $level == 300){
            $getcoursesincurriculum = DB::table('allcombinedcourses')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('SubjectLevel='.$level.' and sessionid ='.$session.' and subjectcombineid='.$combinationid.' and (subjectcode like "BES%" or SubjectCode like "BEA%" or SubjectCode like "gse%" or SubjectCode like "edu%" or SubjectCode like "esa%")')
        ->pluck('subjectid');

            $getcourses = DB::table('subjects')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('SubjectLevel='.$level.' and (subjectcode like "BEA%" or SubjectCode like "BES%" or SubjectCode like "gse%" or SubjectCode like "edu%" or SubjectCode like "esa%")')
        ->whereNotIn('subjectid', $getcoursesincurriculum)
        ->get();
        
        } else {

        $getcoursesincurriculum = DB::table('allcombinedcourses')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('SubjectLevel='.$level.' and sessionid = '.$session.' and subjectcombineid='.$combinationid.' and (subjectcode like "'.$major.'%" or SubjectCode like "'.$minor.'%" or SubjectCode like "gse%" or SubjectCode like "edu%" or SubjectCode like "esa%")')
        ->pluck('subjectid');

        $getcourses = DB::table('subjects')
        // ->leftjoin('allcombinedcourses', 'subjects.subjectid','=','allcombinedcourses.subjectid')
        ->whereraw('SubjectLevel='.$level.' and (subjectcode like "'.$major.'%" or SubjectCode like "'.$minor.'%" or SubjectCode like "gse%" or SubjectCode like "edu%" or SubjectCode like "esa%")')
        ->whereNotIn('subjectid', $getcoursesincurriculum)
        ->get();
        } 
        
        // return $getcourses;
        foreach($getcourses as $gc){
            
            $subject = $gc->SubjectID;
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

           DB::table('allcombinedcourses')
            ->insert(
                [
                'SubjectID'=>$getsubject->SubjectID,
                'CurricullumID'=>$session,
                'SessionID'=>$session,
                
                'DepartmentID'=>$getsubjectdept->DepartmantID,
                'SubjectCombineID'=>$combinationid,
                'SubjectLevel'=>$getsubject->SubjectLevel,
                'SubjectCode'=>$getsubject->SubjectCode,
                'SubjectName'=>$getsubject->SubjectName,
                'SubjectUnit'=>$getsubject->SubjectUnit,
                'SubjectValue'=>$getsubject->SubjectValue,
                'Semester'=>$getsubject->Semester]);
            
            }
    }
return response()->json('Super Done');
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('courses')->orderby('coursecode')->get();
        return view('CurriculumManager.create')->with('faculties', $faculties)->with('sessions', $sessions)->with('departments', $departments)->with('subjects', $subjects);
    }

    

    public function store(Request $request)
    {
        //get form contents
        $faculties = $request->input('faculties');
        $department = $request->input('departments');
        $semester = $request->input('semester');
        $thesession = $request->input('sessions');
        $programme = $request->input('programmes');
        $level = $request->input('level');
        $coursetitle = $request->input('coursetitle');
        $coursecode = $request->input('coursecode');
        $courseunit = $request->input('courseunit');
        $coursestatus = $request->input('coursestatus');
        $active = 1;

        $subjects = new Course;
        $subjects->SubjectName = $coursetitle;
        $subjects->SubjectCode = $coursecode;
        $subjects->SubjectValue = $coursestatus;
        $subjects->SubjectUnit = $courseunit;
        $subjects->Semester = $semester;
        $subjects->SubjectLevel = $level;
        $subjects->Active = $active;
        $subjects->save();

        
        // DB::table('subjects')->insert(
        //     [
        //         'SubjectName' => $coursetitle,
        //         'SubjectCode' => $coursecode,
        //         'SubjectValue' => $coursestatus,
        //         'SubjectUnit' => $courseunit,
        //         'Active' => 1,
        //         'Semester' => $semester,
        //         'SubjectLevel' => $level,
        //         'DepartmentID' => $department
        //         ]
        // );

        return view('CurriculumManager.index')->with('success', 'Curriculum Added');
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
        $subjects = AllcombinedCourse::find($id);

        return view('curriculumManager.edit')->with('subjects', $subjects);
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
        $session = $request->input('session');
        $tnu = $request->input('subjectvalue');
        $subjectvalue = $request->input('subjectunit');
        $subjectid = $request->input('subjectid');
        $subjectcombination = $request->input('subjectcombineid');

        // return $subjectcombination.' '.$session.' '.$subjectid;

        $subjects = AllcombinedCourse::find($id);
        $subjects->SubjectName = $request->input('subjectname');
        $subjects->SubjectCode = $request->input('subjectcode');
        $subjects->SubjectValue = $request->input('subjectvalue');
        $subjects->SubjectUnit = $request->input('subjectunit');
        $subjects->Semester = $request->input('semester');
        $subjects->SubjectLevel = $request->input('subjectlevel');
        //$subjects->Active = $request->input('active');

        $subjects->save();

        DB::table('results')->where('subjectcombinid', $subjectcombination)->where('sessionid', $session)->where('subjectid', $subjectid)
        ->update(['tnu' => $tnu, 'subjectvalue'=>$subjectvalue]);


        $theurl = url()->previous(); 

        return redirect($theurl)->with('success', 'Course updated for this programme');
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
