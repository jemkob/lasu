<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Result;
use File;
use Illuminate\Http\Response;
use Auth;
use PDF;

class ResultuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //activity schedule
        $activityschedule = DB::table('activityschedule')
        ->leftjoin('activity', 'activityschedule.activityid', '=', 'activity.activityid')
        ->where('activity.activitycode', 'DLSCS')
        ->first();

        $lecturer = Auth::user()->LecturerID;
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.download')->with('subjects', $subjects)->with('faculties', $faculties)->with('activityschedule', $activityschedule);
    }

    public function scoreindex()
    {
        //activity schedule
        $activityschedule = DB::table('activityschedule')
        ->leftjoin('activity', 'activityschedule.activityid', '=', 'activity.activityid')
        ->where('activity.activitycode', 'UPSC')
        ->first();

        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.score')->with('subjects', $subjects)->with('activityschedule', $activityschedule);
    }
    public function indexdept()
    {
        //activity schedule
        $activityschedule = DB::table('activityschedule')
        ->leftjoin('activity', 'activityschedule.activityid', '=', 'activity.activityid')
        ->where('activity.activitycode', 'DLSCS')
        ->first();

        $lecturer = Auth::user()->LecturerID;
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.downloadbydept')->with('subjects', $subjects)->with('faculties', $faculties)->with('activityschedule', $activityschedule);
    }
    public function downloadpdfindex()
    {
        //
        $lecturer = Auth::user()->LecturerID;
        $faculties = DB::table('faculties')->get();
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.downloadresult')->with('subjects', $subjects)->with('faculties', $faculties);
    }
    public function uploadindex()
    {
        //
        //activity schedule
        $activityschedule = DB::table('activityschedule')
        ->leftjoin('activity', 'activityschedule.activityid', '=', 'activity.activityid')
        ->where('activity.activitycode', 'UPSC')
        ->first();

        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.index')->with('subjects', $subjects)->with('activityschedule', $activityschedule);
    }

    public function studentlistindex()
    {
        //
        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.studentlist')->with('subjects', $subjects);
    }
    public function studentscorelistindex()
    {
        //
        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.studentlist')->with('subjects', $subjects);
    }

    public function studentlist(Request $request)
    {
        //student list
        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
       // return view('lecturer.studentlist')->with('subjects', $subjects);

        $thesubject = $request->input('subject');
        //
        //current session
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        
        
        $studentlist = DB::table('results')
        ->select('matricno', 'ca', 'exam')
        // ->where('ca', 0)
        // ->where('exam', 0)
        ->where('subjectid', $thesubject)
        // ->where('uploaded_by', Auth::user()->UserName)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();

        $scorelist = DB::table('results')
        ->select('matricno', 'ca', 'exam')
        // ->where('ca', 0)
        // ->where('exam', 0)
        ->where('subjectid', $thesubject)
        // ->where('uploaded_by', Auth::user()->UserName)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();
        return view('lecturer.studentlist')->with('studentlist', $studentlist)->with('subjects', $subjects)->with('scorelist', $scorelist);
    }

    public function studentscorelist(Request $request)
    {
        //student list
        $lecturer = Auth::user()->LecturerID;
        $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
       // return view('lecturer.studentlist')->with('subjects', $subjects);

        $thesubject = $request->input('subject');
        //
        //current session
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        
        
        $studentlist = DB::table('results')
        ->select('matricno', 'ca', 'exam')
        // ->where('ca', 0)
        // ->where('exam', 0)
        ->where('subjectid', $thesubject)
        ->where('uploaded_by', Auth::user()->UserName)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();

        $scorelist = DB::table('results')
        ->select('matricno', 'ca', 'exam')
        // ->where('ca', 0)
        // ->where('exam', 0)
        ->where('subjectid', $thesubject)
        // ->where('uploaded_by', Auth::user()->UserName)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();
        return view('lecturer.studentscorelist')->with('studentlist', $studentlist)->with('subjects', $subjects)->with('scorelist', $scorelist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * import a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function import(Request $request)
    {
        
      if($request->file('imported-file'))
      {
       $subjectupload = $request->input('subject');//mustshow
        $path = $request->file('imported-file')->getRealPath();
        $thefile = $request->file('imported-file')->getClientOriginalName();
        $thefileExt = $request->file('imported-file')->getClientOriginalExtension();
        //GET only filename without extension
        $filename = pathinfo($thefile, PATHINFO_FILENAME);
        //file name and time
        $filetostore = $filename.'_'.date("Y-m-d-h-i-sa", time()).'.'.$thefileExt;

        $getcourse = DB::table('subjects')->where('subjectid', $subjectupload)->first();
        // if(strlen($getcourse->SubjectCode) > 7){
        //     $coursefilename = substr($thefile, 0, 10);
        // } else {
        //     $coursefilename = substr($thefile, 0, 7);
        // }
        $coursestrlen = strlen($getcourse->SubjectCode);
        $coursefilename = substr($thefile, 0, $coursestrlen);
        // $getcourse = DB::table('subjects')->where('subjectid', $subjectupload)->first();

        if(trim($coursefilename) !== ($getcourse->SubjectCode)) {

            return redirect('lecturer/resultupload')->with('error', 'Sorry the file selected does not match the course selected. You selected "'.$thefile.'" for '.$getcourse->SubjectCode.'.  Kindly follow this order, if course name is e.g. CHE 112, then the file name must begin with CHE 112.');
        }

        //create temporary table
        // $tblname = str_ireplace(" ","_",$filename);
        // $tblname = $tblname.'_'.date("Y_m_d_h_i_s_a", time());
        $tbl = $this->getTbl();
        DB::statement('DROP TABLE IF EXISTS '.$tbl);
        
        $createTableSqlString =
  "CREATE TABLE $tbl (
    `ResultPreviewID` int(11) NOT NULL,
    `MatricNo` varchar(100) DEFAULT NULL,
    `SubjectID` int(11) DEFAULT NULL,
    `CA` double NOT NULL,
    `EXAM` double NOT NULL,
    `SessionID` int(11) NOT NULL,
    `LecturerID` int(11) NOT NULL,
    `resultid` int(11) DEFAULT NULL,
    `DatePreview` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  DB::statement($createTableSqlString);

                //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
                //$path = $request->file('imported-file')->storeAs('public/osresults', $filetostore);
                // $request->file('imported-file')->copy(base_path() .'public/results/',$thefile);
                // Storage::copy(base_path() .'/public/storage/osresults/'.$filetostore, 'public/results/'.$filetostore);
                $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
                Excel::load($path)->each(function (Collection $csvLine) use($subjectupload, $tbl) {
                    $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
                    $lecturerid = Auth::user()->LecturerID;
                    $csvca = $csvLine->get('ca');//ca
                    $csvexam = $csvLine->get('exam');//exam
                    if($csvca == '' || $csvca == NULL){
                        $csvca = 0;
                    }
                    if($csvexam == '' || $csvexam == NULL){
                        $csvexam = 0;
                    }
                    
                    /* DB::table('results')
                        ->where('results.MatricNo', $csvLine->get('matricno'))
                        ->where('results.SubjectID', $subjectupload)
                        ->where('results.sessionid', $sessions->SessionID)
                        ->where('results.CA', 0)
                        ->orWhere('results.EXAM', 0)
                        //->where('SubjectID', $subjectupload)
                        ->update(['CA' => $csvLine->get('ca'),'EXAM' => $csvLine->get('exam')]); */
                    if($csvLine->get('resultid') !== null){
                        //do something
                        DB::table($tbl)->insert(
                            ['MatricNo'=>$csvLine->get('matricno'),
                            'resultid'=>$csvLine->get('resultid'),
                            'SubjectID'=> $subjectupload,
                            'CA'=>$csvca,
                            'EXAM'=>$csvexam,
                            'SessionID'=>$sessions->SessionID,
                            'LecturerID'=>$lecturerid]);
                    } else {
                    DB::table($tbl)->insert(
                        ['MatricNo'=>$csvLine->get('matricno'),
                        'SubjectID'=> $subjectupload,
                        'CA'=>$csvca,
                        'EXAM'=>$csvexam,
                        'SessionID'=>$sessions->SessionID,
                        'LecturerID'=>$lecturerid]);
                    }
                        
               });
               //result file on
               $path = $request->file('imported-file')->storeAs('public/osresults', $filetostore);

               $prev = DB::table($tbl)
               ->where('subjectid', $subjectupload)
               ->where('sessionid', $sessions->SessionID)
               ->orderby('matricno')
               ->where('lecturerid', Auth::user()->LecturerID)
               ->groupby('matricno') //edited for those that did not click on cancel
               ->get();

        return view('lecturer/preview')->with('prev',$prev);
       }
    }

    public function getTbl(){
        $tblname = str_ireplace(" ","_", Auth::user()->UserName);
        $tblname = str_ireplace("-","_", $tblname);
        $tblname = str_ireplace(".","", $tblname);
        $tblname = $tblname.'_'.date("Y_m_d", time());
        return $tblname;
        }

    public function getSession(){
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        return $sessions->SessionID;
    }
    public function previewdownload(Request $request){
        $subject = $request->input('subject');
        //$session = $request->input('session');
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $subjectcode = DB::table('subjects')->where('SubjectID', $subject)->first();
        $subjectcodename = $subjectcode->SubjectCode;
        $thesession = $sessions->SessionYear;
        //$subject = $request->input('subject');
                $prevdownload = DB::table('results')
               ->where('subjectid', $subject)
               ->where('sessionid', $sessions->SessionID)
               ->where('uploaded_by', Auth::user()->UserName)
               ->orderby('matricno')
               //->where('lecturerid', Auth::user()->LecturerID)
               ->get();

               //return $prevdownload;

               //return view('lecturer/previewdownload')->with('prevdownload', $prevdownload)->with('subjectcodename', $subjectcodename)->with('thesession', $thesession);
         $pdf = PDF::loadView('lecturer/previewdownload', compact('prevdownload', 'subjectcodename', 'thesession'));
        return $pdf->download( $subjectcodename.'uploaded_result.pdf');
    }
    public function previewd(Request $request)
    {
                $session = $request->input('session');
                $subject = $request->input('subject');
                $tbl = $this->getTbl();

        
               $prev = DB::table($tbl)
               ->where('subjectid', $subject)
               ->where('sessionid', $session)
               ->where('lecturerid', Auth::user()->LecturerID)
               ->delete();
               
               return redirect('lecturer/resultupload')->with('danger', 'Upload Cancelled');
       // return view('lecturer/preview')->with('prev',$prev);
    }
    public function previewcontinue(Request $request)
    {
                $session = $request->input('session');
                $subject = $request->input('subject');
                $asubject = $request->input('subject');
                $tbl = $this->getTbl();
                
                $prev = DB::table($tbl)
               ->where('subjectid', $subject)
               ->where('sessionid', $session)
               ->where('lecturerid', Auth::user()->LecturerID)
               ->get();

               if($prev[0]->resultid !== null){
                foreach($prev as $previous){
                    DB::table('results')
                    ->where('results.resultid', $previous->resultid)
                    ->where('results.CA', 0)
                    ->Where('results.EXAM', 0)
                    ->update(['CA' => $previous->CA,'EXAM' => $previous->EXAM, 'LecturerInserted' => 'TRUE', 'uploaded_by' => Auth::user()->UserName]);
                    }
               } else {
            foreach($prev as $previous){
                DB::table('results')
                ->where('results.MatricNo', $previous->MatricNo)
                ->where('results.SubjectID', $previous->SubjectID)
                ->where('results.sessionid', $previous->SessionID)
                ->where('results.CA', 0)
                ->Where('results.EXAM', 0)
                ->update(['CA' => $previous->CA,'EXAM' => $previous->EXAM, 'LecturerInserted' => 'TRUE', 'uploaded_by' => Auth::user()->UserName]);

                    
                }
            }

            $deleteresult = DB::table($tbl)
               ->where('subjectid', $subject)
               ->where('sessionid', $session)
               ->where('lecturerid', Auth::user()->LecturerID)
               ->delete();

               //DB::statement($createTableSqlString);
               DB::statement('drop table '.$tbl);

                           

               /* if($previous->CA+$previous->EXAM < 40){
                DB::table('carryovers')->insert(
                    ['MatricNo'=>$csvLine->get('matricno'),
                    'SubjectID'=> $subjectupload,
                    'CA'=>$csvLine->get('ca'),
                    'EXAM'=>$csvLine->get('exam'),
                    'SessionID'=>$sessions->SessionID,
                    'LecturerID'=>$lecturerid]);
                } */

               $lecturer = Auth::user()->LecturerID;
            $subjects = DB::table('lecturerprofiles')
            ->join('subjects', 'lecturerprofiles.SubjectID', '=', 'subjects.SubjectID')
            ->select('subjects.SubjectID as subjectid', 'subjects.SubjectCode as subjectcode')
            ->where('lecturerprofiles.LecturerID', $lecturer)
            ->get();
        return view('lecturer.index')->with('subjects', $subjects)->with('asubject', $asubject)->with('success', 'Result Uploaded Successfully! '.$asubject);
               
               //return redirect('lecturer/resultupload')->with('asubject', $asubject)->with('success', 'Result Uploaded Successfully! '.$asubject);
       // return view('lecturer/preview')->with('prev',$prev);
    }


    public function export(Request $request){
        //$items = Item::all();
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $thesubject = $request->input('subject');
        $thefaculty = $request->input('faculty');
        $getCourseCode= DB::table('subjects')->where('subjectid', $thesubject)->first();
        $CourseCode = $getCourseCode->SubjectCode;
        
        $results = DB::table('results')
        ->leftjoin('departments', 'results.departmentid', '=', 'departments.DepartmantID')
        // ->select('matricno', 'ca', 'exam', 'resultid')
        ->select('matricno', 'ca', 'exam', 'resultid')
        //->where('matricno', '!=', null)
        ->where('subjectid', $thesubject)
        ->where('EXAM', 0)
        ->where('CA', 0)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();
        // return $results;
        $results= json_decode( json_encode($results), true);
        // return $results;
        $download = Excel::create($CourseCode, function($excel) use($results) {
            $excel->sheet('ExportFile', function($sheet) use($results) {
                $sheet->fromArray($results, null, 'A1', true);
                $sheet->getColumnDimension('D')->setVisible(false);
                // $sheet->protectCells('D1', '1234567');
                // $sheet = $reader->getExcel()->getActiveSheet();
                $sheet->getProtection()->setPassword('jamesbond');
                $sheet->getProtection()->setSheet(true);
                $count=count($results);
                $count = $count+1;
                $sheet->getStyle('B2:C'.$count)->getProtection()->setLocked(\PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
            });
        })->export('xls');

        return view('lecturer.download')->with('download', $download);
  
      }

      public function exportDept(Request $request){
        //$items = Item::all();
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $thesubject = $request->input('subject');
        $thefaculty = $request->input('faculty');
        $getCourseCode= DB::table('subjects')->where('subjectid', $thesubject)->first();
        $faculty = DB::table('faculties')->where('facultyid', $thefaculty)->first();
        $CourseCode = $getCourseCode->SubjectCode.'-'.$faculty->FacultyName;

        $studentcomb = DB::table('students')->select('Major', 'Minor')->where('FacultyName', $faculty->FacultyName)->where('major', '!=',null)->where('minor', '!=',null)->where('major', '!=', '')->where('minor', '!=', '')->groupby('Major', 'Minor')->get();

        $CourseDept = DB::table('departments')->select('departmantid')->where('Facultyid', $thefaculty)->get();

        $ideptcode = "";
        foreach($studentcomb as $cdept){
            $ideptcode .= "'".$cdept->Major.'/'.$cdept->Minor."'".', ';
        }

        $thedept = rtrim($ideptcode, ', ');


        $subjectcombine = DB::table('subjectcombinations')->select('subjectcombinid')
        ->whereRaw('subjectcombinname in ('.$thedept.')')
        ->get();

        $isubcomb = "";
        foreach($subjectcombine as $subcom){
            $isubcomb .= $subcom->subjectcombinid.', ';
        }

        $thesubcomb = rtrim($isubcomb, ', ');

        // return $thesubcomb;
        $results = DB::table('results')
        // ->select('matricno', 'ca', 'exam', 'resultid')
        ->select('matricno', 'ca', 'exam', 'resultid')
        //->where('matricno', '!=', null)
        ->where('subjectid', $thesubject)
        ->where('sessionid', $sessions->SessionID)
        ->whereRaw('subjectcombinid in ('.$thesubcomb.')')
        ->where('EXAM', 0)
        ->where('CA', 0)
        ->orderby('matricno')
        ->get();

        // return $results;
       
        if(count($results) > 0){
        $results= json_decode( json_encode($results), true);
        // return $results;
        
        $download = Excel::create($CourseCode, function($excel) use($results) {
            $excel->sheet('ExportFile', function($sheet) use($results) {
                $sheet->fromArray($results, null, 'A1', true);
                $sheet->getColumnDimension('D')->setVisible(false);
                // $sheet->protectCells('D1', '1234567');
                // $sheet->loadView('template');
                $sheet->getProtection()->setPassword('jamesbond');
                $sheet->getProtection()->setSheet(true);
                $count=count($results);
                $count = $count+1;
                $sheet->getStyle('B2:C'.$count)->getProtection()->setLocked(\PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

            });
        })->export('xls');

        return view('lecturer.download')->with('download', $download);
    } else {
        return redirect('lecturer/downloademsdept')->with('error', 'No student in this school offering '.$getCourseCode->SubjectCode);
    }
  
      }

    
    //download pdf for school/subject
    public function downloadPDF(Request $request){
        //$items = Item::all();
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $thesubject = $request->input('subject');
        $thefaculty = $request->input('faculty');
        $getCourseCode= DB::table('subjects')->where('subjectid', $thesubject)->first();

        $subject = $request->input('subject');
        //$session = $request->input('session');
        // $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $subjectcode = DB::table('subjects')->where('SubjectID', $thesubject)->first();
        $subjectcodename = $subjectcode->SubjectCode;
        $thesession = $sessions->SessionYear;
        //$subject = $request->input('subject');

        if($thefaculty != 0){
        $faculty = DB::table('faculties')->where('facultyid', $thefaculty)->first();
        $CourseCode = $getCourseCode->SubjectCode.'-'.$faculty->FacultyName;

        $studentcomb = DB::table('students')->select('Major', 'Minor')->where('FacultyName', $faculty->FacultyName)->where('major', '!=',null)->where('minor', '!=',null)->where('major', '!=', '')->where('minor', '!=', '')->groupby('Major', 'Minor')->get();

        $CourseDept = DB::table('departments')->select('departmantid')->where('Facultyid', $thefaculty)->get();

        $ideptcode = "";
        foreach($studentcomb as $cdept){
            $ideptcode .= "'".$cdept->Major.'/'.$cdept->Minor."'".', ';
        }

        $thedept = rtrim($ideptcode, ', ');


        $subjectcombine = DB::table('subjectcombinations')->select('subjectcombinid')
        ->whereRaw('subjectcombinname in ('.$thedept.')')
        ->get();

        $isubcomb = "";
        foreach($subjectcombine as $subcom){
            $isubcomb .= $subcom->subjectcombinid.', ';
        }

        $thesubcomb = rtrim($isubcomb, ', '); 

            

        $prevdownload = DB::table('results')
        ->select('MatricNo', 'CA', 'EXAM', 'created_at')
        ->where('subjectid', $thesubject)
        ->where('sessionid', $sessions->SessionID)
        ->whereRaw('subjectcombinid in ('.$thesubcomb.')')
        ->orderby('matricno')
        ->get();
    } else {
        $prevdownload = DB::table('results')
        ->select('MatricNo', 'CA', 'EXAM', 'created_at')
        ->where('subjectid', $thesubject)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        //->where('lecturerid', Auth::user()->LecturerID)
        ->get();
    }
// return $prevdownload;
    // return view('lecturer/previewdownload')->with('prevdownload', $prevdownload)->with('subjectcodename', $subjectcodename)->with('thesession', $thesession);
             $pdf = PDF::loadView('lecturer/previewdownload', compact('prevdownload', 'subjectcodename', 'thesession'));
            return $pdf->download( $subjectcodename.'uploaded_result.pdf');

     /*   return view('lecturer.download')->with('download', $download);
     } else {
        return redirect('lecturer/downloademsdept')->with('error', 'No student in this school offering '.$getCourseCode->SubjectCode);
    } */
  
      }

    public function resetPasswordIndex()
    {
        return view('lecturer.resetpassword');
    }

    public function resetPassword(Request $request)
    {
        $password = Auth::user()->Password;
        $lecturerid = Auth::user()->LecturerID;
        $newpassword = $request->input('newpassword') ;
        $newpassword2 = $request->input('newpassword2');
        $oldpassword = $request->input('oldpassword');
        if($oldpassword == $password){
            if($newpassword==$newpassword2){
            DB::table('lecturers')
            ->where('lecturerid', $lecturerid)
            ->update(['Password' => $newpassword]);
            return redirect('lecturer/resetpassword')->with('success', 'Password has been changed successfully!');
            } else{
                return redirect('lecturer/resetpassword')->with('error', 'Your new passwords do not match.');
            }
        } else{
            return redirect('lecturer/resetpassword')->with('error', 'Your old password is incorrect.');
        }

        return view('lecturer.resetpassword');
    }

    public function scorestudent(Request $request){

        //$items = Item::all();
        $sessions = DB::table('sessions')->where('CurrentSession', true)->first();
        $thesubject = $request->input('subject');
        $getCourseCode= DB::table('subjects')->where('subjectid', $thesubject)->first();
        $CourseCode = $getCourseCode->SubjectCode;
        
        $results = DB::table('results')
        ->select('matricno', 'ca', 'exam')
        //->where('matricno', '!=', null)
        ->where('subjectid', $thesubject)
        ->where('EXAM', 0)
        ->where('CA', 0)
        ->where('sessionid', $sessions->SessionID)
        ->orderby('matricno')
        ->get();
        // return $results;
        
        return view('lecturer.scorestudent')->with('results', $results)->with('thesubject', $thesubject)->with('sessions', $sessions);
  
      }

      public function insertscore(Request $request){
          $matric = $request->input('matricno');
          $ca = $request->input('ca');
          $exam = $request->input('exam');
          $subject = $request->input('subject');
          $session = $request->input('session');
          
          for($i=0; $i < count($exam); $i++){
             // echo $matric[$i].' '.$ca[$i].' '.$exam[$i].'<br>';
            $imatric = $matric[$i];
            $ica = $ca[$i];
            $iexam = $exam[$i];         
          
            DB::table('results')
            ->where('results.MatricNo', $imatric)
            ->where('results.SubjectID', $subject)
            ->where('results.sessionid', $session)
            //->where('results.CA', 0)
            //->orWhere('results.EXAM', 0)
            ->update(['CA' => $ica,'EXAM' => $iexam, 'LecturerInserted' => 'TRUE']);
        }
        return redirect('lecturer/score')->with('success', 'Score inserted');
      }

      //Edit profile page
      public function editprofileIndex()
    {
        // $lecturer = DB::table('lecturers')->where('lecturerid', Auth::user()->LecturerID)->first();
        return view('lecturer.editprofile');
    }

    public function editprofile(Request $request){

        $this->validate($request, [
            'email' => 'required|email|max:255',
            
            'phone' => 'required|max:255',
        ]);
        $surname = $request->input('surname');
        $firstname = $request->input('firstname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $username = $request->input('username');
        $lecturerid = Auth::user()->LecturerID;
        
          DB::table('lecturers')
          ->where('lecturerid', $lecturerid)
          ->update(['PhoneNumber' => $phone, 'Email' => $email]);
      
      return redirect('lecturer/editprofile')->with('success', 'Profile Updated');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
