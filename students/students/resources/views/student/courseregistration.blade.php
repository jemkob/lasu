
    @extends('adminlte::page')

    @section('content')
<script type="text/javascript">
	$(document).ready(function(){	
		
		$('#checkCourse :checkbox').change(function () {
			var checkedCheckBoxes = $(this).parent().find(':checkbox:checked');
			if (checkedCheckBoxes.length > 5) {
				this.checked = false;
				$("#error").html("Only 5 can be checked. Please uncheck some if you want to check others... :)");
			}
			else {
				$("#error").empty();
			}
		});
		
	});
	</script>

    <div class="box" id="checkCourse">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Course Registration</h4>
                </div>
            </div>
            
            <!-- /.row -->
            <!-- .row -->
            <div class="box-body">
            @if(isset($student) && Auth::user()->Registered === 'TRUE')
            <div class="alert alert-warning">You have registered for this session, click on the exam docket link to see registered courses or visit Administrative office for modifications or corrections.</div>
            @else
            
                <div class="row">
                    <form action="{{url('student/registercourse')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                    <p>
                         <h3><u>Outstandings</u></h3>
                    </p>
                    <?php

                    $rescollection = collect($compulsorycourses)->where('subjectvalueco', '!=', 'R');
                    $resfiltered = $rescollection->sortKeysDesc()->unique('subjectcodeco');
                    $resfiltered->all();
                                //   dump($resfiltered)
                    //outstanding start
                    $set1='';
                    $set2='';
                    $set1 = collect($compulsorycourses); 
                    $set2 = collect($registeredcourses); // Contents omitted for brevity
                    $diff = array();
                    $set1->each(function($item, $key) use($set2, &$diff) {
                        $exists = $set2->where('subjectcodeco', $item->subjectcodeco)->first(); // Where clause omitted for brevity
                        if(!$exists) {
                            array_push($diff, $item);
                        }
                    });
                    //outstanding ends
        ?>
        <?php if($_SERVER['REMOTE_ADDR'] == '41.223.65.6'){
            //dd($diff);
        } ?>
                    
                @if(count($registeredcourses) > 0)
                <div class="table-responsive">
                    <table class="table table-striped" width="100%">
                    @foreach($diff as $os)
                        <tr>
                            <td scope="col" width="5px">
                                <input type="checkbox" name="coursed[]" id="{{$os->subjectcodeco}}" value="{{$os->subjectid}}" checked disabled>
                                <input type="hidden" name="course[]" value="{{$os->subjectid}}">
                                {{-- <input type="hidden" name="course[]" value="{{$os->SubjectID}}"> --}}

                            </td>
                            <td>
                                <label for="{{$os->subjectcodeco}}">{{$os->subjectcodeco}}</label>
                            </td>
                            <td>
                                {{$os->CourseCode}}
                            </td>
                            <td>
                                {{$os->CourseUnit}}
                            </td>
                            <td>
                                {{$os->CourseStatus}}
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                @endif
                    

                    <p>
                        <h3><u>Carryovers</u></h3>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped" width="100%">
                            
                            <?php $carryover = collect($carryover);
                            $carryover->all(); ?>
                        @foreach($carryover as $co)
                            <tr>
                                <td scope="col" width="5px">
                                    <input type="checkbox" name="course[]" id="{{$co->CourseCode}}" value="{{$co->SubjectID}}" checked disabled>
                                    <input type="hidden" name="course[]" value="{{$co->CourseID}}">
                                </td>
                                <td>
                                    <label for="{{$co->CourseCode}}">{{$co->CourseCode}}</label>
                                </td>
                                <td>
                                    {{$co->CourseTitle}}
                                </td>
                                <td>
                                    {{$co->CourseUnit}}
                                </td>
                                <td>
                                    {{$co->CourseStatus}}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                    <hr />
                    <p>
                        <h3>Module Courses</h3>
                    </p>
                    <?php
                    $firstsemester = collect($CurrentCourses);
                    
                    $firstsemester->all();
                    ?>
                    <div class="table-responsive">
                            <table class="table table-striped" width="100%">
                            @foreach($CurrentCourses as $first)
                                <tr>
                                    <td scope="col" width="5px">
                                        <input type="checkbox" name="course[]" id="{{$first->CourseCode}}" value="{{$first->CourseID}}">
                                    </td>
                                    <td>
                                        <label for="{{$first->CourseCode}}">{{$first->CourseCode}}</label>
                                    </td>
                                    <td>
                                        {{$first->CourseTitle}}
                                    </td>
                                    <td>
                                        {{$first->CourseUnit}}
                                    </td>
                                    <td>
                                        {{$first->CourseStatus}}
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>

                    <hr />
                    
                    
                        <a name="C4"></a>
                        <a href='#C4' onclick="CheckAll()" class="btn btn-danger">Check All</a>

                        <div id="error"></div>

                    <div align='center'>
                        <button type="submit" id="myBtn" class="btn btn-success" onclick="disableBtn()">Register Selected Course(s)</button>
                    </div>
                    </form>
                </div>{{-- /row --}}
                @endif
            </div>{{-- /box-body --}}
        </div>
    </div>
<script>
function CheckAll() {
    var x = document.getElementsByName("course[]");
    var i;
    for (i = 0; i < x.length; i++) {
        if (x[i].type == "checkbox") {
            x[i].checked = true;
        }
    }
}
function disableBtn() {
//   document.getElementById("myBtn").disabled = true;
  var x = document.getElementById("myBtn");
  if(x.style.display ==="none"){
      x.style.display = "block";
  } else {
      x.style.display = "none";
  }
}
</script>


@endsection