<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SuspensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('sessions')->get();
        view()->share('sessions', $sessions);
    return view('suspension.index');
     }

    public function probation()
    {
        
    return view('suspension.probation');
    }

     public function suspend(Request $request)
     {
        
        // Gets the query string from our form submission 
        $matricno = $request->input('matricno'); 
        $session = $request->input('session');
        $semester = $request->input('semester');

        $checkprobation = DB::table('students')->where('matricno', $matricno)->first();

        if(empty($checkprobation->IsProbation)){
            return redirect('suspension')->with('error', 'Student is not on probation. Please place on probation before effecting suspension.');
        }

        $currentsession = DB::table('sessions')->max('sessionid');
        if($semester == 1){
            DB::table('results')
            ->where('matricno', $matricno)
            ->where('sessionid', $session)
            ->delete();

            $lastsession = DB::table('results')->where('matricno', $matricno)->groupby('sessionid')->orderby('sessionid')->get();
            if(empty($lastsession)){
                DB::table('students')->where('matricno', $matricno)->update(['isprobation' => NULL]);
                return redirect('suspension')->with('success', 'Student returned to 100 Level.');
            }
            $abc="";
            $isession = DB::table('results')->where('matricno', $matricno)->max('sessionid');
            $sessiondifference = $currentsession - $isession - 1;

            foreach($lastsession as $lsession){
               
                DB::table('results')
                ->where('matricno', $matricno)
                ->where('sessionid', $lsession->SessionID)
                ->where('level', $lsession->Level)
                ->update(['sessionid' => $sessiondifference + $lsession->SessionID]);
                $abc .= $sessiondifference + $lsession->SessionID.' - ';
            }
           
        } else {
            DB::table('results')
            ->where('matricno', $matricno)
            ->where('sessionid', $session)
            ->where('semester', $semester)
            ->delete();

            $lastsession = DB::table('results')->where('matricno', $matricno)->groupby('sessionid')->orderby('sessionid')->get();
            if(empty($lastsession)){
                DB::table('students')->where('matricno', $matricno)->update(['isprobation' => NULL]);
                return redirect('suspension')->with('success', 'Student returned to 100 Level.');
            }

            $isession = DB::table('results')->where('matricno', $matricno)->max('sessionid');
            $sessiondifference = $currentsession - $isession - 1;

            foreach($lastsession as $lsession){

                DB::table('results')
                ->where('matricno', $matricno)
                ->where('sessionid', $lsession->SessionID)
                ->where('level', $lsession->Level)
                ->update(['sessionid' => $sessiondifference + $lsession->SessionID]);
            }
        }

        DB::table('students')
        ->where('matricno', $matricno)
        ->update(['isprobation' => NULL]);
        return redirect('suspension')->with('success', 'Student is no more on suspension.');

     }

     public function placeonprobation(Request $request)
     {
        
        // Gets the query string from our form submission 
        $matricno = $request->input('matricno'); 
        $probationtype = $request->input('probationtype');
        $checkprobation = DB::table('students')->where('matricno', $matricno)->first();

        if(!empty($checkprobation->IsProbation)){
            return redirect('suspension')->with('error', 'Student is already on probation.');
        }

        DB::table('students')
        ->where('matricno', $matricno)
        ->update(['isprobation' => $probationtype]);

        return redirect('suspension/probation')->with('success', 'You have place the student under probation.');
        
     }
     
     public function studentlistindex(){
        return view('statistics.studentlist');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        //
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
