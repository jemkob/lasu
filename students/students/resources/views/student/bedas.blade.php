@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">BED ACCOUNTING/SECRETARIAT</h3>
  </div>
    <div class="box-body">
      
        <div class="row">
          <div class="col-sm-4">
            <form action="{{url('student/addbedas')}}" method="post">
              {{csrf_field()}}
                    <div class="form-group">
                      <label for="">Please Select Your Preferred BED  Department.</label>
                      <select class="form-control" name="bedas" id="bedas" required="required">
                        <option value="" disabled="true">-- Select BED OPTION --</option>
                        <option value="beda">BED ACCOUNTING</option>
                        <option value="beds">BED SECRETARIAT</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
            </form>
          </div>
        </div>

    </div>

</div>


@endsection


