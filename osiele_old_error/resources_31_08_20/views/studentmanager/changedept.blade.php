@extends('adminlte::page')
@section('content')

<style type="text/css">
  .LockOn {
    display: block;
    visibility: visible;
    position: absolute;
    z-index: 999;
    top: 0px;
    left: 0px;
    width: 105%;
    height: 105%;
    background-color:white;
    vertical-align:bottom;
    padding-top: 20%; 
    filter: alpha(opacity=75); 
    opacity: 0.75; 
    font-size:large;
    color:blue;
    font-style:italic;
    font-weight:400;
    background-image: url("/images/ajax-loader.gif");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
}
</style>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager | Transfer To New Department</h3>
  </div>
    <div class="box-body">
      <div id="coverScreen"  class="LockOn">
      </div>
      <div class="row">
      <div class="col-md-12">
        <div class="col-md-6 bg-danger">
          <ul>
            <li>Only applies to 200 level students.</li>
            <li>Ensure the new department is the actual.</li>
            <li>Actions are irreversible.</li>
            <li>Always double check the matric number and department.</li>
          </ul>
        </div>
      </div>
        <div class="col-sm-4">
          <form action="{{url('studentmanager/changedept')}}" method="post">
            
            {{csrf_field()}}
                    <div class="form-group">
                        <label for="">Enter Matric No.</label>
                        <input type="text"  class="form-control" name="studentid" id="studentid" placeholder="Enter Matric No." required="required"><a href='#'>Verify</a>
                    </div>
                    <div class="form-group" id="verify">
                        
                    </div>
                    <div class="form-group">
                        <label for="">New Department</label>
                        <select class="form-control" name="combination" id="combination" required="required">
                            <option value="" disable="true" selected="true">-- Select Level --</option>
                            @foreach($combination as $comb)
                            <option value="{{$comb->SubjectCombinID}}">{{$comb->SubjectCombinName}}</option> 
                            @endforeach
                          </select>
                    </div>
                  
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Transfer Student</button>
                </div>
          </form>
        </div>
      </div>
        
      



    </div>

</div>
<script>
$("#coverScreen").hide();
  $('#studentid').on('change', function(e){
    $("#coverScreen").show();
          console.log(e);
          var studentid = e.target.value;
          $.get('/json-student?studentid=' + studentid,function(data) {
            $("#coverScreen").show();
            console.log(data);
            $('#verify').empty();
            $('#verify').append('<h3>Student Details</h3>');
            $('#verify').append('<span>Name: '+data.Surname+' '+data.Firstname+' '+data.Middlename+'</span><br/>');
            $('#verify').append('<span>Current Department: <strong>'+data.Major+'/'+data.Minor+'</strong></span><br/>');
            $('#verify').append('<span>Level: '+data.Level+'</span>');
            $("#coverScreen").hide();
          });
        });
</script>

@endsection


