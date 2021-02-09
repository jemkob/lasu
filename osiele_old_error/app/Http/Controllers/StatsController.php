<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('statistics.index')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

    public function index2()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems2')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

    public function index3()
    {
        $faculties = DB::table('faculties')->get();
        $sessions = DB::table('sessions')->orderby('SessionID', 'desc')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
        
        //$programmes = DB::table('subjectcombinations')->get();
          
    return view('ems.ems3')->with('faculties', $faculties)->with('sessions', $sessions)->with('subject', $subject);
     }

     public function search(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;
        $dateofbirth = $request->input('dateofbirth');
        $gender = $request->input('gender');
        $state = $request->input('state');
        $lga = $request->input('lg');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $results = DB::table('students')
        ->selectraw('sum('.$gender.'="male") as male, sum('.$gender.'="female") as female, sor as state, sum('.$gender.'="male")+sum('.$gender.'="female") as total, lga as LG')
        //->select(DB::raw('sum('.$gender.'="male") as male, sum('.$gender.'="female") as female'), 'sor as state')
        //->leftjoin('results','students.studentid', '=', 'results.studentid')
        //->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        //->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('students.registered', 'true')
        ->where('students.facultyname', $faculty)
        //->where('students.level', 100)
        ->groupby('students.lga')
        ->orderby('students.sor')
        ->get();
        // return $results;
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('statistics.index')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results); 
        
     }

     public function searchems2(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $departments = $request->input('departments');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $course = $request->input('course');
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        ->where('departments.departmantid', $departments)
        ->orderby('matricno')
        ->get();
        // return $results;
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems2')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results); 
        
     }
     public function searchems3(Request $request)
     {
        
        // Gets the query string from our form submission 
        $faculty = $request->input('faculties');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $programme = $request->input('programmes');
        $course = $request->input('course');
        $dept = DB::table('departments')->select('DepartmantID')->where('FacultyID', $faculty)->get();
        //return $dept;

        $results = DB::table('results')
        ->leftjoin('departments','results.departmentid', '=', 'departments.departmantid')
        ->leftjoin('subjectcombinations', 'results.subjectcombinid', '=', 'subjectcombinations.subjectcombinid')
        ->where('sessionid', $sessions->SessionID)
        ->where('subjectid', $course)
        //->where('departments.facultyid', $faculty)
        ->where('subjectcombinations.subjectcombinid', $programme)
        ->get();
        // return $results;
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        $subject = DB::table('subjects')->orderby('SubjectCode')->get();
     
        return view('ems.ems3')->with('faculties', $faculties)->with('subject', $subject)->with('dept', $dept)->with('results', $results); 
        
     }
     public function studentlistindex(){
        return view('statistics.studentlist');
     }

     public function studentlist(Request $request)
     {
        
        // Gets the query string from our form submission 
        $studentlist = $request->input('studentlist');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();

        if($studentlist =='subjectcombination'){
        $program = DB::table('subjectcombinations')->get();
        $students = DB::table('students')
        ->selectraw('level, CONCAT(Major, "/", Minor) as program, count(matricno) as total, sUM(gender="male") AS male, SUM(gender="female") AS female')
        ->where('registered', 'true')
        ->groupby('major', 'minor', 'level')
        ->get();
        return view('statistics.studentlist')->with('program', $program)->with('students', $students);
        // return $students;
        } elseif($studentlist == 'school'){
        $faculty = DB::table('faculties')->get();
        $school = DB::table('students')
        ->selectraw('level, facultyname, count(matricno) as total, sUM(gender="male") AS male, SUM(gender="female") AS female')
        ->where('registered', 'true')
        ->groupby('facultyname', 'level')
        ->get();
        $allstudents = DB::table('students')
        ->where('registered', 'true')
        ->get();
        return view('statistics.studentlist')->with('faculty', $faculty)->with('school', $school)->with('allstudents', $allstudents);
        } 
     }

    public function studentinfoindex(){
        return view('statistics.studentinfo');
    }

    public function studentinfo(Request $request){
            $level = $request->input('level');

            $faculty = DB::table('faculties')->get();
            $students = DB::table('students')
            ->selectraw('level, facultyname, firstname, surname, middlename, major, minor, matricno, gender, phonenumber')
            ->where('registered', 'true')
            ->where('level', $level)
            ->orderby('matricno')
            ->get();
            return view('statistics.studentinfo')->with('faculty', $faculty)->with('students', $students);
            
    }
    

    public function lecturerinfoindex(){
        return view('statistics.lecturerinfo');
    }

    public function lecturerinfo(){
        $lecturercourses = DB::table('lecturerprofiles')
        ->leftjoin('lecturers','lecturerprofiles.lecturerid', '=', 'lecturers.lecturerid')
        ->selectraw('count(subjectid) as subjects, lecturerprofiles.lecturerid, lecturers.firstname as firstname, lecturers.surname as surname, lecturers.middlename as middlename')
        ->groupby('lecturers.lecturerid')
        ->orderby('lecturers.surname')
        ->get();

        // return $lecturercourses;

        return view('statistics.lecturerinfo')->with('lecturercourses', $lecturercourses);
    }

    public function courselist(){
        $courselist = DB::table('subjects')
        ->leftjoin('departments', 'departmentcode', DB::raw('substring(subjectcode,1,3)'))
        ->orderby('subjectcode')
        ->get();
        $get300 = DB::table('students')->selectraw('matricno, major, minor')->where('registered', 'true')->where('level', 300)->take(10)->get();
        //echo $get300;
        // return $courselist;
        // $thematric = ['17/1600', '17/1601', '17/1602'];
        //dd(count($themat));
        // $thematric = collect($get300);
        // $kkk = "";
        // foreach($thematric as $themat){ $kkk[] .= $themat->matricno.", ";}
        // $kkk = str_replace_last(', ','',$kkk);
        // // $thematric[] = '['.$kkk.']';
        // $get30[] = $kkk;
        // return array_get($get300, 'matricno');
        foreach($get300 as $themat){
        $results3 = DB::table('results')
        ->groupBy('matricno')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('matricno',  $themat->matricno)
        ->where('lecturerinserted', 'true')
        ->get();

        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('matricno',  $themat->matricno)
        ->get();

            //third department
            
            $collection = collect($results3);
            $filtered = $collection;
            $filtered->all();

            $rescollection = collect($resultaddup);
            $resfiltered = $rescollection->sortbydesc('subjectcodeco')->unique();
            $resfiltered->all();
            $allcalc= 0;
            $alltnups3=0;
            $tnup3=0;
            
            foreach($resfiltered as $resfilt){
                $calculate=$resfilt->ca+$resfilt->exam;
                $gettnup = $resfilt->tnu;
            
            if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
            elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
            //endif
            $allcalc +=$calculates;

            $alltnups3 +=$gettnup; 
            
            $tcp3 = $allcalc;
            $tnu3 = $results3->first()->sum2;
            $tnup3 = $results3->first()->sum;
            }
            $cgpa3 = 0;
            $tnuaddup3 = collect($results3)->sum('sum2');
            if($allcalc > 0 && $alltnups3 > 0){
            $cgpa3 = number_format($allcalc/$tnuaddup3, 2);
            } else {
            $cgpa3 = 0.00;
            }

            echo $themat->matricno.' with '.$themat->major. '/'.$themat->minor.' = '. $cgpa3.', ';
        }
        return '<br>';

        return view('statistics.courselist')->with('courselist', $courselist);
    }
    public function majorminor(){
        return view('statistics.majorminor');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
