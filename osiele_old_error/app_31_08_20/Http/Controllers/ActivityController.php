<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = DB::table('activity')->orderby('activitycode')->get();
          
    return view('activity.index')->with('activities', $activities);
     }

     public function AddActivity (Request $request)
     {
        
        // Gets the query string from our form submission 
        $activitycode = $request->input('activitycode'); 
        $activitydesc = $request->input('activitydesc');

        $AddNew = DB::table('activities')
        ->insert(
            [
            'activitycode'=>$activitycode,
            'activitydescription'=> $activitydesc
            ]);
        
       
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

    public function AddNew(Request $request){
        $activitycode = $request->input('activitycode');
        $activitydesc = $request->input('activitydesc');
        DB::table('activity')->insert(['activitycode'=>$activitycode, 'activitydescription'=>$activitydesc]);

        $theurl = url()->previous();

        return redirect($theurl)->with('success', 'Activity added successfully!');
    }

    public function EditActivity(Request $request){
        $activitycode = $request->input('activitycode');
        $activitydesc = $request->input('activitydesc');
        $activityid = $request->input('activityid');

        DB::table('activity')->where('activityid', $activityid)->update(['activitycode'=>$activitycode, 'activitydescription'=>$activitydesc]);

        $theurl = url()->previous();

        return redirect($theurl)->with('success', 'Activity updated successfully!');
    }

    public function deleteActivity(Request $request){
        $activityid = $request->input('activityid');
        
        DB::table('activity')->where('activityid', $activityid)->delete();

        $theurl = url()->previous();

        return redirect('activity')->with('success', 'Activity deleted successfully!');
    }
    public function ActivityEdit(Request $request)
    {
        $activityid = $request->input('activityid');
        $activity = DB::table('activity')->where('activityid', $activityid)->first();
        return view('activity.edit')->with('activity', $activity);
    }
    public function ActivityUpdate(Request $request)
    {
        $activitycode = $request->input('activitycode');
        $activitydesc = $request->input('activitydesc');
        $activityid = $request->input('activityid');

        DB::table('activity')->where('activityid', $activityid)->update(['activitycode'=>$activitycode, 'activitydescription'=>$activitydesc]);

         $theurl = url()->previous();

        return redirect('activity')->with('success', 'Activity updated successfully!');
    }

    public function ActivityScheduleIndex()
    {
        $activityschedule = DB::table('activityschedule')
        ->leftjoin('activity', 'activityschedule.activityid', '=', 'activity.activityid')
        ->orderby('activityschedule.date_created')->get();

        return view('activity.activityscheduleindex')->with('activityschedule', $activityschedule);
    }

    public function ActivityScheduleCreate(Request $request)
    {
        $startdate = $request->input('startdate');
        $enddate = $request->input('enddate');
        $activityid = $request->input('activityid');

        DB::table('activityschedule')->insert(['activityid'=>$activityid, 'startdate'=>$startdate, 'enddate'=>$enddate]);

         $theurl = url()->previous();

        return redirect('activityschedule')->with('success', 'New Activity scheduled successfully!');
    }

    public function ActivityScheduleNew()
    {
        $activity = DB::table('activity')->orderby('activitydescription')->get();

        return view('activity.activityschedulenew')->with('activity', $activity);
    }

    public function ActivityScheduleDelete(Request $request)
    {
        $scheduleid = $request->input('scheduleid');

        DB::table('activityschedule')->where('activityscheduleid', $scheduleid)->delete();

        return redirect('activityschedule')->with('success', 'Scheduled activity has been removed!');
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
        $activityid = $id;
        $activity = DB::table('activity')->where('activityid', $activityid)->first();
        return view('activity.edit')->with('activity', $activity);
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
