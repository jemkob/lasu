<?php
if(isset($bedas) && !empty($bedas)){
        $results = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->leftjoin('students', 'results.matricno', '=', 'students.matricno')         ->groupBy('results.MatricNo')
        ->selectRaw('results.matricno as matricno, students.surname as surname, students.firstname as firstname, students.middlename as middlename')
        ->where('results.Level', $level01)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('students.subcourse', $bedas)
        //->paginate(20)
        ->get();
} else {
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
}

        //get all 100 level result
        $resultaddup100 =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-3)
        ->where('results.SubjectCombinID', $programme);

        //get all 200level results
        $resultaddup200 =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->where('results.SubjectCombinID', $programme);

         //get all 300level results
         $resultaddup300 =DB::table('results')
         ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
         ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
         ->where('results.Level', 300)
         //->where('results.Semester', $semester01)
         ->where('results.SessionID', $session01-1)
         ->where('results.SubjectCombinID', $programme);

        //get all 300 level 1st semester results and add to it 100,200 results.
        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', DB::raw('results.ca + results.exam as examca'), 'results.level as rlevel')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->unionall($resultaddup300)
        ->unionall($resultaddup200)
        ->unionall($resultaddup100)
        ->get();
        

        //gets the first department for display
        
        $getdeptid = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)
        ->wherein('departments.DepartmentCode', ['EDU', 'GSE', $major, $minor])
        ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'EDU', 'GSE', '$major', '$minor')"))
        ->skip(2)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode1 = $getdeptcode1->DepartmentCode;
        $deptid1 = $getdeptcode1->DepartmantID;

        //100level results
        $results1100 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-3)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results1200= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //300 level result
        $results1300= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 300)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        $results1 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('results.DepartmentID', $getid)
        ->groupBy('matricno')
        ->unionall($results1100)
        ->unionall($results1200)
        ->unionall($results1300)
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

        // dump($getid);
        //get department code for result display
        // if($getid != 38){
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode2 = $getdeptcode1->DepartmentCode;
        $deptid2 = $getdeptcode1->DepartmantID;
        // }

        //100level
        $results2100 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-3)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results2200= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //300 level result
        $results2300= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 300)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        $results2 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results2100)
        ->unionall($results2200)
        ->unionall($results2300)
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

        //100level
        $results3100 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-3)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results3200= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results3300= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 300)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        $results3 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results3100)
        ->unionall($results3200)
        ->unionall($results3300)
        ->get();
        //dd($results3);

        $getdeptid = DB::table('results')->select('DepartmentID')->groupBy('DepartmentID')
        ->where('SubjectCombinID', $programme)->skip(1)->take(1)->get();
        $getid = $getdeptid[0]->DepartmentID;

        //get department code for result display
        $getdeptcode1 =  DB::table('departments')->where('DepartmantID', $getid)->first();
        $deptcode4 = $getdeptcode1->DepartmentCode;
        $deptid4 = $getdeptcode1->DepartmantID;

        //100level
        $results4100 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 100)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-3)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results4200= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 200)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-2)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        //200 level result
        $results4300= DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 300)
        //->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid);

        $results4 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', $getid)
        ->unionall($results4100)
        ->unionall($results4200)
        ->unionall($results4300)
        ->get();
        // dd($results4);
        //->take(100)
        
        //Teaching practice
        $results5 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', 300)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01-1)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', 37);

        $results5 = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->groupBy('matricno')
        //subjectvalue must be greater than 40 to get tnup for total unit passed
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->where('departments.DepartmantID', 37)
        ->unionall($results5)
        ->get();


        $sessions = DB::table('sessions')->get();
        $faculties = DB::table('faculties')->get();
        //$programmes = DB::table('subjectcombinations')->get();

        //Getting all courses for the faculty based on subject combination ie major/minor courses
            /* SELECT * FROM `allcombineds` 
            LEFT join subjects on allcombineds.SubjectID = subjects.SubjectID
            WHERE SubjectCombineID = 72 AND CurricullumID = 1 AND subjects.SubjectLevel = 100 and subjects.Semester = 1 */

        /* $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectlevel as subjectlevel', 'subjects.semester as semester')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', 2)
        ->where('subjects.SubjectLevel', 300)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->get();
        // return $compulsorycourses; */

        if(isset($bedas) && !empty($bedas)){
                if($bedas=='beda'){
                        $bed='BES';
                }else{
                        $bed='BEA';
                }
                $compulsorycourses = DB::table('allcombineds')
                ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
                ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectlevel as subjectlevel', 'subjects.semester as semester')
                ->where('SubjectCombineID', $programme)
                ->where('CurricullumID', 1)
                ->where('subjects.SubjectLevel', 300)
                // ->where('subjects.Semester', $semester01)
                ->where('subjects.subjectunit', 'C')
                ->where('subjects.subjectcode', 'not like', $bed.'%')
                ->get();
        } else {
        $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectlevel as subjectlevel', 'subjects.semester as semester')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', 1)
        ->where('subjects.SubjectLevel', 300)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->get();
        }
        // return $compulsorycourses;
        //200 level
        /* $compulsorycourses = DB::table('allcombineds')
        ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
        ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'subjects.subjectlevel as subjectlevel', 'subjects.semester as semester')
        ->where('SubjectCombineID', $programme)
        ->where('CurricullumID', 1)
        ->where('subjects.SubjectLevel', 300)
        // ->where('subjects.Semester', $semester01)
        ->where('subjects.subjectunit', 'C')
        ->where('subjects.subjectcode', 'not like', $bed.'%')
        ->unionall($compulsorycourses300)
        ->get(); */

        $resultaddup2 = DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.matricno as matricno', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco')
        ->where('results.Level', $level01)
        ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
        ->get();
        // return $resultaddup2;
        $resultaddup2 =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level01)
        // ->where('results.Semester', $semester01)
        ->where('results.SessionID', $session01)
        ->where('results.SubjectCombinID', $programme)
       
        ->get();