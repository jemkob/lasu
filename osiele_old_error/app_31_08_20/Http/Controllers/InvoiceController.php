<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //show user form
    public function invoice()
    {
        return view('student/invoice');
    }

    //post url for submit form
    public function postinvoice(Request $request){

        $this->validate($request, [
            'name' => 'required|min:2|max:30',
            'lastname' => 'required|min:2|max:30',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name; 
        $user->lastname = $request->lastname; 
        $user->email = $request->email; 
        $user->phone = $request->phone; 
        $user->address = $request->address;
        try{
            $user->save();

            return redirect()->route('showinvoice')->with('success', "User was successfully created..!");
        }
        catch(Exception $e){
            return redirect()->back()->with('error', "Could not save the user!");
        }
        return redirect()->back()->with('error', "Error Occured, please try again!");

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
