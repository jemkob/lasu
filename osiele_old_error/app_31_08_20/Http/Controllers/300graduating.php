<?php



$results = DB::table('results')
       
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         
        ->groupBy('results.MatricNo')
        ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename, students.major as major, students.minor as minor, students.gender as gender, students.sor as state, students.facultyname as school, results.subjectcombinid as programid, students.subcourse as bedas')
        ->where('results.level', 300)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('students.facultyname', $facultyname->facultyname)
        // ->where('results.SubjectCombinID', $programme)
        // ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')')
        // ->paginate(3);
        ->get();


        //get all 100 level result
        $resultaddup100 =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')');

        //get all 200level results
        $resultaddup200 =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')');

        //get all 300 level 1st semester results and add to it 100,200 results.
        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')')
        ->unionall($resultaddup200)
        ->unionall($resultaddup100)
        ->get();
        

        //gets the first department for display
        
      

        

        //100level results
        $results1100 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('results.departmentid')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, results.departmentid as thedept')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->whereRaw('results.ca + results.exam > 39')
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')');
        // ->where('departments.DepartmantID', $getid);

        //200 level result
        $results1200= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('results.departmentid')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, results.departmentid as thedept')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->whereRaw('results.ca + results.exam > 39')
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')');
        // ->where('departments.DepartmantID', $getid);

        $results1 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, results.departmentid as thedept')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')')
        ->whereRaw('results.ca + results.exam > 39')
        // ->where('results.DepartmentID', $getid)
        ->groupBy('results.departmentid')
        ->groupBy('matricno')
        ->unionall($results1100)
        ->unionall($results1200)
        ->get();
// return $results1;

        



        
        
        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */

        if(isset($bedas) && !empty($bedas)){
                if($bedas=='beda'){
                        $bed='BEA';
                }else{
                        $bed='BES';
                }
                $compulsorycourses300 = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.subjectcombineid as programid')
                ->whereRaw('subjectcombineid in ('.$thesubcomb.')')
                ->where('CurricullumID', 1)
                ->where('subjects.SubjectLevel', $level01)
                // ->where('subjects.Semester', $semester01)
                ->where('subjects.subjectunit', 'C')
                ->where('subjects.subjectcode', 'like', $bed.'%');
        } else {
        $compulsorycourses300 = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.subjectcombineid as programid')
        ->whereRaw('subjectcombineid in ('.$thesubcomb.')')
        ->where('CurricullumID', 1)
        ->where('subjects.SubjectLevel', $level01)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C');
        }
        // return $compulsorycourses;
        //200 level
        $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.subjectcombineid as programid')
        ->whereRaw('subjectcombineid in ('.$thesubcomb.')')
        ->where('CurricullumID', 1)
        ->where('subjects.SubjectLevel', $level01-100)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->union($compulsorycourses300)
        ->get();

        /*//100, 200, 300 level
         $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', 1)
        ->where('subjects.SubjectLevel', $level01-200)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->unionall($compulsorycourses200)
        ->unionall($compulsorycourses300)
        ->get();
 */
        $resultaddup2 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->whereRaw('results.subjectcombinid in ('.$thesubcomb.')')
        ->get();
        // return $resultaddup2;