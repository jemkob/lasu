@extends('adminlte::page')
@section('content')
<style type="text/css">
  @media print
  {
  .noprint {display:none;}
  }
  
  @media screen
  {
  
  }
  .topbottomborder 
  {
    border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
  
  </style>
<div class="box">
  <div class="box-header with-border noprint">
    <h3 class="box-title">Uploaded Score</h3>
  </div>
    <div class="box-body">
            <div class="row noprint">
                    <div class="col-sm-12">
                      <form action="{{url('uploadedscoreslevel')}}" method="post">
                        {{csrf_field()}}
                <table>
                    <tr>
                        <td>Session</td><td>Level</td><td>Semester</td>
                        
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="sessions" id="sessions">
                                    <option value="0" disable="true" selected="true">-- Select Session --</option>
                                    @foreach ($sessions as $key => $value)
                                        <option value="{{$value->SessionID}}">{{ $value->SessionYear }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="level" id="level">
                            <option value="0" disable="true" selected="true">-- Select Level --</option>
                            <option value="100">100</option> 
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                            </select>
                        </td>
                        <td> 
                            <select class="form-control" name="semester" id="semester">
                            <option value="0" disable="true" selected="true">-- Select Semester --</option>
                            <option value="1">1st Semester</option> 
                            <option value="2">2nd Semester</option>
                            </select>
                        </td>
                        <td><button class="btn btn-primary" type="submit">Get Results</button></td>
                    </tr>
                </table>
                       <div class="col-md-6">
                                
                            </div>
                      </form>
                    </div>
                  </div>
                  <p></p>
                  <p></p>
        
                  @if(isset($uploadedscore))
                  @if(count($uploadedscore) > 0)
                  <table width="70%" border="0" class="table table-responsive">
                        <tr style="text-transform: uppercase; font-weight: bold;">
                          
                          <td>Course Code</td>
                          <td>Lecturer</td>
                          <td>Subj.Comb</td>
                          <td>Total Registered</td>
                          <td>Total zero score</td>
                          
                          
                        </tr>
                        <?php 
                        $thescores = collect($uploadedscore);
                        $thescores->all();
                        $withscore = $thescores->where('examca', '>', 0);
                        $withoutscore = $thescores->where('examca', '<', 0);
                        ?>
                        
                        @foreach($thescores as $score)
                        <tr>
                          
                          <td>{{$score->subjectcode}}</td>
                          <td>{{$score->surname.' '.$score->firstname}}</td>
                          <td>{{$score->program}}</td>
                          <td>{{$allcourse->where('subjectid', $score->subjectid)->first()->total}}</td>
                          <td>{{$score->total}}</td>
                          
                          
                        </tr>
                        @endforeach
                      </table>
                  
                   
                  
                     

                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                  @else
                      <p>Student Resultslip Not Found. </p>
                  @endif
                  @endif
    </div>

</div>


@endsection