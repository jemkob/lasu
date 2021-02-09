<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Session;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::orderBy('SessionYear','asc')->paginate(100);
        //$users = DB::table('students')->take(10)->get();
          
        return view('sessionmanager.index')->with('sessions', $sessions);
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
        DB::table('sessions')
            //->where('SessionID', 1)
            ->update(['CurrentSession' => 0]);
            
        $sessions = new Session;
        $sessions->CurrentSession = $request->input('currentsession');
        $sessions->SessionYear = $request->input('session');
        //$sessions->CurrentSession = $request->input('currentsession');
        
        $sessions->save();

        return redirect('/sessionmanager')->with('success', 'Session Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sessions = Session::find($id);

        return view('sessionmanager.show')->with('sessions', $sessions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sessions = Session::find($id);

        return view('sessionmanager.edit')->with('sessions', $sessions);
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
        DB::table('sessions')
            //->where('SessionID', 1)
            ->update(['CurrentSession' => 0]);
        
        $sessions = Session::find($id);

        //return $sessions;
        $sessions->CurrentSession = $request->input('currentsession');
        $sessions->SessionYear = $request->input('sessionyear');
        
        $sessions->save();

        
        //$subjects->Active = $request->input('active');
        return redirect('/sessionmanager')->with('success', 'Session updated');
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
