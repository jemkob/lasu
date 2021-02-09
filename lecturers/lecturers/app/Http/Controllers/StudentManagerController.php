<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Student;

class StudentManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //return 
        $users = Student::orderBy('Surname','desc')->paginate(50);
        //$users = DB::table('students')->take(10)->get();
          
        return view('studentmanager.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentmanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('Firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->save();

        return redirect('/studentmanager');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $showstudent = Student::find($id);

        return view('studentmanager.show')->with('showstudent', $showstudent);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showstudent = Student::find($id);

        return view('studentmanager.edit')->with('showstudent', $showstudent);
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
        $student = Student::find($id);
        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('Firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->save();

        return redirect('/studentmanager')->with('success', 'data updated');
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
