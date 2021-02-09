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
    public function suspend($matricno, $session, $semester)
     {
        
        // Gets the query string from our form submission 
        /* $matricno = $request->input('matricno'); 
        $session = $request->input('session');
        $semester = $request->input('semester'); */

        $checkprobation = DB::table('students')->where('matricno', $matricno)->first();

        if(empty($checkprobation->IsProbation)){
            return redirect('suspension')->with('error', 'Student is not on probation. Please place on probation before effecting suspension.');
        }

        $currentsession = DB::table('sessions')->max('sessionid');
        if($semester == 1){
            DB::table('results')
            ->where('matricno', $matricno)
            ->where('sessionid', $session)
            ->delete();

            $lastsession = DB::table('results')->where('matricno', $matricno)->groupby('sessionid')->orderby('sessionid')->get();
            if(empty($lastsession)){
                DB::table('students')->where('matricno', $matricno)->update(['isprobation' => NULL]);
                return redirect('suspension')->with('success', 'Student returned to 100 Level.');
            }
            $abc="";
            $isession = DB::table('results')->where('matricno', $matricno)->max('sessionid');
            $sessiondifference = $currentsession - $isession - 1;

            foreach($lastsession as $lsession){
               
                DB::table('results')
                ->where('matricno', $matricno)
                ->where('sessionid', $lsession->SessionID)
                ->where('level', $lsession->Level)
                ->update(['sessionid' => $sessiondifference + $lsession->SessionID]);
                $abc .= $sessiondifference + $lsession->SessionID.' - ';
            }
           
        } else {
            DB::table('results')
            ->where('matricno', $matricno)
            ->where('sessionid', $session)
            ->where('semester', $semester)
            ->delete();

            $lastsession = DB::table('results')->where('matricno', $matricno)->groupby('sessionid')->orderby('sessionid')->get();
            if(empty($lastsession)){
                DB::table('students')->where('matricno', $matricno)->update(['isprobation' => NULL]);
                return redirect('suspension')->with('success', 'Student returned to 100 Level.');
            }

            $isession = DB::table('results')->where('matricno', $matricno)->max('sessionid');
            $sessiondifference = $currentsession - $isession - 1;

            foreach($lastsession as $lsession){

                DB::table('results')
                ->where('matricno', $matricno)
                ->where('sessionid', $lsession->SessionID)
                ->where('level', $lsession->Level)
                ->update(['sessionid' => $sessiondifference + $lsession->SessionID]);
            }
        }

        DB::table('students')
        ->where('matricno', $matricno)
        ->update(['isprobation' => NULL]);
        // return redirect('suspension')->with('success', 'Student is no more on suspension.');
        return redirect()->back()->with('success', 'Student is no more on suspension.');

     }

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
       
       $currentsession = DB::table('sessions')->where('currentsession', true)->first();
       $prevsession = $currentsession->SessionID - 1;

       if($user->IsProbation != ""){
           if($user->IsProbation=='Deferment'){
            $this->suspend($user->MatricNo, $currentsession, 1);
            // return 'done';
           }

           return redirect('login')->with('error', 'Student Under Probation, Type: '.$user->IsProbation);
       }
      

    //    $checkskip = DB::table('results')
    //    ->where('studentid', $user->StudentID)
    //    ->where('sessionid', $prevsession)
    //    ->first();

    //    if(empty($checkskip) && $user->Level > 100){
    //        $this->suspend($user->MatricNo, $currentsession, 1);
    //     //    return 'dones';
    //     return redirect('login')->with('error', 'Defferment Consult Step-B');
    //    }

      

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
