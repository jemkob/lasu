<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudInsertController extends Controller {
   public function insertform(){
      return view('stud_create');
   }
	
   public function insert(Request $request){
    //   $name = $request->input('stud_name');
    //   DB::insert('insert into sponsor (name) values(?)',[$name]);
    //   echo "Record inserted successfully.<br/>";
    //   echo '<a href = "/insert">Click Here</a> to go back.';

      $surname = $request->input('surname');
      $firstname = $request->input('firstname');
      $othername = $request->input('othername');
      $country = $request->input('country');
      $state = $request->input('state');
      $lga = $request->input('lga');
      $email = $request->input('email');
      $phone = $request->input('phone');
      $major = $request->input('major');
      $minor = $request->input('minor');
      $gender = $request->input('gender');
      $invoice = $request->input('invoice');

      $subjectcomb = $request->input('subjectcomb');
      $jamb = $request->input('jamb');
      DB::table('students')->insert(
        ['surname' => $surname, 'firstname' => $firstname, 'middlename' => $othername, 'nationality' => $country, 'sor' => $state, 'lga' => $lga, 'email' => $email, 'phonenumber' => $phone, 'major' => $major, 'minor' => $minor, 'gender' => $gender, 'invoicenumber' => $invoice, 'Level' => 100]
    );
    $getid = DB::table('students')->where('jambregno', $jamb)->first();
      DB::table('studentimages')->insert(['studentid', $getid->StudentID]);
      
    return redirect('student/showinvoice')->with('success', "User was successfully created..!");
   }
}