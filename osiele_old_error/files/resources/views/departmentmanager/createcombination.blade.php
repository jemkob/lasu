
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Subject Combination Manager</h3>
  </div>
    <div class="box-body">
        
    <form action="{{url('createcombination')}}" method="post">
      {{csrf_field()}}

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  
                  <tr>
                    <td><label for="">Major</label></td>
                    <td>
                            <select class="form-control" name="major" id="major" required="required">
                              <option value="" disable="true" selected="true">--- Select Major ---</option>
                                @foreach ($departments as $key => $value)
                                  <option value="{{$value->DepartmentCode}}">{{$value->DepartmentCode}}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="">Minor</label></td>
                    <td>
                            <select class="form-control" name="minor" id="minor" required="required">
                              <option value="" disable="true" selected="true">--- Select Major ---</option>
                              @foreach ($departments as $key => $value)
                              <option value="{{$value->DepartmentCode}}">{{$value->DepartmentCode}}</option>
                              @endforeach
                            </select>
                    </td>
                  </tr>
                  
                  <tr>
                        <td></td>
                        <td>{{Form::submit('Add Subject Combination', ['class'=>'btn btn-primary'])}}</td>
                      </tr>
                </table>
              </form>
        </div>
        </div>

    </div>

</div>

@endsection