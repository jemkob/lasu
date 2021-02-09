<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departmentview = DB::table('departments')
        ->join('faculties', 'departments.FacultyID', '=', 'faculties.FacultyID')
        ->select('departments.departmantid as DepartmentID', 'departments.departmentname as DepartmentName', 'departments.departmentcode as DepartmentCode', 'faculties.facultyname as facultyname')
        ->orderby('facultyname')
        ->orderby('departmentname')
        ->paginate('10');
        return view('departmentmanager.index')->with('departmentview', $departmentview);
    }

    public function searchDept(Request $request)
    {
        //
        $search = $request->input('search');
        $search = '%'.$search.'%';
        $departmentview = DB::table('departments')
        ->join('faculties', 'departments.FacultyID', '=', 'faculties.FacultyID')
        ->select('departments.departmantid as DepartmentID', 'departments.departmentname as DepartmentName', 'departments.departmentcode as DepartmentCode', 'faculties.facultyname as facultyname')
        ->where('departmentname', 'like', $search)
        ->orwhere('departmentcode', 'like', $search)
        ->paginate('10');
        return view('departmentmanager.index')->with('departmentview', $departmentview);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = DB::table('faculties')->get();
        return view('departmentmanager.create')->with('faculties', $faculties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dept = New Department;

        //return $sessions;
        $dept->DepartmentName = $request->input('deptname');
        $dept->DepartmentCode = $request->input('deptcode');
        $dept->FacultyID = $request->input('faculties');
        
        $dept->save();

        return redirect('/departmentmanager')->with('success', 'A new department '.$request->input('deptname').' has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dept = Department::find($id);

        return view('departmentmanager.show')->with('dept', $dept);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $staffs = Staff::find($id)
        $dept = DB::table('departments')
        ->leftjoin('faculties', 'departments.facultyid', '=', 'faculties.facultyid')
        ->where('departmantid', $id)
        ->first();

        $faculties = DB::table('faculties')->get();
        return view('departmentmanager.edit')->with('faculties', $faculties)->with('dept', $dept);
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
        $dept = Department::find($id);

        //return $sessions;
        $dept->DepartmentName = $request->input('deptname');
        $dept->DepartmentCode = $request->input('deptcode');
        $dept->FacultyID = $request->input('faculties');
        
        $dept->save();

        
        //$subjects->Active = $request->input('active');
        return redirect('/departmentmanager')->with('success', 'Department updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Department::find($id);

        $dept->delete();
        return redirect('/departmentmanager')->with('success', 'Department Deleted.');
    }

    public function subjectcombinationIndex()
    {
        $subcomb = DB::table('subjectcombinations')
        ->orderby('subjectcombinname')
        ->get();

        return view('departmentmanager.subjectcombinationindex')->with('subcomb', $subcomb);
    }
    
    public function createcombination(){
        $departments = DB::table('departments')->orderby('departmentcode')->get();

        return view('departmentmanager.createcombination')->with('departments', $departments);
    }
    
    public function subjectcombinationNew(Request $request){
        $major = $request->input('major');
        $minor = $request->input('minor');
        $majorminor = $major.'/'.$minor;

        $checkcombination = DB::table('subjectcombinations')->where('subjectcombinname', $majorminor)->get();

        if(count($checkcombination) > 0){
            return redirect('createcombinationindex')->with('error', 'Subject Combination Already Exists.');
        } else {
            DB::table('subjectcombinations')->insert(
            ['SubjectCombinName' => $majorminor]);

            return redirect('createcombinationindex')->with('success', 'Subject Combination Added Successfully.');
        }
    }
}
