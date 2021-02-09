<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class OlevelController extends Controller
{
    public function getOlevel()
    {
        $posts =  DB::table('students')
            ->where('MatricNo', '15/0678')
            ->get(); 

        //Jamb details    
        $jamb = DB::table('jambdetails')->where('StudentID',6696)->first();

        $jambdetails = DB::table('jambdetails')->where('StudentID',6696)->get();
        $sumscore = DB::table('jambdetails')->where('StudentID',6696)->sum('Score');

        //O Leve Details
        $olevel = DB::table('oleveldetails')->where('StudentID',6696)->first();

        $oleveldetails = DB::table('oleveldetails')->where('StudentID',6696)->get();


        
        return view('student.olevel')->with('posts', $posts)->with('jamb', $jamb)->with('jambdetails', $jambdetails)->with('sumscore',$sumscore)->with('olevel', $olevel)->with('oleveldetails', $oleveldetails);
    
    }
    public function thelevel()
    {
        return view('student.level');
    }
}
