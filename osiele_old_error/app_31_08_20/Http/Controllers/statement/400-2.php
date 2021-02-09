<?php
if($major == $minor){
    $deptsummary = DB::table('results')
    ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
    ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
    // ->where('results.Level', 300)
    ->whereRaw('results.level in ('.$level.', 300, 200, 100)')
    // ->where('results.SessionID', $session)
    ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
    ->where('results.matricno', $matricno)
    // ->where('results.semester', $semester)
    ->groupBy('results.DepartmentID')
    ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', 'EDU', 'GSE', 'TP' )"))
    ->get();
    } else {
            $deptsummary = DB::table('results')
            ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
            ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
            // ->where('results.Level', 300)
            ->whereRaw('results.level in ('.$level.', 300, 200, 100)')
            // ->where('results.SessionID', $session)
            ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
            ->where('results.matricno', $matricno)
            // ->where('results.semester', $semester)
            ->groupBy('results.DepartmentID')
            ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE', 'TP' )"))
            ->get();   
    }




//100 level
$summary1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-300)
->where('results.SessionID', $session-3)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200 level
$summary2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//300level
$summary3 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);
// ->where('results.semester', $semester-1)

// return $summary;

$summary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->unionall($summary3)
->unionall($summary2)
->unionall($summary1)
->get();
// return $summary;

//100 level
$deptresults1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-300)
->where('results.SessionID', $session-3)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//200 level
$deptresults2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//300 level
$deptresults3 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->groupBy('deptname');

$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->groupBy('deptname')
->unionall($deptresults3)
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
    $compulsorycourses300 = DB::table('allcombineds')
    ->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
    ->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.departmentid as deptid')
    ->where('SubjectCombineID', $programme)
    ->where('CurricullumID', 1)
    ->where('subjects.SubjectLevel', $level)
    // ->where('subjects.Semester', $semester01)
    ->where('subjects.subjectunit', 'C')
    ->where('subjects.subjectcode', 'like', $bed.'%');
} else {
$compulsorycourses300 = DB::table('allcombineds')
->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.departmentid as deptid')
->where('SubjectCombineID', $programme)
->where('CurricullumID', 1)
->where('subjects.SubjectLevel', $level)
// ->where('subjects.Semester', $semester01)
->where('subjects.subjectunit', 'C');
}
// return $compulsorycourses;
//200 level
$compulsorycourses = DB::table('allcombineds')
->leftjoin('subjects', 'allcombineds.subjectid', '=', 'subjects.subjectid')
->select('subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'allcombineds.departmentid as deptid')
->where('SubjectCombineID', $programme)
->where('CurricullumID', 1)
->where('subjects.SubjectLevel', $level-100)
// ->where('subjects.Semester', $semester01)
->where('subjects.subjectunit', 'C')
->union($compulsorycourses300)
->get();