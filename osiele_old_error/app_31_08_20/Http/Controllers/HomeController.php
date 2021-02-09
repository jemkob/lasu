<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allstudents = DB::table('students')->select('StudentID')->where('Registered', 'true')->get();
        $alldept = DB::table('departments')->get();
        $faculty = DB::table('faculties')->get();
        $allcourses = DB::table('subjects')->get();
        $lecturers = DB::table('lecturers')->get();
        $admins = DB::table('admins')->get();
        $males = DB::table('students')->select('gender')->where('Registered', 'true')->where('gender', 'male')->get();
        $females = DB::table('students')->select('StudentID')->where('Registered', 'true')->where('gender', 'female')->get();
        //$allprogrammes = DB::table('subjectcombinations')->get();
        //return count($allstudents);
        //view()->share('allstudents', $allstudents);

        return view('home')->with('allstudents', $allstudents)->with('alldept', $alldept)->with('faculty', $faculty)->with('allcourses', $allcourses)->with('lecturers', $lecturers)->with('admins', $admins)->with('males', $males)->with('females', $females);
    }
}
