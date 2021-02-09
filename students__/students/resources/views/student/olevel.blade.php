@extends('adminlte::page')

@section('content')
<style type="text/css">
.solidborder{
border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
</style>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">O'Level Information</h3>
  </div>
  <div class="box-body">




<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">UTME Details</a></li>
        <li><a data-toggle="tab" href="#menu1">O'Level Details</a></li>
        <li><a data-toggle="tab" href="#menu2">Add O'Level</a></li>
        <li><a data-toggle="tab" href="#editolevel">Edit O'Level</a></li>
        <li><a data-toggle="tab" href="#menu3">Add UTME</a></li>
      </ul>
    
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>UTME Details</h3>
          <div class="col-md-12">
                <h3></h3>
      
                
                <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
      
                    <thead>
                        <tr>
                            <th>Registration Number</th>
                            <th>Center Number</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="solidborder" colspan="">{{$jamb->RegNo}}</td>
                            <td class="solidborder" colspan="">{{$jamb->Center}}</td>
                            <td class="solidborder" colspan="">{{$jamb->Year}}</td>
                        </tr>
      
                    </tbody>
                </table>
                <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
      
                      <thead>
                          <tr>
                              <th>Subject</th>
                              <th>Score</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($jambdetails as $jmb)
                          <tr>
                              <td class="solidborder" colspan="">{{$jmb->Subject}}</td>
                              <td class="solidborder" colspan="">{{$jmb->Score}}</td>
                          </tr>
                          @endforeach
                          <tr>
      <td class="solidborder" colspan="">TOTAL SCORE</td>
                          <td class="solidborder" colspan="">{{$sumscore}}</td>
                          </tr>
                      </tbody>
                  </table> 
                  @if($jmb->Score <= 0)
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".jambresult">Add JAMB Result</button>
                  @endif
              </div>
        </div>
        <div id="menu1" class="tab-pane fade">
          <h3>O'Level Details</h3>
          <div class="col-md-12">
                <hr /><br />
                @foreach($olevels as $levels)
                {{-- @dd($levels); --}}
                <?php $olevel = collect($olevel); ?>
                
                        <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
                            <thead>
                                <tr>
                                    <th>Exam Type</th>
            
                                    <th>Exam Year</th>
                                    <th>Center Number</th>
                                    <th>Reg Number</th>
                                </tr>
            
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="solidborder" colspan="">{{$levels->ExamType}}</td>
                                    <td class="solidborder" colspan="">{{$levels->ExamYear}}</td>
                                    <td class="solidborder" colspan="">{{$levels->CenterNumber}}</td>
                                    <td class="solidborder" colspan="">{{$levels->RegNo}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <?php $oleveldetails = collect($oleveldetails);
                                $olevel1 = $oleveldetails->where('RegNo', $levels->RegNo);
                                $olevel1->all(); 
                               ?>
                              {{-- @dd($oleveldetails); --}}
                        <table style="border: 1px solid #000; width: 100%; margin-top: 5px;" border="0" cellspacing="0" class="auto-style5">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($olevel1 as $odetails)
                                <tr>
                                    <td class="solidborder" colspan="">{{$odetails->SubjectName}}</td>
                                    <td class="solidborder" colspan="">{{$odetails->Grade}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr style="border:2px solid #000;">
                        
                @endforeach
                    
                        <hr />
                        
                    </div>
        </div>
        <div id="menu2" class="tab-pane fade">
          <h3>Add O'Level Results</h3>
          <p>
            @if(count($olevels) < 2)
            <div class="col-lg-6">
              <form action="{{url('student/AddOlevel')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="examtype">{{ __('Exam Type') }}</label>
                    <select name="examtype" id="examtype" class="form-control">
                        <option value="0">Select Exam Type</option>
                        <option value="NABTEC">NABTEC</option>
                        <option value="NECO">NECO</option>
                        <option value="WAEC">WAEC</option>
                    </select>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                        <label for="examyear">{{ __('Exam Year') }}</label>
                        <select name="examyear" id="examyear" class="form-control">
                            <?php $a=(int) date('Y') - 15; ?>
                        @for($i =(int) date('Y'); $i > $a; $i--)
                        <option value="">{{$i}} </option>
                        @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                        <label for="centreno">{{ __('Centre No.') }}</label>
                        <input type="text" name="centreno" id="centreno" class="form-control" required>
                            
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                        <label for="regno">{{ __('Registration No.') }}</label>
                        {{-- <input type="text" name="regno" id="regno" class="form-control"> --}}
                        <input id="regno" type="text" class="form-control" {{ $errors->has('regno') ? ' is-invalid' : '' }} name="regno" value="{{ old('regno') }}" required autofocus>

                                @if ($errors->has('regno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('regno') }}</strong>
                                    </span>
                                @endif
                    </div>
                </div>

                <table class="table table-striped">
                {{-- <tr><td>#</td><td>Subjects</td><td>Grade</td></tr> --}}
                @for($i = 0; $i < 9; $i++)
                <tr><td colspan="3">
                <div class="form-group">
                    <div class="col-md-1">
                    {{-- {{$i+1}} --}}
                    </div>
                    <div class="col-md-1">
                    {{$i+1}}
                    </div>
                    <div class="col-md-5">
                        
                        <select name="subject[]" id="subject" class="form-control">
                            <option value="0">Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->Subject}}">{{$subject->Subject}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="grade[]" id="grade" class="form-control">
                            <option value="0">Choose Grade</option>
                            @foreach ($grades as $grade)
                                <option value="{{$grade->Grade}}">{{$grade->Grade}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </td>
            </tr>
                @endfor
            </table>
                <div class="col-md-2"></div>
                <div class="col-md-10"><button type="submit" class="btn btn-success">Submit</button></div>
                
            </form>
            </div>
            @else
            <div class="alert alert-warning">You have more than one (1) O'level Results!</div>
            @endif
          </p>
        </div>

        {{-- Edit O level --}}
        <div id="editolevel" class="tab-pane fade">
            <h3>Edit O'Level Results</h3>
            <p>
              @if(count($olevels) < 2)
              <div class="col-lg-6">
                <form action="{{url('student/AddOlevel')}}" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                      <label for="examtype">{{ __('Exam Type') }}</label>
                      <select name="examtype" id="examtype" class="form-control">
                          <option value="0">Select Exam Type</option>
                          <option value="NABTEC">NABTEC</option>
                          <option value="NECO">NECO</option>
                          <option value="WAEC">WAEC</option>
                      </select>
                  </div>
  
                  <div class="col-md-4">
                  <div class="form-group">
                          <label for="examyear">{{ __('Exam Year') }}</label>
                          <select name="examyear" id="examyear" class="form-control">
                              <?php $a=(int) date('Y') - 15; ?>
                          @for($i =(int) date('Y'); $i > $a; $i--)
                          <option value="">{{$i}} </option>
                          @endfor
                          </select>
                      </div>
                  </div>
  
                  <div class="col-md-4">
                  <div class="form-group">
                          <label for="centreno">{{ __('Centre No.') }}</label>
                          <input type="text" name="centreno" id="centreno" class="form-control" required>
                              
                      </div>
                  </div>
  
                  <div class="col-md-4">
                  <div class="form-group">
                          <label for="regno">{{ __('Registration No.') }}</label>
                          {{-- <input type="text" name="regno" id="regno" class="form-control"> --}}
                          <input id="regno" type="text" class="form-control" {{ $errors->has('regno') ? ' is-invalid' : '' }} name="regno" value="{{ old('regno') }}" required autofocus>
  
                                  @if ($errors->has('regno'))
                                      <span class="invalid-feedback">
                                          <strong>{{ $errors->first('regno') }}</strong>
                                      </span>
                                  @endif
                      </div>
                  </div>
  
                  <table class="table table-striped">
                  {{-- <tr><td>#</td><td>Subjects</td><td>Grade</td></tr> --}}
                  @for($i = 0; $i < 9; $i++)
                  <tr><td colspan="3">
                  <div class="form-group">
                      <div class="col-md-1">
                      {{-- {{$i+1}} --}}
                      </div>
                      <div class="col-md-1">
                      {{$i+1}}
                      </div>
                      <div class="col-md-5">
                          
                          <select name="subject[]" id="subject" class="form-control">
                              <option value="0">Select Subject</option>
                              @foreach ($subjects as $subject)
                                  <option value="{{$subject->Subject}}">{{$subject->Subject}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-5">
                          <select name="grade[]" id="grade" class="form-control">
                              <option value="0">Choose Grade</option>
                              @foreach ($grades as $grade)
                                  <option value="{{$grade->Grade}}">{{$grade->Grade}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  </td>
              </tr>
                  @endfor
              </table>
                  <div class="col-md-2"></div>
                  <div class="col-md-10"><button type="submit" class="btn btn-success">Submit</button></div>
                  
              </form>
              </div>
              @else
              <div class="alert alert-warning">You have more than one (1) O'level Results!</div>
              @endif
            </p>
          </div>
          {{-- end edit olevel --}}
        <div id="menu3" class="tab-pane fade">
          <h3>Add UTME Result</h3>
          <p>
            @if(count($jambdetails) > 0)
                <div class="alert alert-warning">You have already entered your UTME Results!</div>
            @else
                <div class="col-lg-6">
                  <form action="{{url('student/AddJamb')}}" method="post">
                    {{csrf_field()}}
                    
                    <div class="col-md-4">
                    <div class="form-group">
                            <label for="examyear">{{ __('Exam Year') }}</label>
                            <select name="examyear" id="examyear" class="form-control">
                                <?php $a=(int) date('Y') - 7; ?>
                            @for($i =(int) date('Y'); $i > $a; $i--)
                            <option value="">{{$i}} </option>
                            @endfor
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                    <div class="form-group">
                            <label for="centreno">{{ __('Centre No.') }}</label>
                            <input type="text" name="centreno" id="centreno" class="form-control" required>
                                
                        </div>
                    </div>
    
                    <div class="col-md-4">
                    <div class="form-group">
                            <label for="regno">{{ __('Registration No.') }}</label>
                            {{-- <input type="text" name="regno" id="regno" class="form-control"> --}}
                            <input id="regno" type="text" class="form-control" {{ $errors->has('regno') ? ' is-invalid' : '' }} name="regno" value="{{ old('regno') }}" required autofocus>
    
                                    @if ($errors->has('regno'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('regno') }}</strong>
                                        </span>
                                    @endif
                        </div>
                    </div>
    
                    <table class="table table-striped">
                    {{-- <tr><td>#</td><td>Subjects</td><td>Grade</td></tr> --}}
                    @for($i = 0; $i < 4; $i++)
                    <tr><td colspan="3">
                    <div class="form-group">
                        <div class="col-md-1">
                        {{-- {{$i+1}} --}}
                        </div>
                        <div class="col-md-1">
                        {{$i+1}}
                        </div>
                        <div class="col-md-5">
                            
                            <select name="subject[]" id="subject" class="form-control">
                                <option value="0">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->Subject}}">{{$subject->Subject}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                                {{-- <input type="text" name="regno" id="regno" class="form-control"> --}}
                                <input placeholder="Enter Score" type="number" class="form-control"  name="score[]" required autofocus>
                        </div>
                    </div>
                    </td>
                </tr>
                    @endfor
                </table>
                    <div class="col-md-2"></div>
                    <div class="col-md-10"><button type="submit" class="btn btn-success">Submit</button></div>
                    
                </form>
                </div>
                @endif
              </p>
        </div>
      </div>

        <hr />

         
       

       

    



</div>

</div>
@endsection
