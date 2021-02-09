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
        if (!empty($password) && !empty($username)) {
        $user = DB::table('admins')->where('Username', $request->username)->first();


       if(isset($user->Password) && !empty($user->Password)){
        if( $user->Password == $password){
            Auth::loginUsingId($user->AdminID);

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
    }

        return redirect('/login')->with('error', 'Invalid username/password');
    }
}
