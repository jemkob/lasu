<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;

class EditProfileController extends Controller
{
    public function showprofile()
    {
        $posts =  DB::table('students')
            ->where('MatricNo', '15/0678')
            ->first(); 

        
        return view('student.editprofile')->with('posts', $posts);
    }

    public function editprofile()
    {
        $posts =  DB::table('students')
            ->where('MatricNo', '15/0678')
            ->get(); 

        
        return view('student.editprofiles')->with('posts', $posts);
    }
}
