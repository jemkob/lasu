<?php
        //Irregular courses eg. 100 level course in 200 without a curriculum
        $resultaddup1 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.courseunit as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.coursestatus as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01-300)
        ->where('results.SessionID', $session01-3)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-300)
        ->where('allcombinedcourses.sessionid', $session01-3)
        ->where('allcombinedcourses.departmentid', $department)
        ->orderby('results.matricno')
        ->orderby('allcombinedcourses.coursecode');

        $resultaddup2 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.courseunit as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.coursestatus as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01-200)
        ->where('results.SessionID', $session01-2)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-200)
        ->where('allcombinedcourses.sessionid', $session01-2)
        ->where('allcombinedcourses.departmentid', $department)
        ->orderby('results.matricno')
        ->orderby('allcombinedcourses.coursecode');

        $resultaddup3 = DB::table('allcombinedcourses')
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
        ->unionall($resultaddup2)
        ->unionall($resultaddup3)
        ->get();
        //return $resultaddup;

        //gets the first department for display
        
        

        //get 200level 1st semester
        

        $results300 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01-100)
        ->where('results.SessionID', $session01-1)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-100)
        ->where('allcombinedcourses.sessionid', $session01-1)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno');

        $results200 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01-200)
        ->where('results.SessionID', $session01-2)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-200)
        ->where('allcombinedcourses.sessionid', $session01-2)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno');

        $results100 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01-300)
        ->where('results.SessionID', $session01-3)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01-300)
        ->where('allcombinedcourses.sessionid', $session01-3)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno');
        
        // ->get();

        // $currentsession = $session01;
        // $prevsession = $currentsession.', '.$session01-1;
        // $prevlevel = 0;
        $results1 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01)
        ->where('results.SessionID', $session01)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01)
        ->where('allcombinedcourses.sessionid', $session01)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno')
        ->unionall($results100)
        ->unionall($results200)
        ->unionall($results300)
        ->get();
// return $results1;

        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */

            $compulsorycourses1 = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01-300)
            ->where('SessionID', $session01-3);

            $compulsorycourses2 = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01-200)
            ->where('SessionID', $session01-2);

            $compulsorycourses3 = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01-100)
            ->where('SessionID', $session01-1);
            
        $compulsorycourses = DB::table('allcombinedcourses')
            ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
            ->where('departmentid', $department)
            ->where('CourseLevel', $level01)
            ->where('SessionID', $session01)
            ->orderby('allcombinedcourses.coursecode')
            ->unionall($compulsorycourses1)
            ->unionall($compulsorycourses2)
            ->unionall($compulsorycourses3)
            ->get();

        