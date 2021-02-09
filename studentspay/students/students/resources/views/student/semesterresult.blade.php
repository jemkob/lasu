@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Result By Semester</h3>
  </div>
    <div class="box-body">
      
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('student/semesterresult')}}" method="post">
        {{csrf_field()}}
              <div class="form-group">
                <label for="">Level</label>
                <select class="form-control" name="level" id="level">
                  <option value="0" disable="true" selected="true">-- Select Level --</option>
                  
                    @foreach ($level as $key => $value)
                      <option value="{{$value->Level}}">{{ $value->Level }} Level</option>
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

              
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
      </form>
    </div>
  </div>
          

        {{-- {!! Form::close() !!} --}}
<br>
<br>
@if(isset($results))
   @if (count($results) === 0)
   <div class="alert alert-info">
    <strong>No result was found</strong>
  </div>
@elseif (count($results) >= 1)

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8" style="text-transform:uppercase;">
  <h2>{{$thelevel}} Level  @if($semester==1) {{$semester}}st @else {{$semester}}nd @endif Semester</h2>
  <hr>
  <table width="50%" border="1" class="table table-striped table-bordered table-hover col-md-8">
      <tr>
        <th scope="col" nowrap>Course Title</th>
        <th scope="col" nowrap>Course Code</th>
        <th scope="col" nowrap>Course Unit</th>
        <th scope="col" nowrap>Exam Score</th>
        <th scope="col">CA</th>
        <th scope="col"><b>Total</b></th>
        <th scope="col">Semester</th>
        <th scope="col">Level</th>
        
      </tr>
      @foreach($results as $result)
      <tr>
        <td>{{$result->SubjectName}}</td>
        <td>{{$result->SubjectCode}}</td>
        <td>{{$result->tnu}}</td>
        <td>{{$result->EXAM}}</td>
        <td>{{$result->CA}}</td>
        @if(($result->EXAM + $result->CA)>= 40)
        <td><b>{{$result->EXAM + $result->CA}}</b></td>
        @else
        <td class="alert alert-danger"><b>{{$result->EXAM + $result->CA}}</b></td>
        @endif
        <td>{{$result->Semester}}</td>
        <td>{{$result->level}}</td>
        
      </tr>
      @endforeach
    </table>
  </div>
</div>
    
    
@endif
@endif

    </div>

</div>


@endsection


