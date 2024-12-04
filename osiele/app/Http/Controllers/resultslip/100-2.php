<?php
$summary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
// ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.studentid', $studentid)
->where('results.semester', $semester)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
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
    ->where('results.studentid', $studentid)
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
            ->where('results.studentid', $studentid)
            ->where('results.semester', $semester)
            ->groupBy('results.DepartmentID')
            ->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE' )"))
            ->get();   
    }



$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(allcombinedcourses.subjectvalue) as sum, sum(allcombinedcourses.subjectvalue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.studentid', $studentid)
->where('results.semester', $semester)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->groupBy('deptname')
->get();

$prevsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
// ->selectRaw('results.matricno as matricno, sum(results.tnu) as sum, sum(subjects.SubjectValue) as sum2, departments.DepartmentName as deptname')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.studentid', $studentid)
->where('results.semester', $semester-1)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->get();
// return $summary;


$prevdeptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(allcombinedcourses.subjectvalue) as sum, sum(allcombinedcourses.subjectvalue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.studentid', $studentid)
->where('results.semester', $semester-1)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->groupBy('deptname')
->get();




$summaryco = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.studentid', $studentid)
// ->where('results.semester', $semester)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->get();