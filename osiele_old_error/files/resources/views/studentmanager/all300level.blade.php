@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Promote Students 300 Level</h3>
  </div>
  <div class="box-body">
  <div class="row">
        <div class="col-sm-4">
          <form action="{{url('studentmanager/promote')}}" method="post">
            {{csrf_field()}}
                  
                  <div class="form-group">
                    <label for="">Level</label>
                    <select class="form-control" name="level" id="level">
                      <option value="0" disable="true" selected="true">-- Select Level --</option>
                      <option value="100">100</option> 
                      <option value="200">200</option>
                      <option value="300">300</option>
                    </select>
                  </div>
    
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Promote</button>
                </div>
          </form>
        </div>
        <div>
          <li>Ensure all 300 level students are sorted before promoting</li>
        </div>
        <ol>
        @foreach ($all300level as $allstudents)
            
              <li>{{$allstudents->MatricNo.', '.$allstudents->Firstname}}</li>
            
        @endforeach
      </ol>
      </div>
  </div>

</div>
@endsection

