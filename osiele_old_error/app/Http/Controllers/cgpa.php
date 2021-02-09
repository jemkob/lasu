<?php 
                            
        $results3 = DB::table('results')
        ->groupBy('matricno')
        ->selectRaw('results.matricno as matricno, sum(tnu) as sum, sum(results.tnu) as sum2')
        ->get();

        $resultaddup =DB::table('results')
        ->leftjoin('subjects', 'results.SubjectID', '=', 'subjects.SubjectID')
        ->select('results.ca as ca', 'results.exam as exam', 'subjects.SubjectValue as tnu', 'results.matricno as matricno', 'results.departmentid as departmentid', 'subjects.subjectcode as subjectcodeco', 'subjects.subjectvalue as subjectunitco', 'subjects.subjectunit as subjectvalueco', DB::raw('results.ca + results.exam as examca'))
        ->get();

            //third department
            $themat = $request->input('matricno');
            $collection = collect($results3);
            $filtered = $collection->where('matricno', $themat);
            $filtered->all();

            $rescollection = collect($resultaddup);
            $resfiltered = $rescollection->where('matricno', $themat)->sortbydesc('subjectcodeco')->unique();
            $resfiltered->all();
            $allcalc= 0;
            $alltnups3=0;
            $tnup3=0;
            
            foreach($resfiltered as $resfilt){
                $calculate=$resfilt->ca+$resfilt->exam;
                $gettnup = $resfilt->tnu;
            
            if ($calculate >= 70)  {$calculates = 5*$resfilt->tnu;}
            elseif ($calculate >= 60 && $calculate <= 69)  {$calculates = 4*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 50 && $calculate <= 59)  {$calculates = 3*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 45 && $calculate <= 49)  {$calculates = 2*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate >= 40 && $calculate <= 44)  {$calculates = 1*$resfilt->tnu; $gettnup = $resfilt->tnu;}
            elseif ($calculate <= 39)  {$calculates = 0*$resfilt->tnu; $gettnup = 0;}
            //endif
            $allcalc +=$calculates;

            $alltnups3 +=$gettnup; 
            
            $tcp3 = $allcalc;
            $tnu3 = $results3->first()->sum2;
            $tnup3 = $results3->first()->sum;
            }
            $cgpa3 = 0;
            $tnuaddup3 = collect($results3)->where('matricno', $themat)->sum('sum2');
            if($allcalc > 0 && $alltnups3 > 0){
            $cgpa3 = number_format($allcalc/$tnuaddup3, 2);
            } else {
            $cgpa3 = 0.00;
            }
            
            ?>
            
            {{$allcalc}}
            {{$tnuaddup3}} {{$alltnups3}} {{number_format($cgpa3, 2) }}
            
            