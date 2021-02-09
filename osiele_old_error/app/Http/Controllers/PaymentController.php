<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $payments = DB::table('payments')->get();

        return view('payments')->with(compact('payments'));
    }

    

    

    
       
}
