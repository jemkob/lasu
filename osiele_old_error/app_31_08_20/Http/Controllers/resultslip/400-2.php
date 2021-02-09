<?php
if($major == $minor){
    $deptsummary = DB::table('results')
    ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
    ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
    ->where('results.Level', 300)
    // ->whereRaw('results.level in ('.$level.', 200, 100)')
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
            ->where('results.Level', 300)
            // ->whereRaw('results.level in ('.$level.', 200, 100)')
            // ->where('results.SessionID', $session)
            ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
            ->where('results.matricno', $matricno)
            // ->where('results.semester', $semester)
            ->groupBy('results.DepartmentID')
            ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE', 'TP' )"))
            ->get();   
    }

$summary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
// ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectname as subjectnameco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
->get();
// return $summary;


$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
->groupBy('deptname')
->get();

//400 level first semester
$prevsummary400 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.Semester', $semester - 1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//100 level
$prevsummary100 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-300)
->where('results.SessionID', $session-3)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200 level
$prevsummary200 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//300level AND ALL
$prevsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->unionall($prevsummary100)
->unionall($prevsummary400)
->unionall($prevsummary200)
->get();
// return $summary;

//100 level
$prevdeptresults1 = DB::table('results')
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
$prevdeptresults2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->groupBy('deptname');

//300 level
$prevdeptresults3 = DB::table('results')
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

$prevdeptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', 1)
->groupBy('deptname')
->unionall($prevdeptresults1)
->unionall($prevdeptresults2)
->unionall($prevdeptresults3)
->get();

$summaryco = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
// ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectname as subjectnameco', 'subjects.subjectunit as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)

// ->groupBy('results.DepartmentID')
//->orderbyraw('subjectcombinations.subjectcombinName = '.$subcom->SubjectCombinName)
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE' )"))
//->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, 'MAT' )"))
->get();