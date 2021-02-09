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


    //     $user = User::where('email', $request->email)->first();
    //     if(Hash::check($request->password, $user->PASSWORD)){
    //         Auth::loginUsingId($user->id);
    //        return redirect($this->home); 
    //    }else{
    //        return redirect($this->index); 
    //    }
        $username = $request->username;
        $password = $request->password;

       $user = DB::table('lecturers')->where('UserName', $username)->where('Password', $password)->first();
       
       if(isset($user->Password) && !empty($user->Password)){
            if($user->Password == $password){
            Auth::loginUsingId($user->LecturerID);

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
}
