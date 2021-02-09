@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Carry Overs</h3>
  </div>
    <div class="box-body">
      
  
          

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
  <div class="col-xs-12 col-sm-6 col-md-8">
  <hr>
  <table width="50%" border="1" class="table table-striped table-bordered table-hover col-md-8">
      <tr>
        <th scope="col">Course Title</th>
        <th scope="col">Course Code</th>
        <th scope="col">Course Unit</th>
        <th scope="col">Exam Score</th>
        <th scope="col">CA</th>
        <th scope="col"><b>Total</b></th>
        <th scope="col">Semester</th>
        <th scope="col">Level</th>
        
      </tr>
      @foreach($results as $result)
      <tr>
        <td>{{$result->SubjectName}}</td>
        <td>{{$result->SubjectCode}}</td>
        <td>{{$result->TNU}}</td>
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