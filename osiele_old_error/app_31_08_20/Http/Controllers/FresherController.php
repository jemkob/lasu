<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use File;
use Illuminate\Http\Response;
use Auth;
use PDF;


class FresherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('studentmanager.fresher');
    }
    public function fresherindex(){
        return view('studentmanager.fresher');
    }
    //
    public function import(Request $request){
    if($request->file('fresherfile'))
      {
        $path = $request->file('fresherfile')->getRealPath();

        Excel::load($path)->each(function (Collection $csvLine) {
            $csvfirstname = $csvLine->get('firstname');//ca
            $csvsurname = $csvLine->get('surname');//exam
            $csvmiddlename = $csvLine->get('middlename');
            $csvphone = $csvLine->get('phone_no');
            $csvjamb = $csvLine->get('jamb');
            $csvgender = $csvLine->get('gender');
            $csvreligion = $csvLine->get('religion');
            $csvaddress = $csvLine->get('address');
        /* if($csvca != '[]' || $csvca != NULL){
            $csvca = 0;
        }
        if($csvexam == '' || $csvexam == NULL){
            $csvexam = 0;
        } */
        
        /* DB::table('results')
            ->where('results.MatricNo', $csvLine->get('matricno'))
            ->where('results.SubjectID', $subjectupload)
            ->where('results.sessionid', $sessions->SessionID)
            ->where('results.CA', 0)
            ->orWhere('results.EXAM', 0)
            //->where('SubjectID', $subjectupload)
            ->update(['CA' => $csvLine->get('ca'),'EXAM' => $csvLine->get('exam')]); */ 
            DB::table('students')->insert(
                ['firstname'=>$csvfirstname,
                'surname'=>$csvsurname,
                'gender'=> $csvgender,
                'religion'=>$csvreligion,
                'jambregno'=>$csvjamb]);
        
     });
    }
    return redirect('studentmanager/fresher')-with('success', 'Students information added to database.');    
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sessionmanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

