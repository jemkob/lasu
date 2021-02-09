
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Department Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=> 'DepartmentController@store', 'method' => 'POST']) !!} 

     <div class="row">
        <div class="col-6 col-sm-6">
        <form id="form1" name="form1" method="post" action="">
                <table width="573" border="0" class="table table-striped">
                  <tr>
                    <td><label>Department Name</label></td>
                  <td><input type="text" name="deptname" id="deptname" class="form-control" placeholder="E.g. BIOLOGY" required="required"/></td>
                  </tr>
                    <td><label>Department Code</label>&nbsp;</td>
                    <td><input type="text" name="deptcode" id="deptcode" class="form-control" placeholder="E.g. BIO 110" required="required"/></td>
                  </tr>
                  <tr>
                    <td><label for="">School</label></td>
                    <td>
                            <select class="form-control" name="faculties" id="faculties" required="required">
                              <option value="" disable="true" selected="true">--- Select School ---</option>
                                @foreach ($faculties as $key => $value)
                                  <option value="{{$value->FacultyID}}">{{ $value->FacultyName }}</option>
                                @endforeach
                            </select>
                    </td>
                  </tr>
                  
                  <tr>
                        <td></td>
                        <td>{{Form::submit('Add Department', ['class'=>'btn btn-primary'])}}</td>
                      </tr>
                </table>
              </form>
        </div>
        </div>
        
    
        {!! Form::close() !!}


       
        

    </div>

</div>

@endsection