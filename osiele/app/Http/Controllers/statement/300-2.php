<?php
if($major == $minor){
    $deptsummary = DB::table('results')
    ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
    ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
    ->where('results.Level', $level)
    // ->whereRaw('results.level in ('.$level.', 200, 100)')
    ->where('results.SessionID', $session)
    ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
    ->where('results.matricno', $matricno)
    ->where('results.departmentid', '!=', 38)
    // ->where('results.semester', $semester)
    ->groupBy('results.DepartmentID')
    ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', 'EDU', 'GSE', 'TP' )"))
    ->get();
    } else {
            $deptsummary = DB::table('results')
            ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
            ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
            ->where('results.Level', $level)
            // ->whereRaw('results.level in ('.$level.', 200, 100)')
            ->where('results.SessionID', $session)
            ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
            ->where('results.matricno', $matricno)
            // ->where('results.semester', $semester)
            ->where('results.departmentid', '!=', 38)
            ->groupBy('results.DepartmentID')
            ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE', 'TP' )"))
            ->get();   
    }



//100 level
$summary1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200level
$summary2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);
// ->where('results.semester', $semester-1)

// return $summary;

$summary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->unionall($summary2)
->unionall($summary1)
->get();
// return $summary;

//100 level
$deptresults1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//200 level
$deptresults2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->groupBy('deptname');

$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->groupBy('deptname')
->unionall($deptresults2)
->unionall($deptresults1)
->get();


//Compulsory courses for outstandings

$programme = $resultslip[0]->SubjectCombinID;

if(isset($bedas) && !empty($bedas)){
    if($bedas=='beda'){
            $bed='BEA';
    }else{
            $bed='BES';
    }
    $compulsorycourses300 = DB::table('allcombinedcourses')
    ->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.departmentid as deptid')
    ->where('SubjectCombineID', $programme)
//     ->where('CurricullumID', 1)
    ->where('allcombinedcourses.SubjectLevel', $level)
    ->where('sessionid', $session)
    ->where('allcombinedcourses.subjectunit', 'C')
    ->where('allcombinedcourses.subjectcode', 'like', $bed.'%');
} else {
$compulsorycourses300 = DB::table('allcombinedcourses')
->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.departmentid as deptid')
->where('SubjectCombineID', $programme)
->where('sessionid', $session)
// ->where('CurricullumID', 1)
->where('allcombinedcourses.SubjectLevel', $level)
// ->where('subjects.Semester', $semester01)
->where('allcombinedcourses.subjectunit', 'C');
}
// return $compulsorycourses;
//200 level
$compulsorycourses = DB::table('allcombinedcourses')
->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.departmentid as deptid')
->where('SubjectCombineID', $programme)
// ->where('CurricullumID', 1)
->where('allcombinedcourses.SubjectLevel', $level-100)
->where('sessionid', $session-1)
// ->where('subjects.Semester', $semester01)
->where('allcombinedcourses.subjectunit', 'C')
->union($compulsorycourses300)
->get();