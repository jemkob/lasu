<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CourseAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$sessions = DB::table('sessions')->get();
        $courseview = DB::table('subjects')
        ->join('lecturerprofiles', 'subjects.SubjectID', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select('subjects.subjectname as subjectname', 'subjects.subjectid as subjectid', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->orderby('subjects.subjectcode', 'asc')
        ->paginate(50);

        return view('courseassignment.index')->with('courseview', $courseview);
    }
    public function editCourseAssignment()
    {
        //
        //$sessions = DB::table('sessions')->get();
        $courseview = DB::table('subjects')
        ->join('lecturerprofiles', 'subjects.SubjectID', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->paginate(50);

        return view('courseassignment.index')->with('courseview', $courseview);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecturers = DB::table('lecturers')->orderby('surname')->get();
        $subjects = DB::table('subjects')->orderby('subjectcode')->get();

        return view('courseassignment.create')->with('lecturers', $lecturers)->with('subjects', $subjects);
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
        
        $courseview = DB::table('subjects')
        ->join('lecturerprofiles', 'subjects.SubjectID', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid', 'lecturers.LecturerID as lecturerid', 'subjects.SubjectID as subjectid')
        ->where('lecturerprofiles.LecturerID', $id)
        ->get();

        $lecturers = DB::table('lecturers')->get();
        $subjects = DB::table('subjects')->get();

        return view('courseassignment.edit')->with('courseview', $courseview)->with('lecturers', $lecturers)->with('subjects', $subjects);
    }

    public function ShowCourseAssignment(Request $request)
    {
        $id = $request->input('id');
        $courseview = DB::table('lecturerprofiles')
        ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectid as subjectid', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.lecturerid as lecturerid', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('subjects.SubjectID', $id)
        ->first();

        $course = DB::table('lecturerprofiles')
        ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectid as subjectid', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.lecturerid as lecturerid', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('subjects.SubjectID', $id)
        ->get();

        $lecturers = DB::table('lecturers')->where('surname', '!=', null)->orderby('surname')->get();
        $subjects = DB::table('subjects')->get();

        return view('courseassignment.edit')->with('courseview', $courseview)->with('lecturers', $lecturers)->with('subjects', $subjects)->with('course', $course);
    }

    public function SearchAssignment(Request $request)
    {
        $id = $request->input('search');
        $courseview = DB::table('subjects')
        ->join('lecturerprofiles', 'subjects.SubjectID', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'subjects.subjectname as subjectname', 'subjects.subjectcode as subjectcode', 'subjects.subjectunit as subjectunit', 'subjects.subjectvalue as subjectvalue', 'subjects.subjectid as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('lecturers.surname', $id)
        ->orwhere('subjects.subjectcode', 'like', '%'.$id.'%')
        ->orwhere('subjects.subjectname', 'like', '%'.$id.'%')
        ->orwhere('lecturers.firstname', 'like', '%'.$id.'%')
        ->orderby('subjects.subjectcode', 'asc')
        ->paginate(50);

        return view('courseassignment.index')->with('courseview', $courseview);
    }

    public function AssignLecturer(Request $request)
    {
        $subjectid = $request->input('subjectid');
        $lecturerid = $request->input('lecturerid');
        DB::table('lecturerprofiles')
            ->insert(
                ['lecturerid'=>$lecturerid,
                'SubjectID'=> $subjectid]);

                return redirect('/courseassignment')->with('success', 'Lecturer has been assigned');

    }

    public function RemoveLecturer(Request $request){
        $id = $request->input('lecturerprofileid');
        DB::table('lecturerprofiles')
            ->where('lecturerprofileid', $id)
            ->delete();

                return redirect('/courseassignment')->with('success', 'Lecturer has been removed.');
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
