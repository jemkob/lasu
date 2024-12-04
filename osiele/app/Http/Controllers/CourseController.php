<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Course::orderBy('CourseCode','asc')->paginate(100);
        //$users = DB::table('students')->take(10)->get();
          
        return view('course.index')->with('subjects', $subjects);
    }
    
    public function searchCourse(Request $request)
    {
        $search = $request->input('search');
        $search = '%'.$search.'%';
        $subjects = Course::orderBy('CourseCode','asc')
        ->where('Coursecode', 'like', $search)
        ->orwhere('coursetitle', 'like', $search)
        ->paginate(100);
        //$users = DB::table('students')->take(10)->get();
          
        return view('course.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjects = new Course;
        $subjects->CourseTitle = $request->input('subjectname');
        $subjects->CourseCode = $request->input('subjectcode');
        $subjects->CourseStatus = $request->input('subjectstatus');
        $subjects->CourseUnit = $request->input('subjectunit');
        $subjects->CourseLevel = $request->input('subjectlevel');
        // $subjects->Active = $request->input('active');
        $subjects->save();

        return redirect('/course')->with('success', 'Course Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = Course::find($id);

        return view('course.show')->with('subjects', $subjects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = Course::find($id);

        return view('course.edit')->with('subjects', $subjects);
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
        $subjects = Course::find($id);
        $subjects->CourseTitle = $request->input('subjectname');
        $subjects->CourseCode = $request->input('subjectcode');
        $subjects->CourseStatus = $request->input('subjectstatus');
        $subjects->CourseUnit = $request->input('subjectunit');
        $subjects->CourseLevel = $request->input('subjectlevel');
        //$subjects->Active = $request->input('active');

        $subjects->save();

        return redirect('/course')->with('success', 'Course updated');
    }

    public function deleteCourse(Request $request){
        $course=$request->input('subjectid');
        $checkcourse = DB::table('results')->where('exam', 0)->where('ca', 0)->where('subjectid', $course)->get();

        if(isset($checkcourse) && count($checkcourse) > 0){
            return redirect('course')->with('error', 'This course has scores, delete the result for students affected before deleting the course');
        } else {
            DB::table('courses')->where('id', $course)->delete();

            return redirect('course')->with('Success', 'This Course has been deleted from this platform.');
        }
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
