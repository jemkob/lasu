@extends('adminlte::page')

@section('content')
<style type="text/css">
  
  
    @media print
    {
    form {display:none;}
    }
    
    @media screen
    {
    
    }
    .table-responsive { overflow-x: visible !important; }
    </style>
<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title">ESA Results</h2>
  </div>
    <div class="box-body">


      <div class="col-md-6">
          <form action="{{url('esaviewer/getesaresults')}}" enctype="multipart/form-data" method="POST">
            {{csrf_field()}}

            <div class="form-group">
                <label for="">School</label>
                <select class="form-control" name="faculty" id="faculty">
                    @foreach ($faculties as $key => $value)
                      <option value="{{$value->FacultyName}}">{{ $value->FacultyName }}</option>
                    @endforeach
                </select>
              </div>

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
            <label for="">Level</label>
            <select class="form-control" name="level" id="level">
              <option value="0" disable="true" selected="true">-- Select Level --</option>
              <option value="100">100</option> 
              <option value="200">200</option>
              <option value="300">300</option>
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

         <button class="btn btn-success" name="esa" id="esa" type="submit">Get Result</button>
          </form>
        </div>
       <div class="col-md-12"></div>
        
        @if(isset($results))
      <div class="col-md-9" style="text-transform:uppercase;">
          <table class="table table-striped" width="100%">
              <thead>
                <tr>
                <td colspan="8">
                  <table width="100%" border="0">
                    <tr>
                    <td align="center" nowrap><h3><strong>FEDERAL COLLEGE OF EDUCATION ABEOKUTA</strong></h3></td></tr>
                    <tr>
                    <td align="center"><strong>DEWS RESULT </strong></td>
                    </tr>
                    <tr>
                    <td align="center">@if(count($results) > 0){{$results[0]->FacultyName}}@endif</td>
                    </tr>
                    <tr>
                    <td align="center">@if(count($results) > 0)LEVEL: {{$results[0]->Level}}&emsp; SESSION: {{$results[0]->SessionYear}}&emsp; SEMESTER: {{$results[0]->Semester}} @endif</td>
                    </tr>
                  </table>
                </td>
                </tr>
              <tr>
                <th>S/N</th>
                <th nowrap>Matric No</th>
                <th>Name</th>
                <th nowrap>Course Code</th>
                <th>CA</th>
                <th>EXAM</th>
                <th>TOTAL</th>
                <th>GRADE</th>
                <th>REMARK</th>
              </tr>
              </thead>
              @foreach($results as $key=>$value)
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->MatricNo}}</td>
                  <td>{{$value->Surname.' '.$value->Firstname.' '.$value->Middlename}}</td>
                  <td>{{$value->SubjectCode}}</td>
                  <td>{{$value->CA}}</td>
                  <td>{{$value->EXAM}}</td>
                  <td>{{$value->CA + $value->EXAM}}</td>
                  <td>
                        <?php $total = $value->EXAM + $value->CA;?>
                        @if($total >= 70)
                        A 
                        @elseif($total >= 60 && $total <= 69)
                        B 
                        @elseif($total >= 50 && $total <= 59)
                        C
                        @elseif($total >= 45 && $total <= 49)
                        D 
                        @elseif($total >= 40 && $total <= 44)
                        E 
                        @elseif($total < 40)
                        F
                        @endif
                  </td>
                  <td>@if($value->CA + $value->EXAM > 39)<div class="bg-success">PASSED</div> @else <div class="label label-danger">FAILED</div>@endif</td>
              </tr>
              @endforeach
          </table>
        </div>
        @endif

    </div>

</div>
@endsection

