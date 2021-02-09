<?php
$summary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
// ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'subjects.subjectname as subjectnameco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
// ->groupBy('results.DepartmentID')
//->orderbyraw('subjectcombinations.subjectcombinName = '.$subcom->SubjectCombinName)
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE' )"))
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'MAT' )"))
->get();
// return $summary;
if($major == $minor){
$deptsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
->groupBy('results.DepartmentID')
->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', 'EDU', 'GSE' )"))
->get();
} else {//
        $deptsummary = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
        ->where('results.Level', $level)
        ->where('results.SessionID', $session)
        ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
        ->where('results.matricno', $matricno)
        ->where('results.semester', $semester)
        ->groupBy('results.DepartmentID')
        ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE' )"))
        ->get();   
}

$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
->groupBy('deptname')
->get();

$summaryco = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'subjects.subjectname as subjectnameco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)

// ->groupBy('results.DepartmentID')
//->orderbyraw('subjectcombinations.subjectcombinName = '.$subcom->SubjectCombinName)
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE' )"))
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'MAT' )"))
->get();