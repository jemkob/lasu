@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result Viewer</h3>
  </div>
    <div class="box-body">
      {{-- {!! Form::open(array('route' => 'resultviewer.index', 'class'=>'form navbar-form navbar-right searchform')) !!} --}}
      {{-- {!! Form::open(['route' => 'resultviewer/search', 'method' => 'POST']) !!}
      {!! Form::text('search', null,
                             array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>'Search for a tutorial...')) !!}
       {!! Form::submit('Search',
                                  array('class'=>'btn btn-default')) !!}
   {!! Form::close() !!} --}}

   {{-- <form action="{{url('resultviewer/search')}}" method="post" class="form navbar-form navbar-right searchform">
    <div class="col-md-6">
      {{csrf_field()}}
      <input type="text" name="search" id="search"/>
    </div>
    <div class="col-md-6">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form> --}}

  {{-- {!! Form::open(['route' => 'resultviewer/search', 'method' => 'POST']) !!} --}}
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('resultviewer/search')}}" method="post">
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
                <label for="">Semester</label>
                <select class="form-control" name="semester" id="semester">
                  <option value="0" disable="true" selected="true">-- Select Semester --</option>
                  <option value="1">1st Semester</option> 
                  <option value="2">2nd Semester</option>
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
  <div class="col-xs-12 col-sm-6 col-md-8">
  
  <table width="50%" border="1" class="table table-striped table-bordered table-hover col-md-8">
      <tr>
        <th scope="col">Course Code</th>
        <th scope="col">Course Unit</th>
        <th scope="col">Exam Score</th>
        <th scope="col">CA</th>
        <th scope="col">Total</th>
        
      </tr>
      @foreach($results as $result)
      <tr>
        <td>{{$result->SubjectCode}}</td>
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


