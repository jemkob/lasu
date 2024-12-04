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
        $courseview = DB::table('courses')
        ->join('lecturerprofiles', 'courses.id', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select('courses.coursetitle as subjectname', 'courses.id as subjectid', 'courses.coursecode as subjectcode', 'courses.courseunit as subjectunit', 'courses.coursestatus as coursestatus', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->orderby('courses.coursecode', 'asc')
        ->paginate(50);

        return view('courseassignment.index')->with('courseview', $courseview);
    }
    public function editCourseAssignment()
    {
        //
        //$sessions = DB::table('sessions')->get();
        $courseview = DB::table('courses')
        ->join('lecturerprofiles', 'courses.id', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select('courses.coursetitle as subjectname', 'courses.id as subjectid', 'courses.coursecode as subjectcode', 'courses.courseunit as subjectunit', 'courses.coursestatus as coursestatus', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
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
        $subjects = DB::table('courses')->orderby('coursecode')->get();

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
        ->join('lecturerprofiles', 'courses.id', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturerprofiles', 'courses.id', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'courses.subjectname as subjectname', 'courses.subjectcode as subjectcode', 'courses.subjectunit as subjectunit', 'courses.subjectvalue as subjectvalue', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid', 'lecturers.LecturerID as lecturerid', 'courses.id as subjectid')
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
        ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'courses.id')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'courses.subjectname as subjectname', 'courses.id as subjectid', 'courses.subjectcode as subjectcode', 'courses.subjectunit as subjectunit', 'courses.subjectvalue as subjectvalue', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.lecturerid as lecturerid', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('courses.id', $id)
        ->first();

        $course = DB::table('lecturerprofiles')
        ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'courses.id')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'courses.subjectname as subjectname', 'courses.id as subjectid', 'courses.subjectcode as subjectcode', 'courses.subjectunit as subjectunit', 'courses.subjectvalue as subjectvalue', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.lecturerid as lecturerid', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('courses.id', $id)
        ->get();

        $lecturers = DB::table('lecturers')->where('surname', '!=', null)->orderby('surname')->get();
        $subjects = DB::table('subjects')->get();

        return view('courseassignment.edit')->with('courseview', $courseview)->with('lecturers', $lecturers)->with('subjects', $subjects)->with('course', $course);
    }

    public function SearchAssignment(Request $request)
    {
        $id = $request->input('search');
        $courseview = DB::table('courses')
        ->join('lecturerprofiles', 'courses.id', '=', 'lecturerprofiles.SubjectID')
        ->join('lecturers', 'lecturerprofiles.LecturerID', '=', 'lecturers.LecturerID')
        ->select( 'courses.coursetitle as subjectname', 'courses.coursecode as subjectcode', 'courses.courseunit as subjectunit', 'courses.coursestatus as subjectvalue', 'courses.id as subjectid', 'lecturers.firstname as firstname', 'lecturers.surname as surname', 'lecturerprofiles.Lecturerprofileid as lecturerprofileid')
        ->where('lecturers.surname', $id)
        ->orwhere('courses.coursecode', 'like', '%'.$id.'%')
        ->orwhere('courses.coursetitle', 'like', '%'.$id.'%')
        ->orwhere('lecturers.firstname', 'like', '%'.$id.'%')
        ->orderby('courses.coursecode', 'asc')
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
