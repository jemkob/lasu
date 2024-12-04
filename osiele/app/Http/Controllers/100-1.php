<?php

        // $results = DB::table('results')
        //     ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmentID')
        //     ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        //     ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         
        //     ->groupBy('results.MatricNo')
        //     ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
        //     ->where('results.Level', $level01)
        //     ->where('results.SessionID', $session01)
        //     ->where('results.departmentid', $department)
        //     // ->where('allcombinedcourses.courselevel', $level01)
        //     //     ->where('allcombinedcourses.sessionid', $session01)
        //     //     ->where('allcombinedcourses.departmentid', $department)
        //     // ->paginate(20);
        //     ->get();
        // // ->get();

        $resultaddup = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.courseunit as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.coursecode as subjectcodeco', 'allcombinedcourses.courseunit as subjectunitco', 'allcombinedcourses.coursestatus as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01)
        ->where('results.SessionID', $session01)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01)
        // ->where('allcombinedcourses.sessionid', $session01)
        ->where('allcombinedcourses.departmentid', $department)
        ->orderby('results.matricno')
        ->orderby('allcombinedcourses.coursecode')
        ->get();

        
        
        $results1 = DB::table('allcombinedcourses')
        ->leftjoin('results', 'results.SubjectID', '=', 'allcombinedcourses.courseid')        // ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        // ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.SubjectValue) as sum, sum(subjects.SubjectValue) as sum2')
        ->selectRaw('results.matricno as matricno, sum(allcombinedcourses.courseunit) as sum, sum(allcombinedcourses.courseunit) as sum2')
        ->where('results.Level', $level01)
        ->where('results.SessionID', $session01)
        ->where('results.departmentid', $department)
        ->where('allcombinedcourses.courselevel', $level01)
        // ->where('allcombinedcourses.sessionid', $session01)
        ->where('allcombinedcourses.departmentid', $department)
        ->groupBy('matricno')
        ->get();
// return $results1;

        $compulsorycourses = DB::table('allcombinedcourses')
        ->select('coursecode as subjectcodeco', 'courseunit as subjectunitco', 'coursestatus as subjectvalueco', 'courselevel as subjectlevel')
        ->where('departmentid', $department)
        ->where('CourseLevel', $level01)
        ->where('SessionID', $session01)
        ->orderby('coursecode')
        ->get();

