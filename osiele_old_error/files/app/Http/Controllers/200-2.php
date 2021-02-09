<?php
$results = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         ->groupBy('results.MatricNo')
        ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        //->paginate(20)
        ->get();

        $results200 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         ->groupBy('results.MatricNo')
        ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        //->paginate(20)
        ->get();

        // $a=collect($results);
        // $b=$a->union($a);
        // dd($b);

        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level01-100)
        // ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->orderby('results.resultid');

        //100 level
        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->orderby('results.resultid')
        ->unionall($resultaddup)
        
        ->get();
        //return $resultaddup;

        //gets the first department for display
        
        $getdeptid = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)
        ->wherein('departments.DepartmentCode', ['EDU', 'GSE', $major, $minor])
        ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'EDU', 'GSE', '$major', '$minor')"))->skip(2)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode1 = $getdeptcode1->DepartmentCode;
        $deptid1 = $getdeptcode1->DepartmantID;

        //get 200level all semester
        $results22001 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);
        

        $results1 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results22001)
        ->get();
// return $results1;

        
        if($major !== $minor){
        //$arrayed = $results->first()->matricno;
        $getdeptid = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)
        ->wherein('departments.DepartmentCode', ['EDU', 'GSE', $major, $minor])
        ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'EDU', 'GSE', '$major', '$minor')"))
        ->skip(3)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode2 = $getdeptcode1->DepartmentCode;
        $deptid2 = $getdeptcode1->DepartmantID;

        //get 200level all semester
        $results22001 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);
        

        $results2 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results22001)
        ->get();
        // return $results2;
        } else{
        $deptcode2 ="";
        $deptid2=0;
        $results2 = array();
        }

        
        $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)->skip(0)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode3 = $getdeptcode1->DepartmentCode;
        $deptid3 = $getdeptcode1->DepartmantID;
        //return $deptcode3;

        //get 200level 1st semester
        $results32001 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        $results3 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results32001)
        ->get();
        //dd($results3);

        $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)->skip(1)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode4 = $getdeptcode1->DepartmentCode;
        $deptid4 = $getdeptcode1->DepartmantID;
        
        //get 200level 1st semester
        $results42001 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        // $currentsession = $session01;
        // $prevsession = $currentsession.', '.$session01-1;
        // $prevlevel = 0;
        $results4 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->union($results42001)
        ->get();
        // return $results4;
        //->take(100)

        // $a=collect($results42001);
        // $b=$a->union($a);
        //dd($results4);

        
        
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */

        $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', 2)
        ->where('subjects.SubjectLevel', $level01)
        ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->get();
        // return $compulsorycourses;

        $resultaddup2 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->get();
        // return $resultaddup2;
        