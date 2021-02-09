<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Student;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use File;
use Illuminate\Http\Response;


class StudentManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //return 
        $users = Student::orderBy('MatricNo')->paginate(100);
        //$users = DB::table('students')->take(10)->get();
          
        return view('studentmanager.index')->with('users', $users);
    }
    public function searchview()
    {
       
        //$users = DB::table('students')->take(10)->get();
          
        return view('studentmanager.searchresult');
    }
    
    public function searchStudent(Request $request)
    {
        //$student = Student::find($id);
        $inputs = $request->input('search');
        $users = DB::table('students')
        ->where('matricno', $inputs)
        ->orwhere('surname', $inputs)
        ->orwhere('firstname', $inputs)
        ->orwhere('middlename', $inputs)
        ->paginate(500);
        //return $users;

        return view('studentmanager.index')->with('users', $users);
    }
    public function promoteview()
    {
       
        //$users = DB::table('students')->take(10)->get();
          
        return view('studentmanager.promote');
    }
    public function promote(Request $request)
    {
       
        
        $resultcheck = DB::table('results')->max('sessionid');
        $sessionCheck = DB::table('sessions')->max('sessionid');

        $studentlevel = DB::table('students')->select('studentid', 'level', 'matricno')->where('registered', 'true')->orderbydesc('level')->get();

        if($resultcheck >= $sessionCheck){
            return redirect('promote')->with('error', 'Create a new session before promoting.');
            
        } else {
            foreach($studentlevel as $currentlevel){
                /* if($currentlevel->level==500){
                    $newlevel = 600;
                }elseif($currentlevel->level==400){
                    $newlevel = 500;
                }elseif($currentlevel->level==300){
                    $newlevel = 400;
                }elseif($currentlevel->level==200){
                    $newlevel = 300;
                }elseif($currentlevel->level==100){
                    $newlevel = 200;
                } */

                $newlevel = $currentlevel->level + 100;

            DB::table('students')
            ->where('registered', 'true')
            ->where('studentid', $currentlevel->studentid)
            ->update(['Level' => $newlevel, 'registered' => NULL]);

            }
        }




            return redirect('/promote')->with('success', 'All  Students have been promoted to the next Level');
          
       //return view('studentmanager.promote');
    }
    //show all 300level students 
    public function promote300()
    {
       
        $all300level = DB::table('students')
        ->where('registered', 'true')
        ->where('level', 300)
        ->orderby('matricno')
        ->get();
          
        return view('studentmanager.all300level')->with('all300level', $all300level);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentmanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('Firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->save();

        return redirect('/studentmanager');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $showstudent = Student::find($id);

        return view('studentmanager.show')->with('showstudent', $showstudent);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showstudent = Student::find($id);

        $majmin = $showstudent->Major.'/'.$showstudent->Minor;

        $program = DB::table('subjectcombinations')
        // ->where('subjectcombinname', $majmin)
        ->orderby('Subjectcombinname')
        ->get();
        $images = DB::table('studentimages')->where('studentid', $id)->first();

        return view('studentmanager.edit')->with('showstudent', $showstudent)->with('program', $program)->with('images', $images);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $major = substr($request->input('combination'), 0,3);
        $minor = substr($request->input('combination'), -3);
        $matricno = $request->input('MatricNo');
        $studentids = $request->input('studentid');

        $student = Student::find($id);
        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->FacultyName = $request->input('facultyName');
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
        $path = $request->file('imagefile')->storeAs('public/studentimage', $filetostore);
        $checkimage = DB::table('studentimages')->where('studentid', $studentids)->get();
            if(count($checkimage) > 0){
            DB::table('studentimages')->where('studentid', $studentids)->update(['studentimage'=>$contents]);
            } else {
                DB::table('studentimages')->insert(['studentid'=>$studentids, 'matricno'=>$matricno, 'studentimage'=>$contents]);
            }
        }
        
        $student->save();

        $theurl = url()->previous();

        return redirect($theurl)->with('success', 'Student information has been updated!');
    }
    public function updateStudent(Request $request)
    {
        //$student = Student::find($id);
        $surname = $request->input('Surname');
        $firstname = $request->input('firstname');
        $middlename = $request->input('Middlename');
        $state = $request->input('SOR');
        $nationality = $request->input('country');
        $student->save();

        return redirect('/studentmanager')->with('success', 'data updated');
    }
    public function deleteStudent(Request $request)
    {
        $studentid= $request->input('studentid');
        
        $checkstudent = DB::table('results')->where('studentid', $studentid)->get();
        if(count($checkstudent) > 1){
            return redirect('/studentmanager')->with('error', 'This student has exam records, as such you cannot delete, contact the super administrator.');
        } else {
        DB::table('students')
        ->where('studentid', $studentid)
        ->delete();
        }
        return redirect('/studentmanager')->with('success', 'All Student Information Deleted.');
    }

    //New entrants
    public function fresherindex(){
        return view('studentmanager.fresher');
    }
    //
    public function import(Request $request){
       

    if($request->file('fresherfile'))
      {
        $path = $request->file('fresherfile')->getRealPath();
//sdfasdfasd;akdskfja;sdlfjalsdjfas
        Excel::load($path)->each(function (Collection $csvLine) {
            
            $csvemail = $csvLine->get('email');
            $csvsponsor = $csvLine->get('guardian');
            $sponsor = json_decode($csvsponsor);
           
            if(!empty($sponsor)){
                
                foreach($sponsor as $sp){
                
            DB::table('students')
            ->where('email', $csvemail)
            ->update(['sponsorsname'=>$sp->NAME,
            'sponsorsaddress'=>$sp->ADDRESS, 'sponsorsphonenumber'=>$sp->PHONE]);
                    }
                }

                
                    
     });
    }
    return redirect('studentmanager/fresher')->with('success', 'Students information added to database.');    
}
public function probation(){
    $probation = DB::table('students')->where('isprobation', '!=', NULL)->get();
// return $probation;
    return view('studentmanager.probation')->with(compact(['probation']));
}
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
