@extends('layouts.app')

@section('content')
<div style="text-align:center;">
<h3>Student Registration</h3>
</div>
<form action="{{url('student/postinvoice')}}" method="POST" >
    {{csrf_field()}}
<div class="container">
    <div class="row justify-content-center">
        
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Personal Information') }}</div>

                <div class="card-body row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="surname">{{ __('Surname') }}</label>

                                <input id="surname" type="text" class="form-control" {{ $errors->has('surname') ? ' is-invalid' : '' }} name="surname" value="{{ old('surname') }}" placeholder="Enter your surname" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="firstname">{{ __('First Name') }}</label>

                                <input id="firstname" type="text" class="form-control" {{ $errors->has('firstname') ? ' is-invalid' : '' }} name="firstname" value="{{ old('firstname') }}" placeholder="Enter your first name" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="othername">{{ __('Other Name') }}</label>
                                <input id="othername" type="text" class="form-control" {{ $errors->has('othername') ? ' is-invalid' : '' }} name="othername" value="{{ old('othername') }}" placeholder="Enter your other name" autofocus>

                                @if ($errors->has('othername'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('othername') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Nationality') }}</label>
                                <select id="country" class="form-control" name="country">
                                <option value="0" disable="true" selected="true">--- Select Country ---</option>
                            @foreach($country as $nation)
                                <option value="{{$nation->NationId}}">{{$nation->NationName}}</option>
                            @endforeach
                                </select>

                        </div>

                        <div class="form-group">
                            <label for="">{{ __('State Of Origin') }}</label>
                                <select class="form-control" name="state" id="state">
                                <option value="0" disable="true" selected="true">--- Select State ---</option>
                                @foreach($states as $state)
                                <option value="{{$state->StateName}}">{{$state->StateName}}</option>
                                @endforeach
                                </select>
                        </div>

                        <div class="form-group ">
                            <label for="">{{ __('LGA') }}</label>
                            <select class="form-control" name="localgovt" id="localgovt">
                                <option value="0" disable="true" selected="true">--- Select LGA ---</option>
                                @foreach($lga as $lg)
                                <option value="{{$lg->LocalGovtFullname}}">{{$lg->LocalGovtFullname.' In '. $lg->StateName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Place Of Birth') }}</label>
                                <select class="form-control" name="placeofbirth" id="placeofbirth">
                                <option value="0" disable="true" selected="true">--- Select State ---</option>
                                @foreach($states as $state)
                                <option value="{{$state->StateName}}">{{$state->StateName}}</option>
                                @endforeach
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="subjectcomb">{{ __('Subject Combination') }}</label>
                            
                                <select id="subjectcomb" class="form-control" name="subjectcomb">
                        @foreach($subcom as $combination)
                            <option value="{{$combination->SubjectCombinName}}">{{$combination->SubjectCombinName}}</option>
                        @endforeach
                            </select>
                        </div>

                </div>
                
                <div class="col-lg-6">
                        <div class="form-group" id="datebox">
                                <label for="jambno">{{ __('Date Of Birth') }}</label>
    
                                
                                    <input type="text" id="dateofbirth" name="dateofbirth" class="form-control" placeholder="MM/DD/YYYY" data-provide="datepicker" {{ $errors->has('dateofbirth') ? ' is-invalid' : '' }} value="{{ old('dateofbirth') }}" required data-date-format="dd/mm/yyyy">

                                    @if ($errors->has('dateofbirth'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('dateofbirth') }}</strong>
                                        </span>
                                    @endif
                        </div>

                        <div class="form-group">
                                <label for="jambno">{{ __('JAMB Registration No.') }}</label>
    
                                    <input id="jambno" type="text" class="form-control" {{ $errors->has('jambno') ? ' is-invalid' : '' }} name="jambno" value="{{ old('jambno') }}" required autofocus>
    
                                    @if ($errors->has('jambno'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('jambno') }}</strong>
                                        </span>
                                    @endif
                        </div>


                        <div class="form-group">
                            <label for="homeaddress">{{ __('Current Address') }}</label>

                                <input id="homeaddress" type="text" class="form-control" {{ $errors->has('homeaddress') ? ' is-invalid' : '' }} name="homeaddress" value="{{ old('homeaddress') }}" required autofocus>

                                @if ($errors->has('surnamehomeaddress'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('homeaddress') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="phonenumber">{{ __('Phone Number') }}</label>

                                <input id="phonenumber" type="text" class="form-control" {{ $errors->has('phonenumber') ? ' is-invalid' : '' }} name="phonenumber" value="{{ old('phonenumber') }}" required autofocus>

                                @if ($errors->has('phonenumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
    
                                    <input id="email" type="email" class="form-control" {{ $errors->has('email') ? ' is-invalid' : '' }} name="email" value="{{ old('email') }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>

                        <div class="form-group">
                                <label for="gender">{{ __('Gender') }}</label>
                            
                                <select id="gender" class="form-control" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                        </div>

                        <div class="form-group">
                                <label for="religion">{{ __('Religion') }}</label>
                            
                                <select id="religion" class="form-control" name="religion">
                                <option value="Christianity">Christianity</option>
                                <option value="Islam">Islam</option>
                                <option value="Other">Other</option>
                                </select>
                        </div>
                </div>
                </div>
            </div>
        </div>


<div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Parent/Guardian/Sponsor Information') }}</div>

            <div class="card-body row">
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sponsorsname">{{ __('Sponsor\' Name') }}</label>

                                <input id="sponsorsname" type="text" class="form-control" {{ $errors->has('sponsorsname') ? ' is-invalid' : '' }} name="sponsorsname" value="{{ old('sponsorsname') }}" required autofocus>

                                @if ($errors->has('sponsorsname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sponsorsname') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="sponsorsphone">{{ __('Phone') }}</label>

                                <input id="sponsorsphone" type="text" class="form-control" {{ $errors->has('sponsorsphone') ? ' is-invalid' : '' }} name="sponsorsphone" value="{{ old('sponsorsphone') }}" required autofocus>

                                @if ($errors->has('sponsorsphone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sponsorsphone') }}</strong>
                                    </span>
                                @endif
                        </div>
                </div>

                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sponsorsaddress">{{ __('Address') }}</label>
                                <input id="sponsorsaddress" type="text" class="form-control" {{ $errors->has('sponsorsaddress') ? ' is-invalid' : '' }} name="sponsorsaddress" value="{{ old('sponsorsaddress') }}" autofocus>

                                @if ($errors->has('sponsorsaddress'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sponsorsaddress') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="relationship">{{ __('Relationship') }}</label>
                            
                                <select id="relationship" class="form-control" name="relationship">
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Uncle">Uncle</option>
                                <option value="Aunty">Aunty</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Husband">Husband</option>
                                <option value="Wife">Wife</option>
                                <option value="Other">Other</option>
                                </select>
                        </div>
                </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save And Continue') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>

              
    </div>
</div>

</form> 

<script src="{{asset('jscss/jquery.min.js')}}"></script>
<script src="{{asset('jscss/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $('#country').on('change', function(e){
      console.log(e);
      var country = e.target.value;
      $.get('/jsonstates?countryid=' + country,function(data) {
        console.log(data);
        $('#state').empty();
        $('#state').append('<option value="0" disable="true" selected="true">--- Select State ---</option>');

        $('#localgovt').empty();
        $('#localgovt').append('<option value="0" disable="true" selected="true">--- Select LGA ---</option>');

        $.each(data, function(index, stateObj){
          $('#state').append('<option value="'+ stateObj.StateId +'">'+ stateObj.StateName +'</option>');
        })
      });
    });

    $('#state').on('change', function(e){
      console.log(e);
      var state = e.target.value;
      $.get('/jsonlga?stateid=' + state,function(data) {
        console.log(data);
        $('#localgovt').empty();
        $('#localgovt').append('<option value="0" disable="true" selected="true">--- Select LGA ---</option>');

        $.each(data, function(index, localgovtObj){
          $('#localgovt').append('<option value="'+ localgovtObj.LocalGovtId +'">'+ localgovtObj.LocalGovtFullname +'</option>');
        })
      });
    });

  </script> 

@endsection
