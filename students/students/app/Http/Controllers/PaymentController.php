<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Auth;

class PaymentController extends Controller
{
    
    public function payment()
    {
        return view('student.payment');
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
