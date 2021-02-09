<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Allcombined;

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
        $faculties = DB::table('faculties')->get();
        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();
        $programmes = DB::table('subjectcombinations')->get();

        $curriculums = DB::table('allcombineds')
        ->join('subjects', 'allcombineds.SubjectID', '=', 'subjects.SubjectID')
        ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        ->join('departments', 'allcombineds.DepartmentID', '=', 'departments.DepartmantID')
        ->select('allcombineds.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid')
        ->where('allcombineds.SubjectCombineID', 41)
        ->where('allcombineds.DepartmentID', 7)
        ->where('subjects.semester', 2)
        ->where('subjects.subjectlevel', 100)
        ->where('departments.facultyid', 2)
        ->paginate(50);

        return view('CurriculumManager.index')->with('curriculums', $curriculums)->with('faculties', $faculties)->with('departments', $departments)->with('sessions', $sessions)->with('programmes', $programmes);
    }

    public function search(Request $request)
        {
        //get all data again
        $faculties = DB::table('faculties')->get();
        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();
        $programmes = DB::table('subjectcombinations')->get();


        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $department = $request->input('departments');
        // $semester = $request->input('semester');
        $thesession = $request->input('sessions');
        $programme = $request->input('programmes');
        $level = $request->input('level');

            $currentcuriculum = DB::table('curricullums')->where('iscurrent', true)->first();
            $curriculuminplace = $currentcuriculum->CurricullumID;
            if($level >= 300){
                $curriculuminplace = 1;
            }

        $curriculumsview = DB::table('allcombineds')
        ->join('subjects', 'allcombineds.SubjectID', '=', 'subjects.SubjectID')
        ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        ->join('departments', 'allcombineds.DepartmentID', '=', 'departments.DepartmantID')
        ->select('allcombineds.*', 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid')
        ->where('allcombineds.SubjectCombineID', $programme)
        //->where('allcombineds.DepartmentID', $department)
        // ->where('subjects.semester', $semester)
        ->where('subjects.subjectlevel', $level)
        ->where('curricullumID', $curriculuminplace)
        //->where('departments.facultyid', $faculty)
        ->orderby('subjects.subjectcode')
        ->get();

            
            
        // returns a view and passes the view the list of curriculum and the original query.
        return view('CurriculumManager.index')->with('curriculumsview', $curriculumsview)->with('faculties', $faculties)->with('departments', $departments)->with('sessions', $sessions)->with('programmes', $programmes);
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

             $getdetails = DB::table('subjects')
            ->select('subjects.subjectcode as subjectcode')
            ->where('subjectid', $subjectid)
            // ->whereRaw('resultid in ('.$iresultid.')')
            ->first(); 

            /* $deletedcourses = "";
            foreach($getdetails as $details){
                $deletedcourses .= $details->subjectcode.', ';
            }
            $deletedcourses = rtrim($deletedcourses, ', '); */

            DB::table('allcombineds')
            // ->whereRaw('resultid in ('.$iresultid.')')
            ->where('allcombinedid', $subcurricullum)
            ->delete();

            $theurl = url()->previous();            

            
            return redirect($theurl)->with('success', $getdetails->subjectcode.' has been deleted from the Curriculum');
        }


        public function jsfaculties(){
            $jsfaculties = DB::table('faculties')->get();
            return view('CurriculumManager.searches')->with('jsfaculties', $jsfaculties);
          }
      
          //autoload departments
          public function jsdepartments(Request $request){
            $faculty_id = $request->input('faculty_id');
            $jsdepartments = DB::table('departments')->where('FacultyID', '=', $faculty_id)->get();
            return response()->json($jsdepartments);
          }
      
          public function jsprogrammes(Request $request){
            $department_id = $request->input('department_id');
            //SELECT DISTINCT SubjectCombineID FROM `allcombineds` WHERE DepartmentID = 7

            /* $jsprogrammes = DB::table('allcombineds')
        ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
        ->selectRaw('distinct allcombineds.SubjectCombineID, subjectcombinations.SubjectCombinName as SubjectCombinName, subjectcombinations.SubjectCombinID as SubjectCombinID')
        //->groupBy('subjectcombineid')
        ->where('DepartmentID', $department_id)->get(); */

            $thedepartment = DB::table('departments')->where('DepartmantID', $department_id)->first();
            $deptcode = $thedepartment->DepartmentCode;
            $deptlike = $deptcode.'%';
            //$deptlike2 = '%'.$deptcode;
            $jsprogrammes = DB::table('subjectcombinations')->where('SubjectCombinName', 'like', $deptlike)->get();
            return response()->json($jsprogrammes);
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
        $semester = $request->input('semester');
        $thesession = $request->input('sessions');
        $programme = $request->input('programmes');
        $level = $request->input('level');
        $coursetitle = $request->input('coursetitle');
        $coursecode = $request->input('coursecode');
        $courseunit = $request->input('courseunit');
        $coursestatus = $request->input('coursestatus');
        $subjectid = $request->input('subjectid');
        $active = 1;

        /* $subjects = new Course;
        $subjects->SubjectName = $coursetitle;
        $subjects->SubjectCode = $coursecode;
        $subjects->SubjectValue = $coursestatus;
        $subjects->SubjectUnit = $courseunit;
        $subjects->Semester = $semester;
        $subjects->SubjectLevel = $level;
        $subjects->Active = $active;
        $subjects->save(); */

        $getsubject = DB::table('subjects')->orderby('SubjectID', 'desc')->first();
        $thesubject = $getsubject->SubjectID;
        $currentcuriculum = DB::table('curricullums')->where('iscurrent', true)->first();

        $curriculuminplace = $currentcuriculum->CurricullumID;
            if($level >= 300){
                $curriculuminplace = 1;
            }
        
        $combined = new Allcombined;
        $combined->SubjectCombineID = $programme;
        $combined->DepartmentID = $department;
        $combined->SubjectID = $subjectid;
        $combined->CurricullumID = $curriculuminplace;
        $combined->save();

        $departments = DB::table('departments')->get();
        $sessions = DB::table('sessions')->get();
        $programmes = DB::table('subjectcombinations')->get();
        $faculties = DB::table('faculties')->get();
        
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

        return redirect('CurriculumManager/create')->with('faculties', $faculties)->with('sessions', $sessions)->with('departments', $departments)->with('success', 'Curriculum Added');
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
        $programmes = DB::table('subjectcombinations')->get();
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('subjects')->orderby('subjectcode')->get();
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
