@extends('adminlte::page')

@section('content')
{{-- <script src="../js/angular.min.js"></script> --}}

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager | New Student Upload</h3>
    
  </div>
  <div style="padding-left:10px; padding-right:10px;">
  
    <div style="float:left;">
        <div class="col-md-6">
            <div class="row">
              <form action="{{url('studentmanager/importfresher')}}" method="post" enctype="multipart/form-data">
                {{-- <form action="{{url('lecturer/import')}}" method="post" enctype="multipart/form-data" onSubmit="return Validate()";> --}}
                {{csrf_field()}}
                
                <div class="col-md-6">
                    <span id="errorName5" style="color: red;"></span>
                  <input type="file" name="fresherfile" id="fresherfile" required="required"/>
                  {{-- <input type="file" name="imported-file" id="resultfile" onchange="return Validate(); this.value=null;return false;" required="required"/> --}}
                </div>
                <div class="col-md-6">&nbsp;</div><div class="col-md-6">&nbsp;</div><div class="col-md-6">&nbsp;</div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Upload Students</button>
                </div>
              </form>
            </div>
        </div>
        
      </div>
  </div>
    <div class="box-body">

      
       

      
          

    </div>

</div>
@endsection

