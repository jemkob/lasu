<!DOCTYPE html>
<html>
 <head>
  <title>Ajax Dynamic Dependent Dropdown in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
   <div class="form-group">
    <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
     <option value="">Select Country</option>
     @foreach($faculty_list as $faculty)
     <option value="{{ $$faculty->FacultyID}}">{{ $c$faculty->FacultyName }}</option>
     @endforeach
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
     <option value="">Select State</option>
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="city" id="city" class="form-control input-lg">
     <option value="">Select City</option>
    </select>
   </div>
   {{ csrf_field() }}
   <br />
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('dynamicdependent.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

 $('#country').change(function(){
  $('#state').val('');
  $('#city').val('');
 });

 $('#state').change(function(){
  $('#city').val('');
 });
 

});
</script>


{{-- <!DOCTYPE html>
<html>
<head>
	<title>Laravel 5 - onChange event using ajax dropdown list</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    
        <div class="container">
                <h1>Laravel 5 - Dynamic Dependant Select Box using JQuery Ajax Example</h1>

{!! Form::open() !!}


    <div class="form-group">
      <label>Select Country:</label>
      {!! Form::select('FacultyID',[''=>'--- Select Country ---']+$countries,null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
      <label>Select State:</label>
      {!! Form::select('DepartmentID',[''=>'--- Select State ---'],null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
      <button class="btn btn-success" type="submit">Submit</button>
    </div>


  {!! Form::close() !!}

</div>


  <script type="text/javascript">
    $("select[name='FacultyID']").change(function(){
        var FacultyID = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{{url('select-ajax')}}",
            method: 'POST',
            data: {FacultyID:FacultyID, _token:token},
            success: function(data) {
              $("select[name='DepartmentID'").html('');
              $("select[name='DepartmentID'").html(data.options);
            }
        });
    });
  </script>

</body>
</html> --}}
