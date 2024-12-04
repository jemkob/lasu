<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Student;

class EditProfileController extends Controller
{
    public function showprofile()
    {
        //get current student
        $studentid = Auth::user()->StudentID;
        $studentmatric = Auth::user()->MatricNo;
        
        $posts =  DB::table('students')
            ->where('Studentid', $studentid)
            ->first();
            
            $showstudent =  DB::table('students')
            ->where('Studentid', $studentid)
            ->first();

        $program = DB::table('subjectcombinations')
        // ->where('subjectcombinname', $majmin)
        ->orderby('Subjectcombinname')
        ->get();

        $school = DB::table('faculties')
        ->orderby('FacultyName')
        ->get();

        

        $images = DB::table('studentimages')->where('studentid', $studentid)->first();

        
        return view('student.editprofile')->with('posts', $posts)->with('program', $program)->with('showstudent', $showstudent)->with('images', $images)->with('school', $school);
    }

    public function editprofile()
    {
        $posts =  DB::table('students')
            ->where('Studentid', $studentid)
            ->get(); 

        
        return view('student.editprofiles')->with('posts', $posts);
    }

    public function updateInfo(Request $request)
    {
        $studentids = Auth::user()->StudentID;
        // $studentid = Auth::user()->StudentID;
        $student = Student::find($studentids);
        // $student->Surname = $request->input('Surname');
        // $student->Firstname = $request->input('firstname');
        // $student->Middlename = $request->input('Middlename');
        $student->Department = $request->input('department');
        // if(empty($request->input('nin'))){
        //     $student->NIN = ' ';
        // }else{
        //     $student->NIN = $request->input('nin');
        // }
        // if($student->Level == 100 || ($student->Level == 200 && $student->levelOfEntry == 200)){
        //     $student->olevelSitting = $request->olevelsitting;
        // }
        // $student->NIN = $request->input('nin');
        // $student->PhoneNumber = $request->input('phonenumber');
        // $student->Gender = $request->input('gender');
       

    //update file upload
    
    // if($request->file('imagefile') && !empty($request->file('imagefile')) > 0)
    //   {
    //     $path = $request->file('imagefile')->getRealPath();
    //     $path = base64_encode(file_get_contents($path));
    //     $contents = $request->file('imagefile')->openFile()->fread($request->file('imagefile')->getSize());
    //     $thefile = $request->file('imagefile')->getClientOriginalName();
    //     $thefileExt = $request->file('imagefile')->getClientOriginalExtension();
    //     //GET only filename without extension
    //     $filename = pathinfo($thefile, PATHINFO_FILENAME);
    //     //file name and time
    //     $filetostore = $filename.'_'.date("Y-m-d-h-i-sa", time()).'.'.$thefileExt;
    //     $path = $request->file('imagefile')->storeAs('public/studentimage', $filetostore);
    //     $checkimage = DB::table('studentimages')->where('matricno', $request->input('MatricNo'))->get();
    //         if(count($checkimage) > 0){
    //         DB::table('studentimages')->where('studentid', $studentids)->update(['studentimage'=>$contents]);
    //         } else {
    //             DB::table('studentimages')->insert(['studentid'=>$studentids, 'matricno'=>$matricno, 'studentimage'=>$contents]);
    //         }
    //     }
        
        $student->save();

        $theurl = url()->previous();

        return redirect($theurl)->with('success', 'Your information has been updated!');
    }
}
