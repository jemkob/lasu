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
        $users = Student::orderBy('MatricNo')->whereNotNull('Level')->paginate(100);
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
        $departments= DB::table('department')->get();
        return view('studentmanager.create')->with(compact('departments'));
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
        $student->MatricNo = $request->matricno;
        $student->Surname = $request->input('surname');
        $student->Firstname = $request->input('firstname');
        $student->Middlename = $request->input('middlename');
        $student->NIN = $request->nin;
        $student->levelOfEntry = $request->levelofentry;
        $student->Email = $request->email;
        $student->PhoneNumber = $request->phone;
        $student->Gender = $request->gender;
        $student->Department = $request->department;
        $student->olevelSitting = $request->olevel;
        $student->Level = $request->level;

        $student->save();

        DB::connection('lasupay')->insert('insert into students (MatricNo, Surname, Firstname, Middlename, NIN, levelOfEntry, Email, PhoneNumber, Gender, Department, olevelSitting, Level) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->matricno, $request->surname, $request->firstname, $request->middlename, $request->nin, $request->levelofentry, $request->email, $request->phone, $request->gender, $request->department, $request->olevel, $request->level]);

        return redirect('/studentmanager')->with('success', 'Student added successfully!');
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

        $program = DB::table('departments')
        // ->where('subjectcombinname', $majmin)
        ->orderby('departmentname')
        ->get();


        return view('studentmanager.edit')->with('showstudent', $showstudent)->with('program', $program);
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
            $csvfirstname = $csvLine->get('firstname');//ca
            $csvsurname = $csvLine->get('surname');//exam
            $csvmiddlename = $csvLine->get('othername');
            $csvphone = $csvLine->get('phone_no');
            $csvjamb = $csvLine->get('jamb_details');
            $csvjambresult = $csvLine->get('jamb_result');
            $csvgender = $csvLine->get('gender');
            $csvreligion = $csvLine->get('religion');
            $csvaddress = $csvLine->get('address');
            $csvemail = $csvLine->get('email');
            $csvphone = $csvLine->get('phone_no');
            $csvnationality = $csvLine->get('nationality');
            $csvstate = $csvLine->get('state');
            $csvlga = $csvLine->get('lga');

            $csvmajorminor = $csvLine->get('majorminor');
            $csvfirst = $csvLine->get('first_result_details');
            $csvfirstresult = $csvLine->get('first_sitting_result');
            $csvsecond = $csvLine->get('second_sitting_details');
            $csvsecondresult = $csvLine->get('second_sitting_result');
            $csvdateofbirth = $csvLine->get('date_of_birth');
            $csvstudentimage = $csvLine->get('avatar');

            // $major = substr($csvmajorminor, 0,3);
            // $minor = substr($csvmajorminor, -3);

            


            $jambresult = $csvjambresult;
            // $jambresult = str_ireplace("[","",  $jambresult);
            $jambresult = json_decode($jambresult);
        $jamb = $csvjamb;
        $jamb = json_decode($jamb);
        $first = json_decode($csvfirst);
        $firstresult = json_decode($csvfirstresult);
// dd($jamb);
        $second = json_decode($csvsecond);
        $secondresult = json_decode($csvsecondresult);
        if(!empty($jamb)){
            $jambno = $jamb[0]->UTME_NO;

            $major = substr($jamb[0]->COURSE, 0,3);
            $minor = substr($jamb[0]->COURSE, -3);
            
            $facultyid = DB::table('departments')->where('departmentcode', $major)->first();
            $facultyname = DB::table('faculties')->where('facultyid', $facultyid->FacultyID)->first();
            $thefacultyname = $facultyname->FacultyName;

        } else {
            $jambno = NULL;

            $major = NULL;
            $minor = NULL;
            
            $facultyid = NULL;
            $facultyname = NULL;
            $thefacultyname = NULL;
        }
            
       
            
            DB::table('students')->insert(
                ['firstname'=>$csvfirstname,
                'surname'=>$csvsurname,
                'middlename'=>$csvmiddlename,
                'gender'=> $csvgender,
                'religion'=>$csvreligion,
                'jambregno'=>$jambno,
                'email' =>$csvemail,
                'sor'=>$csvstate,
                'lga'=>$csvlga,
                'major'=>$major,
                'minor'=>$minor,
                'phonenumber'=>$csvphone,
                'level'=>100,
                'nationality'=>$csvnationality,
                'studentimage'=>$csvstudentimage,
                'homeaddress'=>$csvaddress,
                'dateofbirth'=>$csvdateofbirth,
                'facultyname'=>$thefacultyname]);

                $studentid = DB::table('students')->orderby('studentid', 'desc')->first();
                
                DB::table('studentimages')->insert(['studentid'=>$studentid->StudentID]);
                
            #Jamb details
            // dd($csvfirst);
            

            if(!empty($jamb) && !empty($jambresult)){
                
                foreach($jambresult as $utme){
                DB::table('jambdetails')->insert(
                    ['regno'=>$jamb[0]->UTME_NO,
                    'subject'=>$utme->SUBJECTS,
                    'score'=> $utme->SCORE,
                    'year'=>$jamb[0]->YEAR_OF_ENTRY,
                    'studentid'=>$studentid->StudentID]);
                    }
                }

                if(!empty($first) && !empty($firstresult)){
                
                    foreach($firstresult as $olevel){
                    DB::table('oleveldetails')->insert(
                        ['ExamType'=>$first[0]->OLEVEL_1,
                        'CenterNumber'=>$first[0]->EXAM_N01,
                        'RegNo'=> $first[0]->EXAM_N01,
                        'SubjectName'=>$olevel->SUBJECTS,
                        'Grade'=>$olevel->GRADES,
                        'StudentID'=>$studentid->StudentID,
                        'ExamYear'=>NULL]);
                        }
                    }

                if(!empty($second) && !empty($secondresult)){
            
                    foreach($secondresult as $olevel){
                    DB::table('oleveldetails')->insert(
                        ['ExamType'=>$second[0]->OLEVEL_2,
                        'CenterNumber'=>$second[0]->EXAM_N02,
                        'RegNo'=> $second[0]->EXAM_N02,
                        'SubjectName'=>$olevel->SUBJECTS,
                        'Grade'=>$olevel->GRADES,
                        'StudentID'=>$studentid->StudentID,
                        'ExamYear'=>NULL]);
                        }
                    }
                    
     });
    }
    return redirect('studentmanager/fresher')->with('success', 'Students information added to database.');    
}

public function curindex(){
    return view('studentmanager.cur');
}

public function importCurriculumd(Request $request){
    if($request->file('coursefile'))
      {
        $path = $request->file('coursefile')->getRealPath();


        Excel::load($path)->each(function (Collection $csvLine) {
            $admissioncode = $csvLine->get('admissioncode');//ca
            $matricno = $csvLine->get('matricnumber');//exam
            $surname = $csvLine->get('surname');
            $firstname = $csvLine->get('firstname');
            $othername = $csvLine->get('othername');
            $sex = $csvLine->get('sex');
            $department = $csvLine->get('department');
            $entryyear = $csvLine->get('entry');
            $duration = $csvLine->get('duration');
            $levelofentry = $csvLine->get('levelofentry');
            // $session = $csvLine->get('session');

            DB::table('students')->insert(
                ['admissioncode'=>$admissioncode,
                'matricno'=>$matricno,
                'surname'=> $surname,
                'firstname'=>$firstname,
                'middlename'=>$othername,
                'entrysession'=>$entryyear,
                'duration'=>$duration,
                'gender'=>$sex,
                'levelofentry'=>$levelofentry,
                'department'=>$department]);
        
     });
    }
    return redirect('studentmanager/cur')->with('success', 'student added to database.');    
}

public function importCurriculum(Request $request){
    if($request->file('coursefile'))
      {
        $path = $request->file('coursefile')->getRealPath();

        Excel::load($path)->each(function (Collection $csvLine) {
            $csvcode = $csvLine->get('coursecode');//ca
            $csvtitle = $csvLine->get('coursetitle');//exam
            $csvunit = $csvLine->get('unit');
            $csvstatus = $csvLine->get('status');
            $csvdept = $csvLine->get('departmentid');
            $csvlevel = $csvLine->get('level');
            // $session = $csvLine->get('session');

            DB::table('allcombinedcourses_copy')->insert(
                ['coursetitle'=>$csvtitle,
                'coursecode'=>$csvcode,
                'courseunit'=> $csvunit,
                'coursestatus'=>$csvstatus,
                'courselevel'=>$csvlevel,
                // 'sessionid'=>$session,
                'departmentid'=>$csvdept]);
        
     });
    }
    return redirect('studentmanager/cur')->with('success', 'Curriculum added to database.');    
}

public function probation(){
    $probation = DB::table('students')->where('isprobation', '!=', NULL)->get();
// return $probation;
    return view('studentmanager.probation')->with(compact(['probation']));
}

public function jsonstudent(Request $request){
    $studentid= $request->input('studentid');
    if($studentid){
        $details = DB::table('students')->where('matricno', $studentid)->first();
        // DB::table('results')->where('matricno', $studentid)->get();

        return response()->json($details);
    }
}

public function changedeptindex(){
    $combination = DB::table('subjectcombinations')->orderby('subjectcombinname')->get();
    return view('studentmanager.changedept')->with(compact(['combination']));
}

public function changedept(Request $request){

    $studentid = $request->input('studentid');
    $dept = $request->input('combination');
    $student = DB::table('students')->where('matricno', $studentid)->first();
    if(!$student){
        return redirect()->back()->with('error', 'Invalid student information.');
    }

    if($student->Level != 200){
        return redirect()->back()->with('error', 'Student must be in 200 Level.');
    }
    $combination = DB::table('subjectcombinations')->where('subjectcombinName', $student->Major.'/'.$student->Minor)->first();

    if(empty($combination)){
        return redirect()->back()->with('error', 'Invalid Subject combination.');
    }
    $newdept = DB::table('subjectcombinations')->where('subjectcombinId', $dept)->first();
// dd($newdept);
    if(!$newdept){
        return redirect()->back()->with('error', 'Invalid Subject combination.');
    }
    
    $currentsession = DB::table('sessions')->where('currentsession', true)->first();

    $deleteresult = DB::table('results')
    ->where('studentid', $student->StudentID)
    ->whereraw('subjectcode not like "GSE%" or SubjectCode not like "EDU%" or SubjectCode not like "ESA%"')
    ->delete();

    $updateresult = DB::table('results')
    ->where('studentid', $student->StudentID)
    ->whereraw('subjectcode like "GSE%" or SubjectCode like "EDU%" or SubjectCode like "ESA%"')
    ->update(['subjectcombinID'=>$newdept->SubjectCombinID, 'sessionid'=>$currentsession->SessionID]);
    
    

    $curriculum = DB::table('allcombinedcourses')->where('SubjectCombineID', $newdept->SubjectCombinID)
    ->where('sessionid', $currentsession->SessionID)
    ->whereraw('SubjectLevel=100 and (subjectcode not like "GSE%" or SubjectCode not like "EDU%" or SubjectCode not like "ESA%")')
    ->get();

    foreach($curriculum as $cur){
        DB::table('results')
            ->insert(
                ['MatricNo'=>$studentid,
                'SubjectID'=> $cur->SubjectID,
                'CA'=>0,
                'EXAM'=>0,
                'SessionID'=>$currentsession->SessionID,
                'StudentID'=>$student->StudentID,
                'DepartmentID'=>$cur->DepartmentID,
                'SubjectCombinID'=>$newdept->SubjectCombinID,
                'Level'=>$student->Level,
                'TNU'=>$cur->SubjectValue,
                'SubjectValue'=>$cur->SubjectUnit,
                'Semester'=>$cur->Semester,
                'CTCP'=>0,
                'CTNU'=>0,
                'CTNUP'=>0,
                'TCP'=>0,
                'TNUP'=>0]);

                
    }
    DB::table('students')->where('studentid', $student->StudentID)
    ->update(['Registered'=>'True']);

    return redirect()->back()->with('Success', 'Student with '.$studentid.' has been moved successfully to '.$dept.'.');
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
