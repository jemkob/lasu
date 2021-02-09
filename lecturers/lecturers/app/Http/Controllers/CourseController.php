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
        $subjects = Course::orderBy('SubjectCode','asc')->paginate(100);
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
        $subjects->SubjectName = $request->input('subjectname');
        $subjects->SubjectCode = $request->input('subjectname');
        $subjects->SubjectValue = $request->input('subjectname');
        $subjects->SubjectUnit = $request->input('subjectname');
        $subjects->Semester = $request->input('subjectname');
        $subjects->SubjectLevel = $request->input('subjectname');
        

        
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
        $subjects = new Course;
        $subjects->SubjectName = $request->input('subjectname');
        $subjects->SubjectCode = $request->input('subjectname');
        $subjects->SubjectValue = $request->input('subjectname');
        $subjects->SubjectUnit = $request->input('subjectname');
        $subjects->Semester = $request->input('subjectname');
        $subjects->SubjectLevel = $request->input('subjectname');

        $subjects->save();

        return redirect('/course')->with('success', 'Course updated');
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
