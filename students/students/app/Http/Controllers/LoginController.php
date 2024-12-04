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
    
    if ($password && $username) {
       $user = DB::table('students')
       ->where('MatricNo', $username)
       ->orwhere('AdmissionCode', $username)
       ->first();
        // dd($user);
        // return $user;
       if(empty($user)){
        return redirect('login')->with('error', 'Invalid username or password.');
            }
        
       
       $currentsession = DB::table('sessions')->where('currentsession', true)->first();
       $prevsession = $currentsession->SessionID - 1;

       $checkskip = DB::table('results')
       ->where('studentid', $user->StudentID)
       ->where('sessionid', $prevsession)
       ->first();

    //    if($user->Level > 100){
    //     return redirect('login')->with('error', 'You currently cannot make payment.');
    //    }
        $surname = strtoupper(trim($user->Surname));
        $password = strtoupper(trim($password));
    if($surname == $password){
        // return $user->Level;
       
        Auth::loginUsingId($user->StudentID);
        return redirect()->route('home');
        }else{
            return redirect('login')->with('error', 'Invalid Student/wrong password');
        }
    }

       //match student key from the key without joining the tables
       $userkey = DB::table('pins')->where('StudentID', $user->StudentID)->first();

       $checkpin = DB::table('pins')->where('pinkey', $password)->first();
       
       if(empty($userkey)){
        return redirect('login')->with('error', 'Invalid Student/wrong password');
    }

       

        
 return redirect()->back()->with('error', 'Invalid Matric/Password');
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
