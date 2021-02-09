<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::orderBy('Surname','asc')->paginate(50);
        //$users = DB::table('students')->take(10)->get();
          
        return view('staffmanager.index')->with('staffs', $staffs);
    }

    public function searchLecturer(Request $request)
    {
        $search = trim($request->input('search'));
        // $search = '%'.$search.'%';
        // $staffs = Staff::orderBy('Surname','asc')
        // return $search;
        $staffs = DB::table('lecturers')
        
        ->where('Surname', 'like', '%'.$search.'%')
        ->orwhere('Firstname', 'like', '%'.$search.'%')         
        ->paginate(100);
        //$users = DB::table('students')->take(10)->get();
        //   return $staffs;
        return view('staffmanager.index')->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = DB::table('faculties')->get();
        $rank = DB::table('staffrank')->get();
        return view('staffmanager.create')->with('faculties', $faculties)->with('rank', $rank);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $defaultpassword = '12345';
        $staffs = new Staff;
        $staffs->Firstname = $request->input('firstname');
        $staffs->Surname = $request->input('surname');
        $staffs->Middlename = $request->input('middlename');
        $staffs->UserName = $request->input('username');
        $staffs->Password = $defaultpassword;
        $staffs->Email = $request->input('email');
        $staffs->PhoneNumber = $request->input('phone');
        $staffs->DepartmentID = $request->input('departments');
        $staffs->StaffRankId = $request->input('rank');

        //$sessions->CurrentSession = $request->input('currentsession');
        
        $staffs->save();

        return redirect('/staffmanager')->with('success', 'A new lecturer has been added.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staffs = Staff::find($id);

        return view('staffmanager.show')->with('staffs', $staffs);
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
        $staffs = DB::table('lecturers')
        ->leftjoin('departments', 'departments.departmantid', '=', 'lecturers.departmentid')
        ->leftjoin('staffrank', 'lecturers.staffrankid', '=', 'staffrank.staffrankid')
        ->where('lecturerid', $id)
        ->first();

        $faculties = DB::table('faculties')->get();
        $rank = DB::table('staffrank')->get();
        return view('staffmanager.edit')->with('faculties', $faculties)->with('rank', $rank)->with('staffs', $staffs);
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
        
        $staffs = Staff::find($id);

        //return $sessions;
        $this->validate($request, [
            'surname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'password' => 'required|max:255',
            'username' => 'required|max:255',
        ]);
        $staffs->Firstname = $request->input('firstname');
        $staffs->Surname = $request->input('surname');
        $staffs->UserName = $request->input('username');
        $staffs->Password = $request->input('password');
        $staffs->Email = $request->input('email');
        $staffs->PhoneNumber = $request->input('phone');
        $staffs->DepartmentID = $request->input('departments');
        $staffs->StaffRankId = $request->input('rank');

        
        $staffs->save();

        
        //$subjects->Active = $request->input('active');
        return redirect('/staffmanager')->with('success', 'Lecturer details updated.');
    }

    public function deleteLecturer(Request $request)
    {
        $lecturerid= $request->input('studentid');
        DB::table('lecturers')
        ->where('lecturerid', $lecturerid)
        ->delete();

        return redirect('/staffmanager')->with('success', 'Lecturer Deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);

        $staff->delete();
        return redirect('/staffmanager')->with('success', 'Lecturer Deleted.');

    }


}
