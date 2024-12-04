@extends('adminlte::page')





@section('content')
<script src="{{ asset('js/angular.min.js') }}"></script>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Result Manager</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-4">
                      <form action="{{url('rectify/updated')}}" method="post">
                        {{-- {!! Form::open(['action'=> ['RectifyResultController@update', $results->resultid], 'method' => 'POST']) !!}  --}}
                        {{csrf_field()}}
                
      <input type="hidden" value="{{$results->resultid}}" name="resultid">                  
    <div class="form-group">
        <label for="">Matric No.</label>
        <input type="text" class="form-control" name="matricno" id="matricno" value="{{$results->matricno}}" readonly>
    </div>
    <div class="form-group">
        <label for="">Course Code</label>
        <input type="text" class="form-control" name="coursecode" id="matricno" value="{{$results->SubjectCode}}" readonly>
    </div>
    <div class="form-group">
        <label for="">Session</label>
        <input type="text" class="form-control" name="sess" id="sess" value="{{$results->sessionid}}" readonly>
    </div>
  
    <div class="form-group">
        <label for="">Old CA score</label>
        <input type="text" class="form-control" name="oldca" id="oldca" value="{{$results->CA}}" readonly>
    </div>
    <div class="form-group">
        <label for="">Old Exam Score</label>
        <input type="text" class="form-control" name="oldexam" id="oldexam" value="{{$results->EXAM}}" readonly>
    </div>
    
<div ng-app="" ng-init="newca=0;newexam=0">
    <div class="form-group">
        <label for="">New CA Score</label>
        <input type="number" class="form-control" ng-model="newca" name="newca" id="newca">
    </div>
    <div class="form-group">
        <label for="">New Exam score</label>
        <input type="number" class="form-control" ng-model="newexam" name="newexam" id="newexam">
    </div>
    <div class="form-group">
        <label for="">New Total Score</label>
        <input type="number" class="form-control" name="newtotal" id="newtotal" value="@{{ newca -- newexam }}" readonly>
    </div>
</div>
    
                              
                              <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Rectify</button>
                                <button onclick="goBack()">Cancel</button>
                                <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script>

                            </div>
                      </form>
                    </div>
                  </div>
                  
                          
        
                  
    </div>

</div>


    
    
@endsection