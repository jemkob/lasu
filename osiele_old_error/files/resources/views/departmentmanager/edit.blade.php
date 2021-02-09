
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Staff Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=> ['DepartmentController@update', $dept->DepartmantID], 'method' => 'POST']) !!} 

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  <tr>
                    <td><label>Department Name</label></td>
                  <td><input type="text" name="deptname" id="deptname" class="form-control" placeholder="E.g. BIOLOGY" value="{{$dept->DepartmentName}}" /></td>
                  </tr>
                    <td><label>Department Code</label>&nbsp;</td>
                    <td><input type="text" name="deptcode" id="deptcode" class="form-control" placeholder="E.g. BIO 110" value="{{$dept->DepartmentCode}}"/></td>
                  </tr>
                  <tr>
                    <td><label for="">School</label></td>
                    <td>
                            <select class="form-control" name="faculties" id="faculties">
                                <option selected="true" value="{{$dept->FacultyID}}">{{ $dept->FacultyName }}</option>
                              <option value="0" disable="true">--- Select School ---</option>
                                @foreach ($faculties as $key => $value)
                                  <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr>
                  
                  <tr>
                        <td></td>
                        <td>{{ Form::hidden('_method', 'PUT') }} {{Form::submit('Edit Department', ['class'=>'btn btn-primary'])}}</td>
                      </tr>
                </table>
              </form>
        </div>
        </div>
        
    
        {!! Form::close() !!}


       
        

    </div>

</div>

@endsection