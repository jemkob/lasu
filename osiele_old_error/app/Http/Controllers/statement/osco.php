<?php 
                                
        $rescollection = collect($summary)->where('subjectvalueco', '!=', 'R');
        
            $resfiltered = $rescollection->where('departmentid', $allsummary->deptid)->sortKeys()->uniqueStrict('subjectcodeco');
            $resfiltered->values()->all();
        // echo $resfiltered;
        //check to see if any exam and ca sum is gt 39, if it is then remove from the list
        $passed = collect($resfiltered);
        $passed1 = $passed->reject(function ($value, $key) { return $value->examca > 39; });

        // $passed1->sortby('subjectcodeco');
        $passed1->all(); 
        
        //outstanding start
        $set1='';
        $set2='';
        $set1 = collect($compulsorycourses); // Contents omitted for brevity
        // $set1 = $set1->reject(function ($value, $key) { return $value->subjectvalueco = 'E'; });
        $set2 = collect($resfiltered); // Contents omitted for brevity
        $diff = array();
        $set1->each(function($item, $key) use($set2, &$diff) {
            $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
            if(!$exists) {
                array_push($diff, $item);
            }
        });
        //outstanding ends
        // echo $passed1;
        // echo $resfiltered.' =====';
        if(count($passed1) > 0 || ((isset($diff)) && !empty($diff))) {
            //sort resfiltered aka carryover
        $resfiltered = collect($passed1)->sortby('subjectcodeco');
        
        echo 'F. ';
            foreach ($resfiltered as $co){

            if($co->examca <= 39){                                
            $theco = $co->subjectcodeco. '('.$co->subjectunitco.''.$co->subjectvalueco.'), '.$co->examca;
            echo $theco.' | ';
            }
            
            }
        } else {
            echo 'PASSED';
        }

        if((isset($diff)) && !empty($diff)) {
        echo '<b>O/S:</b>';
        foreach($diff as $diffs){
        echo $diffs->subjectcodeco. '('.$diffs->subjectunitco.''.$diffs->subjectvalueco.') ';
        }
        }
    ?>