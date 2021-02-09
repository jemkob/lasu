<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MinmaxController extends Controller
{
    //
    public function index()
    {
        $minmax = DB::table('minmax')->get();
        return view('misc.index')->with('minmax',$minmax);
    }
    public function update(Request $req){
        $mini = $req->input('mini');
        $maxi = $req->input('maxi');
        $edumin = $req->input('edumin');
        $edumax = $req->input('edumax');
        $gsemin = $req->input('gsemin');
        $gsemax = $req->input('gsemax');
        $id = $req->input('minmaxid');

        DB::table('minmax')->where('minmaxid', $id)->update(['minimum'=>$mini, 'maximum'=>$maxi, 'edumin'=>$edumin, 'edumax'=>$edumax, 'gsemin'=>$gsemin, 'gsemax'=>$gsemax]);
        
        return redirect('minmax')->with('success', 'Minimum maximum updated successfully.');
    }
}
