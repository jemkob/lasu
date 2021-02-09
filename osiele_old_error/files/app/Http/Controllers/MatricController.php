<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Student;

class MatricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $newstudents = DB::table('students')
        ->leftjoin('departments', 'students.major', '=', 'departments.departmentcode')
        ->selectRaw('studentid, matricno, surname, firstname, departments.facultyid as facultyid, major, minor, level')
        ->where('level', 100)
        ->where('matricno', '=', null)
        ->where('registered', 'true')
        ->orderby('departments.facultyid')
        ->orderby('departments.departmentcode')
        ->orderby('students.minor')
        ->orderby('students.surname')
        ->get();
        //return 
        
          
        return view('studentmanager.matric')->with('newstudents', $newstudents)->with('sessions', $sessions);
    }

    public function generateMatric()
    {
        $newstudents = DB::table('students')
        ->leftjoin('departments', 'students.major', '=', 'departments.departmentcode')
        ->selectRaw('studentid, matricno, surname, firstname, departments.facultyid as facultyid, major, minor, level')
        ->where('level', 100)
        ->where('matricno', null)
        ->where('registered', 'true')
        ->orderby('departments.facultyid')
        ->orderby('departments.departmentcode')
        ->orderby('students.minor')
        ->orderby('students.surname')
        ->get();
        //return
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $matric = 0; 
        $myear = substr($sessions->SessionYear, 2, 2);
         foreach($newstudents as $newstudent){
            $matric++; 
            $matricpad = str_pad($matric, 4, "0", STR_PAD_LEFT); 
            $imatric= $myear.'/'.$matricpad;

            DB::table('students')
            ->where('studentid', $newstudent->studentid)
            ->update(['MatricNo' => $imatric, 'FacultyID' => $newstudent->facultyid]);
            
            DB::table('results')
            ->where('studentid', $newstudent->studentid)
            ->update(['MatricNo' => $imatric]);
            //return $theupdate;
         }
          return redirect('matric/generated')->with('success', 'Matric No. generated for all 100 Level students');
        //return view('studentmanager.matric')->with('newstudents', $newstudents);
    }
    public function generated(){
        return view('studentmanager.generated');
    }
    public function promoteview()
    {
       
        //$users = DB::table('students')->take(10)->get();
          
        return view('studentmanager.promote');
    }
    public function promote(Request $request)
    {
       
        $level = $request->input('level');
        $thelevel = $level + 100;

        //$students = DB::table('students')->where('level', $level)->get();
        $theupdate = DB::table('students')
            ->where('registered', 'true')
            ->where('Level', $level)
            ->update(['Level' => $thelevel]);
            //return $theupdate;
            return redirect('/promote')->with('success', 'The '.$level.' Level Students have been promoted to '.$thelevel.' Level');
          
       //return view('studentmanager.promote');
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
