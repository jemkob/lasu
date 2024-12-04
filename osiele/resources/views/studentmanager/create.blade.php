
@extends('adminlte::page')

@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Student Manager</h3>
  </div>
    <div class="box-body">
        
        {!! Form::open(['action'=>'StudentManagerController@store', 'method' => 'POST']) !!}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('firstname', 'Matric No.')}}
                    <input type="text" class="form-control" placeholder="Matric No." name="matricno" required>
                </div>

                <div class="form-group">
                    {{Form::label('surname', 'Last Name')}}
                    <input type="text" class="form-control" placeholder="Surname" name="surname" required>
                </div>

                <div class="form-group">
                    {{Form::label('firstname', 'First Name')}}
                    <input type="text" class="form-control" placeholder="First name" name="firstname" required>
                </div>
        
                <div class="form-group">
                    {{Form::label('middlename', 'Middle Name')}}
                    {{Form::text('middlename', '', ['class' => 'form-control', 'placeholder'=>'MiddleName'])}}
                </div>

                <div class="form-group">
                    <label for="entrylevel">Entry Mode</label>
                    <select name="levelofentry" id="levelofentry" class="form-control">  
                        <option value="100">Regular Entry</option>
                        <option value="200">Direct Entry</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="level">Current Level/Module</label>
                    <select name="level" id="level" class="form-control">  
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <select name="department" id="department" class="form-control" required> 
                        @foreach($departments as $dept) 
                            <option value="{{$dept->DepartmentID}}">{{$dept->DepartmentName}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone No.</label>
                    <input type="phone" class="form-control" placeholder="phone no" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="olevel">O'Level Sitting(s)</label>
                    <select name="olevel" id="olevel" class="form-control">  
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">  
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nin">NIN</label>
                    <input type="text" class="form-control" name="nin" placeholder="NIN">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        

        
    
        {!! Form::close() !!}


       
        

    </div>

</div>
@endsection