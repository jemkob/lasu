<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Auth;

class OlevelController extends Controller
{
    public function getOlevel()
    {
        //get current student
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;
        //First Semester
        $posts =  DB::table('students')
            ->where('MatricNo', $studentmatric)
            ->get(); 

        //Jamb details    
        $jamb = DB::table('jambdetails')->where('StudentID', $studentid)->first();

        $jambdetails = DB::table('jambdetails')->where('StudentID',$studentid)->get();
        $sumscore = DB::table('jambdetails')->where('StudentID',$studentid)->sum('Score');
        

        //O Leve Details
        $olevel = DB::table('oleveldetails')->where('StudentID',$studentid)->first();
        $olevels = DB::table('oleveldetails')->groupby('regno')->where('StudentID', $studentid)->get();
        // return $olevels;

        $oleveldetails = DB::table('oleveldetails')->where('StudentID',$studentid)->get();

        //get subject and grade
        $subjects = DB::table('olevelsubjects')->orderby('subject')->get();
        $grades = DB::table('olevelgrades')->orderby('grade')->get();
        
        return view('student.olevel')->with('posts', $posts)->with('jamb', $jamb)->with('jambdetails', $jambdetails)->with('sumscore',$sumscore)->with('olevel', $olevel)->with('oleveldetails', $oleveldetails)->with('subjects', $subjects)->with('grades', $grades)->with('olevels', $olevels);
    
    }
    public function thelevel()
    {
        return view('student.level');
    }

    public function AddOlevel(Request $request){
        $subjects = $request->input('subject');
        $grades = $request->input('grade');
        $examtype = $request->input('examtype');
        $examyear = $request->input('examyear');
        $regno = $request->input('regno');
        $centreno = $request->input('centreno');

        $checkregno = DB::table('oleveldetails')->where('regno', $regno)->get();
        if(count($checkregno)> 0){
            return redirect(url()->previous())->with('error', 'This Registration No. alreay exist, please check and try again!');
        }

        for($i=0; $i < count($subjects); $i++){
            $subject = $subjects[$i];
            $grade = $grades[$i];
            DB::table('oleveldetails')
            ->insert(
                ['ExamType'=>$examtype,
                'CenterNumber'=>$centreno,
                'RegNo'=>$regno,
                'SubjectName'=>$subject,
                'Grade'=>$grade,
                'StudentID'=>Auth::user()->StudentID,
                'ExamYear'=>$examyear]);
  
        }

        return redirect(url()->previous())->with('success', 'O\'Level Result Addess Successfully!');
    }

    public function AddJamb(Request $request){
        $subjects = $request->input('subject');
        $scores = $request->input('score');
        $examyear = $request->input('examyear');
        $regno = $request->input('regno');
        $centreno = $request->input('centreno');

        $checkregno = DB::table('jambdetails')->where('regno', $regno)->get();
        if(count($checkregno)> 0){
            return redirect(url()->previous())->with('error', 'This Registration No. alreay exist, please check and try again!');
        }

        for($i=0; $i < count($subjects); $i++){
            $subject = $subjects[$i];
            $score = $scores[$i];
            DB::table('jambdetails')
            ->insert(
                [
                'Center'=>$centreno,
                'RegNo'=>$regno,
                'Subject'=>$subject,
                'score'=>$score,
                'StudentID'=>Auth::user()->StudentID,
                'Year'=>$examyear]);
               
        }

        return redirect(url()->previous())->with('success', 'UTME details has been added Successfully!');
    }
}
