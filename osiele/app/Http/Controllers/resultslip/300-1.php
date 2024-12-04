<?php
if($major == $minor){
        $deptsummary = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
        // ->where('results.Level', $level)
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
                // ->where('results.Level', $level)
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
        ->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
        ->where('results.Level', $level)
        ->where('results.SessionID', $session)
        ->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
        ->where('results.studentid', $studentid)
        ->where('results.semester', $semester)
        ->where('allcombinedcourses.sessionid', $session)
        ->where('allcombinedcourses.subjectlevel', $level)
        ->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
        ->get();
// return $summary;


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

//100 level
$prevsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('allcombinedcourses.sessionid', $session-2)
->where('allcombinedcourses.subjectlevel', $level-200)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID);

//200level
$prevsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('allcombinedcourses.sessionid', $session-1)
->where('allcombinedcourses.subjectlevel', $level-100)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
// ->where('results.semester', $semester-1)
->unionall($prevsummary)
->get();
// return $summary;

//100 level
$prevdeptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(allcombinedcourses.subjectvalue) as sum, sum(allcombinedcourses.subjectvalue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('allcombinedcourses.sessionid', $session-2)
->where('allcombinedcourses.subjectlevel', $level-200)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->groupBy('deptname');

//200 leve
$prevdeptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(allcombinedcourses.subjectvalue) as sum, sum(allcombinedcourses.subjectvalue) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('allcombinedcourses.sessionid', $session-1)
->where('allcombinedcourses.subjectlevel', $level-100)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
// ->where('results.semester', $semester-1)
->groupBy('deptname')
->unionall($prevdeptresults)
->get();

$summaryco = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('allcombinedcourses.sessionid', $session-1)
->where('allcombinedcourses.subjectlevel', $level-100)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
;

$summaryco = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('allcombinedcourses', 'results.SubjectID', '=', 'allcombinedcourses.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'allcombinedcourses.subjectvalue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectunit as subjectunitco', 'allcombinedcourses.subjectname as subjectnameco', 'allcombinedcourses.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $resultslip[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->where('results.semester', $semester)
->where('allcombinedcourses.sessionid', $session)
->where('allcombinedcourses.subjectlevel', $level)
->where('allcombinedcourses.SubjectCombineID', $resultslip[0]->SubjectCombinID)
->unionall($summaryco)
->get();


// return $summary;