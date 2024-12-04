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

        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel', 'results.semester as rsemester')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('subjects.subjectunit', '!=', 'R')
        ->get();
        //return $resultaddup;

        //gets the first department for display
        
        $getdeptid = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)
        ->wherein('departments.DepartmentCode', ['EDU', 'GSE', $major, $minor])
        ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'EDU', 'GSE', '$major', '$minor')"))
        ->skip(2)->take(1)->get();
        if(count($getdeptid) < 1){
                dd('No record found! Please use the back button');
        }
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode1 = $getdeptcode1->DepartmentCode;
        $deptid1 = $getdeptcode1->DepartmantID;

        $results1102 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('results.DepartmentID', $getid)
        ->groupBy('matricno');

        $results1 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('results.DepartmentID', $getid)
        ->groupBy('matricno')
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
        

        $results2 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
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

        $results3 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->get();
        // dd($results3);

        $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)->skip(1)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode4 = $getdeptcode1->DepartmentCode;
        $deptid4 = $getdeptcode1->DepartmantID;

        $results4 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->get();
        // return $results4;
        //->take(100)
        
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */

            $compulsorycourses = DB::table('allcombinedcourses')
            // ->leftjoin('subjects', 'allcombinedcourses.subjectid', '=', 'subjects.subjectid')
            ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectlevel as subjectlevel', 'allcombinedcourses.semester as semester')
            ->where('SubjectCombineID', $programme)
            ->where('sessionid', $session01)
            ->where('allcombinedcourses.SubjectLevel', $level01)
        //     ->where('allcombinedcourses.Semester', $semester01)
            ->where('allcombinedcourses.subjectunit', 'C')
            ->where('allcombinedcourses.subjectvalue','!=', 0)
            ->where('old', 0)
            ->orderby('allcombinedcourses.subjectcode')
            ->get();

        $resultaddup2 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('subjects.subjectunit', '!=', 'R')
        ->get();
        // return $resultaddup2;