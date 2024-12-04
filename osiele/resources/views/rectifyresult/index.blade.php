@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Viewer</h3>
  </div>
    <div class="box-body">
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('rectify/search')}}" method="post">
        {{csrf_field()}}
              <div class="form-group">
                <label for="">Session</label>
                <select class="form-control" name="sessions" id="sessions">
                  <option value="0" disable="true" selected="true">-- Select Session --</option>
                    @foreach ($sessions as $key => $value)
                      <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                    @endforeach
                </select>
              </div>

              
              <div class="form-group">
                <label for="">Matric No.</label>
                <input type="text" class="form-control" name="matricno" id="matricno">
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
      </form>
    </div>
  </div>
          

        {{-- {!! Form::close() !!} --}}

@if(isset($results))
   @if (count($results) === 0)
   <div class="alert alert-info">
    <strong>No result was found</strong>
  </div>
@elseif (count($results) >= 1)
<div class="row">
  <div>

  <table class="table table-striped" style="text-transform:uppercase;" width="70%">
      <tr><td class="alert alert-success"><h3>{{$results[0]->surname.' '.$results[0]->firstname.' '.$results[0]->middlename}}  {{$results[0]->matricno}}</h3></td></tr>
  </table>

  <table width="100%" border="1" class="table table-striped table-bordered table-hover">
      <tr><th></th>
        <th></th>
        <th scope="col">Course Code</th>
        <th scope="col">Course Title</th>
        <th scope="col">Course Unit</th>
        <th scope="col">Exam Score</th>
        <th scope="col">CA</th>
        <th scope="col">Total</th>
        
      </tr>
      @foreach($results as $result)
      <tr>
        <td><a href="{{$result->resultid}}/edit" class="btn btn-default">Rectify</a></td>
        <td><a href="#" class="btn btn-warning">Drop</a></td>
        <td>{{$result->SubjectCode}}</td>
        <td>{{$result->SubjectName}}</td>
        <td>{{$result->tnu}}</td>
        <td>{{$result->EXAM}}</td>
        <td>{{$result->CA}}</td>
        <td>{{$result->EXAM + $result->CA}}</td>
        
      </tr>
      @endforeach
    </table>
  </div>
</div>
    
    
@endif
@endif

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $('#sessions').on('change', function(e){
        console.log(e);
        var sessionid = e.target.value;
        $.get('/json-results?sessionid=' + sessionid,function(data) {
          console.log(data);
          $('#semester').empty();
          $('#semester').append('<option value="1" selected="true">1st Semester</option> <option value="2">2nd Semester</option> ');

          $.each(data, function(index, departmentsObj){
            $('#departments').append('<option value="'+ departmentsObj.DepartmentID +'">'+ departmentsObj.DepartmentName +'</option>');
          })
        });
      });

    </script>
@endsection