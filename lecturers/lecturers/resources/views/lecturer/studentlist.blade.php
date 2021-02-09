@extends('adminlte::page')

@section('content')
<?php
$lecturerpassword = Auth::user()->Password;
if($lecturerpassword == '12345'){
?>
<script type="text/javascript">
    function Redirect() {
       window.location= "resetpassword";
    }
    setTimeout('Redirect()', 1);
</script>
<?php } ?>

<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title">View Students</h2>
  </div>
    <div class="box-body">

@if(isset($subjects))
      <div class="col-md-6">
          <form action="{{url('lecturer/studentlists')}}" method="post">
            {{csrf_field()}}
            {{-- <div class="form-group">
              <label for="">Faculty</label>
              <select class="form-control" name="subject" id="subject">
                <option value="0" disable="true" selected="true">--- Select Course ---</option>
                  @foreach ($faculties as $key => $value)
                    <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                  @endforeach
              </select>
            </div> --}}

            <div class="form-group">
                <label for="">Course</label>
                <select class="form-control" name="subject" id="subject">
                  <option value="0" disable="true" selected="true">--- Select Course ---</option>
                    @foreach ($subjects as $key => $value)
                      <option value="{{$value->subjectid}}">{{ $value->subjectcode }}</option>
                    @endforeach
                </select>
              </div>

            <button class="btn btn-success" type="submit">Get Students</button>
            
            
          </form>
        </div>
        @endif
<div class="col-md-12"></div>

    @if(isset($studentlist))
      <div class="col-md-6">
          <table class="table table-striped" width="70%">
              <tr>
                <th>S/N<th
                <th>Matric No</th>
                <th>CA</th>
                <th>EXAM</th>
                <th>TOTAL</th>
              </tr>
              @foreach($studentlist as $key=>$value)
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->matricno}}</td>
                  <td>{{$value->ca}}</td>
                  <td>{{$value->exam}}</td>
                  <td>{{$value->ca + $value->exam}}</td>
              </tr>
              @endforeach
          </table>
        </div>
        @endif
          

    </div>

</div>
@endsection

