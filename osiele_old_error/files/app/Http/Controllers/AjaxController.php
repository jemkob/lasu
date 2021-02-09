<?php

namespace App\Http\Controllers;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use DB;

class AjaxController extends Controller
{
    //
    function index()
    {
     $faculty_list = DB::table('faculties')
        // ->groupBy('FacultyName')
         ->get();
     return view('dynamic_dependent')->with('faculty_list', $faculty_list);
    }

    function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('departments')
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }


    // //
    // public function myform()
    // {
    //     $countries = DB::table("faculties")
    //                 ->pluck("FacultyName","FacultyID")
    //                 ->all();
    // 	return view('myform',compact('countries'));
    // }


    // /**
    //  * Show the application selectAjax.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function selectAjax(Request $request)
    // {
    // 	if($request->ajax()){
    //         $states = DB::table("departments")
    //         ->where('facultyID',$request->DepartmentID)
    //         ->pluck("DepartmentName","DepartmentID")
    //         ->all();
    // 		$data = view('select-ajax',compact('states'))->render();
    // 		return response()->json(['options'=>$data]);
    // 	}
    // }

}
