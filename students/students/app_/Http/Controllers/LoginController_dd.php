<?php

namespace App\Http\Controllers;
use Auth;
use App\Admin;
use DB;
use Illuminate\Http\Request;
use Hash;

class LoginController extends Controller
{
    //
    public function login(Request $request){


    $username = $request->input('username');
    $password = $request->input('password');
    
    if (!empty($password) && !empty($username)) {
       $user = DB::table('students')
       //->join('pinkey', 'students.studentkey', '=', 'pinkey.studentkey')
       ->where('students.MatricNo', $username)
       ->orwhere('students.InvoiceNumber', $username)
       ->orwhere('students.JambRegNo', $username)
       ->first();

       $pins = DB::table('pins')->where('pinkey', $password)->first();

       if(empty($user) || empty($pins)){
           return redirect('login')->with('error', 'Invalid Student/wrong PIN.');
       }

       if($user->IsProbation != ""){
           return redirect('login')->with('error', 'Student Under Probation, Type: '.$user->IsProbation);
       }
       $currentsession = DB::table('sessions')->where('currentsession', true)->first();
       $prevsession = $currentsession->SessionID - 1;

       $checkskip = DB::table('results')
       ->where('studentid', $user->StudentID)
       ->where('sessionid', $prevsession)
       ->first();

       if(empty($checkskip) && $user->Level > 100){
        return redirect('login')->with('error', 'Defferment Consult Step-B');
       }

      

       //match student key from the key without joining the tables
       $userkey = DB::table('pins')->where('StudentID', $user->StudentID)->first();

       $checkpin = DB::table('pins')->where('pinkey', $password)->first();
       if(($checkpin->StudentID === NULL) && empty($userkey)){

           DB::table('pins')->where('pinid', $checkpin->PinID)->update(['StudentID' => $user->StudentID]);

           Auth::loginUsingId($user->StudentID);

           if(($user->SubCourse === NULL) && ($user->Level >= 300) && ($user->Major == "BED")){
               return redirect('student/bedas');
           }
           
            return redirect()->route('home');
            // return redirect('login')->with('success','You can now login with your Matric No./JAMB No. and PIN.');
       }


       if(empty($userkey)){
        return redirect('login')->with('error', 'Invalid Student/wrong PIN.');
    }

       if($password === $userkey->PinKey){
           Auth::loginUsingId($user->StudentID);

           if(($user->SubCourse === NULL) && ($user->Level >= 300) && ($user->Major == "BED")){
            return redirect('student/bedas');
        }

            //Auth::loginUsingId($user->id);
            //$user = User::where('email', $request->email)->first();
           // Auth::loginUsingId($user->id);

            // if($user->is_admin())
            // {
                // return redirect()->route('dashboard');
            // }
            return redirect()->route('home');
        }
    }

        return redirect()->back();
    }
    public function getMatric(Request $request){
        $jambno = $request->input('jambno');
        $getmatric = DB::table('students')
        ->select('matricno', 'firstname', 'surname', 'middlename')
        ->where('jambregno', $jambno)
        ->first();
        if(empty($getmatric)){
            return redirect('login')->with('error', 'Invalid Student/JAMB Number');
        }

        // return redirect()->route('login')->with('getmatric', $getmatric);

        return redirect('login')->with('success', 'Matric No.: '.$getmatric->matricno.', Full Name: '.$getmatric->surname.' '.$getmatric->firstname.' '.$getmatric->middlename.'.');
    }
}
