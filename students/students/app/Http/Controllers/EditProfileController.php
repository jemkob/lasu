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
        $major = substr($request->input('combination'), 0,3);
        $minor = substr($request->input('combination'), -3);
        $matricno = $request->input('MatricNo');
        $studentids = Auth::user()->StudentID;
        // $studentid = Auth::user()->StudentID;
        $dept= DB::table('departments')->where('departmentcode', $major)->first();
        if(!empty($dept)){
        $getschool = DB::table('faculties')->where('facultyid', $dept->FacultyID)->first();
        }

        if(!empty($getschool)){
            $theschool = $getschool->FacultyName;
        } else{
            $theschool = 'NO SCHOOL';
        }


        $student = Student::find($studentids);
        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->FacultyName = $theschool;
        $student->JambRegNo = $request->input('JambRegNo');
        $student->PhoneNumber = $request->input('phonenumber');
        $student->Level = $request->input('level');
        $student->PhoneNumberNextOfKin = $request->input('phonenumbernextofkin');
        $student->MaritalStatus = $request->input('maritalstatus');
        
        $student->DateOfBirth = $request->input('dateofbirth');
        $student->PlaceOfBirth = $request->input('placeofbirth');
        $student->Salution = $request->input('salutation');
        $student->Major = $major;
        $student->Minor = $minor;

        $student->Gender = $request->input('gender');
        $student->HomeAddress = $request->input('homeaddress');
        $student->Religion = $request->input('religion');
        $student->SponsorsAddress = $request->input('sponsorsaddress');
        $student->SponsorsName = $request->input('sponsorsname');
        $student->SponsorsPhoneNumber = $request->input('sponsorsphonenumber');
       

    //update file upload
    
    if($request->file('imagefile') && !empty($request->file('imagefile')) > 0)
      {
        $path = $request->file('imagefile')->getRealPath();
        $path = base64_encode(file_get_contents($path));
        $contents = $request->file('imagefile')->openFile()->fread($request->file('imagefile')->getSize());
        $thefile = $request->file('imagefile')->getClientOriginalName();
        $thefileExt = $request->file('imagefile')->getClientOriginalExtension();
        //GET only filename without extension
        $filename = pathinfo($thefile, PATHINFO_FILENAME);
        //file name and time
        $filetostore = $filename.'_'.date("Y-m-d-h-i-sa", time()).'.'.$thefileExt;
        // $path = $request->file('imagefile')->storeAs('public/studentimage', $filetostore);
        $destinationPath = 'student_images';
        
        $request->file('imagefile')->move($destinationPath, $filetostore);
          
        $checkimage = DB::table('studentimages')->where('matricno', $request->input('MatricNo'))->first();
            if(count($checkimage) > 0){
            DB::table('studentimages')->where('studentid', $studentids)->update(['studentimage'=>NULL]);
            DB::table('students')->where('studentid', $studentids)->update(['studentimage'=>$filetostore]);
            } else {
                DB::table('studentimages')->insert(['studentid'=>$studentids, 'studentimage'=>NULL]);
                DB::table('students')->where('studentid', $studentids)->update(['studentimage'=>$filetostore]);
                
            }
        }
        
        $student->save();

        $theurl = url()->previous();

        return redirect($theurl)->with('success', 'Your information has been updated!');
    }
}
