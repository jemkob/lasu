<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Admin;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('admins')
        ->leftjoin('roles', 'admins.role', '=', 'roles.roleid')
        ->get();
        //$users = DB::table('students')->take(10)->get();
          
        return view('usermanager.index')->with('users', $users);
    }

    public function searchLecturer(Request $request)
    {
        $search = $request->input('search');
        $search = '%'.$search.'%';
        $staffs = Staff::orderBy('Surname','asc')
        ->where('surname', 'like', $search)
        ->orwhere('firstname', 'like', $search)         
        ->paginate(50);
        //$users = DB::table('students')->take(10)->get();
          
        return view('staffmanager.index')->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')->orderby('rolename')->get();
        return view('usermanager.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $checkuser = DB::table('admins')->where('username', $request->input('username'))->get();
        if(count($checkuser) > 0){
            $theurl = url()->previous();
            return redirect($theurl)->with('error', 'username already exist, choose another unique username');
        }
        $admin = new Admin;
        $admin->Username = $request->input('username');
        $admin->Password = $request->input('password');
        $admin->email = $request->input('email');
        $admin->role = $request->input('role');
        
        $admin->save();

        return redirect('usermanager')->with('success', 'A new user has been added.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::find($id);

        return view('usermanager.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $staffs = Staff::find($id)
        $roles = DB::table('roles')->orderby('rolename')->get();

        $users = DB::table('admins')
        ->where('adminid', $id)
        ->first();

        return view('usermanager.edit')->with('users', $users)->with('roles', $roles);
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
        
        $admin = Admin::find($id);
        //return $sessions;
        $admin->Username = $request->input('username');
        $admin->Password = $request->input('password');
        $admin->email = $request->input('email');
        $admin->role = $request->input('role');
        $admin->save();
        
        //$subjects->Active = $request->input('active');
        return redirect('usermanager')->with('success', 'User details updated.');
    }

    public function deleteLecturer(Request $request)
    {
        $lecturerid= $request->input('studentid');
        DB::table('lecturers')
        ->where('lecturerid', $lecturerid)
        ->delete();

        return redirect('/staffmanager')->with('success', 'Lecturer Deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);

        $staff->delete();
        return redirect('/staffmanager')->with('success', 'Lecturer Deleted.');

    }


}
