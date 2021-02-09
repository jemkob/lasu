@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Promote Students</h3>
  </div>
  <div class="box-body">
  <div class="row">
        <div class="col-sm-4">
          <form action="{{url('studentmanager/promote')}}" method="post">
            {{csrf_field()}}
                  
                  <div class="form-group">
                    <ul>
                      <li>Ensure all 300 level students are sorted before promoting.</li>
                      <li>Create a new session before promoting current session.</li>
                      <li>Ensure all results are uploaded and school session is finalized.</li>
                    </ul>
                  </div>
    
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Promote</button>
                </div>
          </form>
        </div>
        <div>
          <li>Ensure all 300 level students are sorted before promoting</li>
        </div>
      </div>
  </div>

</div>
@endsection

