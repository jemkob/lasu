<?php
// $results = DB::table('results')
// ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmentID')
// ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
// ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         
// ->groupBy('results.MatricNo')
// ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
// ->where('results.Level', $level01)
// ->where('results.SessionID', $session01)
// ->where('results.departmentid', $department)
// // ->where('allcombinedcourses.courselevel', $level01)
// //     ->where('allcombinedcourses.sessionid', $session01)
// //     ->where('allcombinedcourses.departmentid', $department)
// // ->paginate(20);
// ->get();

        // $a=collect($results);
        // $b=$a->union($a);
        // dd($b);

        //Irregular courses eg. 100 level course in 200 without a curriculum
        $resultaddup1 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.courseunit as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.coursestatus as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01-100)
        ->where('results.SessionID', $session01-1)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-100)
        ->where('allcombinedcourses.sessionid', $session01-1)
        ->where('allcombinedcourses.departmentid', $department)
        ->orderby('results.matricno')
        ->orderby('allcombinedcourses.coursecode');

        //100 level
        $resultaddup = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.courseunit as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.coursestatus as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01)
        ->where('results.SessionID', $session01)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01)
        ->where('allcombinedcourses.sessionid', $session01)
        ->where('allcombinedcourses.departmentid', $department)
        ->orderby('results.matricno')
        ->orderby('allcombinedcourses.coursecode')
        ->unionall($resultaddup1)
        ->get();
        //return $resultaddup;

        //gets the first department for display
        
        

        //get 200level 1st semester
        $results100 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01)
        ->where('results.SessionID', $session01)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01)
        // ->where('allcombinedcourses.sessionid', $session01)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno');

        $results1 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', 100)
        ->where('results.SessionID', $session01-1)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', 100)
        ->where('allcombinedcourses.sessionid', $session01-1)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno')
        ->unionall($results100)
        ->get();

        // $currentsession = $session01;
        // $prevsession = $currentsession.', '.$session01-1;
        // $prevlevel = 0;
        
// return $results1;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */
            $compulsorycourses = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01-100)
            ->where('SessionID', $session01-1);
        //     ->orderby('coursecode');
        //     ->get();

        // $compulsorycourses = DB::table('allcombinedcourses')
        // // ->leftjoin('subjects', 'allcombinedcourses.subjectid', '=', 'subjects.subjectid')
        // ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectlevel as subjectlevel', 'allcombinedcourses.semester as semester')
        // ->where('SubjectCombineID', $programme)
        // ->where('allcombinedcourses.sessionid', $session01-1)
        // // ->where('CurricullumID', 2)
        // ->where('allcombinedcourses.SubjectLevel', $level01-100)
        // // ->where('subjects.Semester', $semester01)
        // ->where('allcombinedcourses.subjectunit', 'C')
        // ->where('old', 0)
        // ->where('allcombinedcourses.subjectvalue','!=', 0);
        // // ->get();

        $compulsorycourses = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01)
            ->where('SessionID', $session01)
            ->orderby('allcombinedcourses.coursecode')
            ->unionall($compulsorycourses)
            ->get();

        // $compulsorycourses = DB::table('allcombinedcourses')
        // // ->leftjoin('subjects', 'allcombinedcourses.subjectid', '=', 'subjects.subjectid')
        // ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.subjectlevel as subjectlevel', 'allcombinedcourses.semester as semester')
        // ->where('SubjectCombineID', $programme)
        // ->where('allcombinedcourses.sessionid', $session01)
        // // ->where('CurricullumID', 2)
        // ->where('allcombinedcourses.SubjectLevel', $level01)
        // ->where('allcombinedcourses.Semester', $semester01)
        // ->where('allcombinedcourses.subjectunit', 'C')
        // ->where('old', 0)
        // ->where('allcombinedcourses.subjectvalue','!=', 0)
        // ->unionall($compulsorycourses)
        // ->get();
        // return $compulsorycourses;
        