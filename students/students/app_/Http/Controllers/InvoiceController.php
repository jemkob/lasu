<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Student;

class InvoiceController extends Controller
{
    //show user form
    public function invoice()
    {
        $country = DB::table('nation')->orderBy('nationname')->get();
        $states = DB::table('state')->orderby('statename')->get();
        $lga = DB::table('localgovt')->leftjoin('state', 'localgovt.stateid', '=', 'state.stateid')->orderby('localgovt.stateid')->get();
        $subcom = DB::table('subjectcombinations')->orderby('subjectcombinname')->get();
        return view('student.invoice')->with('country', $country)->with('states', $states)->with('subcom', $subcom)->with('lga', $lga);
    }

    public function jsstates(Request $request){
        $countryid = $request->input('countryid');
        $states = DB::table('state')->where('nationid', $countryid)->get();
        return response()->json($states);
    }
    public function jslocalgovt(Request $request){
        $state = $request->input('stateid');
        $localgovt = DB::table('localgovt')->where('stateid',  $state)->get();
        return response()->json($localgovt);
      }
  

    //post url for submit form
    public function postinvoice(Request $request){

       
        /*
        $major = substr($request->input('subjectcomb'), 0,3);
        $minor = substr($request->input('subjectcomb'), -3);

        $student->Surname = $request->input('Surname');
        $student->Firstname = $request->input('firstname');
        $student->Middlename = $request->input('Middlename');
        $student->SOR = $request->input('SOR');
        $student->Nationality = $request->input('country');
        $student->FacultyName = $request->input('facultyName');
        $student->JambRegNo = $request->input('jambno');
        $student->PhoneNumber = $request->input('phonenumber');
        $student->MaritalStatus = $request->input('maritalstatus');
        
        $student->DateOfBirth = $request->input('dateofbirth');
        $student->PlaceOfBirth = $request->input('placeofbirth');
        $student->Major = $major;
        $student->Minor = $minor;

        $student->Gender = $request->input('gender');
        $student->HomeAddress = $request->input('homeaddress');
        $student->Religion = $request->input('religion');*/

        $major = substr($request->input('subjectcomb'), 0,3);
        $minor = substr($request->input('subjectcomb'), -3);

        $user = new Student();
        $user->Surname = $request->input('surname');
        $user->Firstname = $request->input('firstname'); 
        $user->Middlename = $request->input('othername'); 
        $user->Email = $request->input('email'); 
        $user->PhoneNumber = $request->input('phonenumber');
        $user->HomeAddress = $request->input('homeaddress');
        $user->Nationality =$request->input('country');
        $user->LGA = $request->input('localgovt');
        $user->SOR = $request->input('state');
        $user->Major = $major;
        $user->Minor = $minor;
        $user->JambRegNo = $request->input('jambno');
        $user->Gender = $request->input('gender');
        $user->Religion = $request->input('religion');
        $user->SponsorsName = $request->input('sponsorsname');
        $user->SponsorsPhoneNumber = $request->input('sponsorsphone');
        $user->SponsorsAddress = $request->input('sponsorsaddress');
        // $user->Relationship = $request->input('relationship');
        $user->PlaceOfBirth = $request->input('placeofbirth');
        $user->DateOfBirth = $request->input('dateofbirth');
        $user->Level = 100; 
            
        try{
            $user->save();

            $getid = DB::table('students')->where('jambregno', $request->input('jambno'))->first();
            DB::table('studentimages')->insert(['studentid' => $getid->StudentID]);

            return redirect('student/showinvoice')->with('success', "Proceed!");
        }
        catch(Exception $e){
            return redirect(url()->previous())->with('error', "Something went wrong, please check your information!");
        }
        return redirect(url()->previous())->with('error', "Error Occured, please try again!");

    }

    // after form submit, redirect to this page where all users will be showcased
    public function showinvoice()
    {
        $users = DB::table('students')
        ->orderBy('StudentID', 'desc')
        ->first();

        return view('student.showinvoice', compact('users'));
    }
}
