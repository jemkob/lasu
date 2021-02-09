<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Student;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  DB::table('students')
            //DB::table('students')
            //->join('jambdetails', 'students.StudentID', '=', 'jambdetails.StudentID')
            //->select('students.*', 'jambdetails.*')
            ->where('MatricNo', '15/0678')
            //->join('courses', 'results.Course', '=', 'courses.Guid')
            //->select('khe100result.*', 'students.*')
            //->where('students.Level', '100')
            ->get(); 

        //Jamb details    
        $jamb = DB::table('jambdetails')->where('StudentID',6696)->first();

        $jambdetails = DB::table('jambdetails')->where('StudentID',6696)->get();
        $sumscore = DB::table('jambdetails')->where('StudentID',6696)->sum('Score');

        //O Leve Details
        $olevel = DB::table('oleveldetails')->where('StudentID',6696)->first();

        $oleveldetails = DB::table('oleveldetails')->where('StudentID',6696)->get();


        
        return view('student.biodata')->with('posts', $posts)->with('jamb', $jamb)->with('jambdetails', $jambdetails)->with('sumscore',$sumscore)->with('olevel', $olevel)->with('oleveldetails', $oleveldetails);
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
