<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
//use App\Student;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // $studentid = Auth::user()->StudentID;
    public function index()
    {
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;

        $posts =  DB::table('students')
            ->where('StudentID', $studentid)
            ->get(); 

        $details = DB::table('studentimages')
        ->where('studentid', $studentid)
        ->first();

        //Jamb details    
        $jamb = DB::table('jambdetails')->where('StudentID', $studentid)->first();

        $jambdetails = DB::table('jambdetails')->where('StudentID', $studentid)->get();
        $sumscore = DB::table('jambdetails')->where('StudentID', $studentid)->sum('Score');

        //O Leve Details
        $olevel = DB::table('oleveldetails')->where('StudentID', $studentid)->first();

        $oleveldetails = DB::table('oleveldetails')->where('StudentID', $studentid)->get();


        
        return view('student.biodata')->with('posts', $posts)->with('jamb', $jamb)->with('jambdetails', $jambdetails)->with('details', $details)->with('sumscore',$sumscore)->with('olevel', $olevel)->with('oleveldetails', $oleveldetails);
    }

    public function checkbed(){
        return view('student.bedas');
    }
    public function addbedas(Request $request){
        $studentid = Auth::user()->StudentID;
        $bedas = $request->input('bedas');
        DB::table('students')->where('studentid', $studentid)->update(['SubCourse' => $bedas]);

        if($bedas == "beda"){
            return redirect('home')->with('success', 'You are now in BED ACCOUNTING');
        } else {
            return redirect('home')->with('success', 'You are now in BED SECRETARIAT');
        }
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
