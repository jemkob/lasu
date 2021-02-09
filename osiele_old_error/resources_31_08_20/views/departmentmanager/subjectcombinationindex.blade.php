@extends('adminlte::page')
@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Subject Combination Manager</h3>
    
  </div>
  <div style="padding-left:10px; padding-right:10px;">
      <div style="float:right;"><a href ="createcombinationindex" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Add New Combination</a></div>
    </div>
    <div class="box-body">
            <div class="row">
                    <div class="col-sm-4">
                      
                    </div>
                  </div>
                          
        
@if(isset($subcomb))
    @if (count($subcomb) === 0)
    <div class="alert alert-danger">
        <strong>No Subject Combination was found.</strong>
    </div>
    @elseif (count($subcomb) >= 1)

        <table class="table table-striped" width="50%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    
                    <th scope="col">Subject Combination</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                
                
                
                <tbody>
                @foreach($subcomb as $index =>$majorminor)
                  <tr>
                    <td scope="row">{{$index+1}}</td>
                    <td>{{$majorminor->SubjectCombinName}}</td>
                    <td></td>
                    {{-- <td>
                        <a href ="departmentmanager/{{$department->DepartmentID}}/edit"><i class="fa fa-lg fa-edit"></i></a>
                       
                      </td> --}}
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
    
@endif
@endif



    </div>

</div>


@endsection


