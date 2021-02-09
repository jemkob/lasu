@extends('adminlte::page')





@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Suspension Cases | Place On Suspension</h3>
  </div>
    <div class="box-body">
  <div class="row">
    <div class="col-sm-4">
      <form action="{{url('suspension/effectprobation')}}" method="post">
        {{csrf_field()}}
              <div class="form-group">
                <label for="">Probation</label>
                <select class="form-control" name="probationtype" id="probationtype" required="required">
                  <option value="" disable="true" selected="true">-- Select Probation Type--</option>
                    <option value="Suspension">Suspension</option>
                    <option value="Malpractice">Malpractice</option>
                    <option value="Rustification">Rustification</option>
                    <option value="Deferment">Deferment</option>
                </select>
              </div>

             
              <div class="form-group">
                <label for="">Matric No.</label>
                <input type="text" class="form-control" name="matricno" id="matricno" required="required">
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Place on suspension</button>
            </div>
      </form>
    </div>
  </div>
          

        {{-- {!! Form::close() !!} --}}


    </div>

</div>

@endsection