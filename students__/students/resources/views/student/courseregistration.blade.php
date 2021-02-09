
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
            @if(isset($student) && $student->Registered === 'True')
            <div class="alert alert-warning">You have registered for this session, visit STEP B for modifications or corrections.</div>
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
                         <h3>Outstandings</h3>
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
                    
                @if(count($registeredcourses) > 0)
                <div class="table-responsive">
                    <table class="table table-striped" width="100%">
                    @foreach($diff as $os)
                        <tr>
                            <td scope="col" width="5px">
                                <input type="checkbox" name="coursed[]" id="{{$os->subjectcodeco}}" value="{{$os->SubjectID}}" checked disabled>
                                <input type="hidden" name="course[]" value="{{$os->SubjectID}}">
                                {{-- <input type="hidden" name="course[]" value="{{$os->SubjectID}}"> --}}

                            </td>
                            <td>
                                <label for="{{$os->subjectcodeco}}">{{$os->subjectcodeco}}</label>
                            </td>
                            <td>
                                {{$os->SubjectName}}
                            </td>
                            <td>
                                {{$os->SubjectValue}}
                            </td>
                            <td>
                                {{$os->SubjectUnit}}
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                @endif
                    

                    <p>
                        <h3>CARRYOVERS</h3>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped" width="100%">
                            
                            <?php $carryover = collect($carryover)->where('SubjectUnit','!=', 'R');
                            $carryover->all(); ?>
                        @foreach($carryover as $co)
                            <tr>
                                <td scope="col" width="5px">
                                    <input type="checkbox" name="course[]" id="{{$co->SubjectCode}}" value="{{$co->SubjectID}}" checked disabled>
                                    <input type="hidden" name="course[]" value="{{$co->SubjectID}}">
                                </td>
                                <td>
                                    <label for="{{$co->SubjectCode}}">{{$co->SubjectCode}}</label>
                                </td>
                                <td>
                                    {{$co->SubjectName}}
                                </td>
                                <td>
                                    {{$co->SubjectValue}}
                                </td>
                                <td>
                                    {{$co->SubjectUnit}}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                    <hr />
                    <p>
                        <h3>1st Semester</h3>
                    </p>
                    <?php
                    $firstsemester = collect($CurrentCourses)->where('Semester', 1);
                    
                    $firstsemester->all();
                    ?>
                    <div class="table-responsive">
                            <table class="table table-striped" width="100%">
                            @foreach($firstsemester as $first)
                                <tr>
                                    <td scope="col" width="5px">
                                        <input type="checkbox" name="course[]" id="{{$first->SubjectCode}}" value="{{$first->SubjectID}}">
                                    </td>
                                    <td>
                                        <label for="{{$first->SubjectCode}}">{{$first->SubjectCode}}</label>
                                    </td>
                                    <td>
                                        {{$first->SubjectName}}
                                    </td>
                                    <td>
                                        {{$first->SubjectValue}}
                                    </td>
                                    <td>
                                        {{$first->SubjectUnit}}
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>

                    <hr />
                    <p>
                        <h3>2nd Semester</h3>
                    </p>
                    <?php
                    $secondsemester = collect($CurrentCourses)->where('Semester', 2);
                    
                    $secondsemester->all();
                    ?>
                    <div class="table-responsive">
                            <table class="table table-striped" width="100%">
                            @foreach($secondsemester as $second)
                                <tr>
                                    <td scope="col" width="5px">
                                        <input type="checkbox" name="course[]" id="{{$second->SubjectCode}}" value="{{$second->SubjectID}}">
                                    </td>
                                    <td>
                                        <label for="{{$second->SubjectCode}}">{{$second->SubjectCode}}</label>
                                    </td>
                                    <td>
                                        {{$second->SubjectName}}
                                    </td>
                                    <td>
                                        {{$second->SubjectValue}}
                                    </td>
                                    <td>
                                        {{$second->SubjectUnit}}
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                        
                        <a name="C4"></a>
                        <a href='#C4' onclick="CheckAll()" class="btn btn-danger">Check All</a>

                        <div id="error"></div>

                    
                    <div align='center'><button type="submit" class="btn btn-success">Register Selected Course(s)</button>
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
</script>

@endsection