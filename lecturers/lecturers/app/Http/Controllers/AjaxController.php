<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
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

        $jsprogrammes = DB::table('allcombineds')
    ->join('subjectcombinations', 'allcombineds.SubjectCombineID', '=', 'subjectcombinations.SubjectCombinID')
    ->selectRaw('distinct allcombineds.SubjectCombineID, subjectcombinations.SubjectCombinName as SubjectCombinName, subjectcombinations.SubjectCombinID as SubjectCombinID')
    //->groupBy('subjectcombineid')
    ->where('DepartmentID', $department_id)->get();

        $thedepartment = DB::table('departments')->where('DepartmantID', $department_id)->first();
        $deptcode = $thedepartment->DepartmentCode;
        $deptlike = $deptcode.'%';
        $deptlike2 = '%'.$deptcode;
        //$jsprogrammes = DB::table('subjectcombinations')->where('SubjectCombinName', 'like', $deptlike)->orwhere('SubjectCombinName', 'like', $deptlike2)->get();
        return response()->json($jsprogrammes);
      }
      public function jscourses(Request $request){
        $subjectcombineid = $request->input('programme_id');
        $departmentid = Auth::user()->DepartmentID;
        //SELECT DISTINCT SubjectCombineID FROM `allcombineds` WHERE DepartmentID = 7

        $jscourses = DB::table('allcombineds')
    ->leftjoin('subjects', 'allcombineds.SubjectID', '=', 'subjects.SubjectID')
    ->select('subjects.Subjectid as subjectid', 'subjects.SubjectName as subjectname')
    ->where('SubjectCombineID', $subjectcombineid)->where('DepartmentID', $departmentid)->get();

        return response()->json($jscourses);
      }
}
