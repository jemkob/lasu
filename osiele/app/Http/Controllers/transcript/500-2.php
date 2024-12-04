<?php
/* $deptsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
->where('results.Level', 300)
// ->where('results.SessionID', $session)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->groupBy('results.DepartmentID')
->orderByRaw(\DB::raw("FIELD(departments.DepartmentCode, '$major', '$minor', 'EDU', 'GSE', 'TP')"))
->get(); */

if($major == $minor){
        $deptsummary = DB::table('results')
        ->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
        ->selectRaw('departments.DepartmentName as dname, departments.DepartmentCode as dcode, departments.DepartmantID as deptid')
        // ->where('results.Level', $level)
        // ->whereRaw('results.level in ('.$level.', 200, 100)')
        // ->where('results.SessionID', $session)
        ->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
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
                ->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
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
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
//->select('results.ca as ca, results.exam as exam, results.tnu as tnu, results.matricno as matricno, results.departmentid as departmentid, subjects.subjectcode as subjectcodeco, subjects.subjectvalue as subjectunitco, subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->get();
// return $summary;


$deptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level)
->where('results.SessionID', $session)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester)
->groupBy('deptname')
->get();

//100 level
$prevsummary1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-400)
->where('results.SessionID', $session-4)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200 level
$prevsummary2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-300)
->where('results.SessionID', $session-3)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200
$prevsummary3 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno);

//200level
$prevsummary = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
->select('results.ca as ca', 'results.exam as exam', 'results.tnu as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'results.tnu as subjectunitco', 'results.subjectvalue as subjectvalueco', 'departments.DepartmentName as deptname', DB::raw('results.ca + results.exam as examca'))
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->unionall($prevsummary1)
->unionall($prevsummary2)
->unionall($prevsummary3)
->get();
// return $summary;

//100 level
$prevdeptresults1 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-400)
->where('results.SessionID', $session-4)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//200 level
$prevdeptresults2 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-300)
->where('results.SessionID', $session-3)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//300 level
$prevdeptresults3 = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-200)
->where('results.SessionID', $session-2)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
->groupBy('deptname');

//200 level
$prevdeptresults = DB::table('results')
->leftjoin('departments', 'results.DepartmentID', '=', 'departments.DepartmantID')
->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
//subjectvalue must be greater than 40 to get tnup for total unit passed
->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2, departments.DepartmentName as deptname')
->where('results.Level', $level-100)
->where('results.SessionID', $session-1)
->where('results.SubjectCombinID', $transcript[0]->SubjectCombinID)
->where('results.matricno', $matricno)
// ->where('results.semester', $semester-1)
->groupBy('deptname')
->unionall($prevdeptresults1)
->unionall($prevdeptresults2)
->unionall($prevdeptresults3)
->get();

//Compulsory courses for outstandings

$programme = $transcript[0]->SubjectCombinID;

// $programme = $resultslip[0]->SubjectCombinID;

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
    ->where('allcombinedcourses.SubjectLevel', 300)
    ->where('sessionid', $session)
    ->where('allcombinedcourses.subjectunit', 'C')
    ->where('allcombinedcourses.subjectcode', 'like', $bed.'%');
} else {
$compulsorycourses300 = DB::table('allcombinedcourses')
->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.departmentid as deptid')
->where('SubjectCombineID', $programme)
->where('sessionid', $session)
// ->where('CurricullumID', 1)
->where('allcombinedcourses.SubjectLevel', 300)
// ->where('subjects.Semester', $semester01)
->where('allcombinedcourses.subjectunit', 'C');
}
// return $compulsorycourses;
//200 level
$compulsorycourses = DB::table('allcombinedcourses')
->select('allcombinedcourses.subjectcode as subjectcodeco', 'allcombinedcourses.subjectvalue as subjectunitco', 'allcombinedcourses.subjectunit as subjectvalueco', 'allcombinedcourses.departmentid as deptid')
->where('SubjectCombineID', $programme)
// ->where('CurricullumID', 1)
->where('allcombinedcourses.SubjectLevel', 200)
->where('sessionid', $session-1)
// ->where('subjects.Semester', $semester01)
->where('allcombinedcourses.subjectunit', 'C')
->union($compulsorycourses300)
->get();