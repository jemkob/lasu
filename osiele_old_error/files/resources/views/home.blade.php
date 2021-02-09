@extends('adminlte::page')

@section('content')
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Welcome</h3>
        </div>
        <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>{{count($allstudents)}}</h3>
        
                      <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>{{count($faculty)}}</h3>
        
                      <p>Schools</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-institution"></i>
                    </div>
                    
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{count($lecturers)}}</h3>
        
                      <p>Lecturers</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>{{count($admins)}}</h3>
        
                      <p>Admin</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-gear"></i>
                    </div>
                    
                  </div>
                </div>
                <!-- ./col -->
              </div>

              <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>{{count($alldept)}}</h3>
            
                          <p>Departments</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-building"></i>
                        </div>
                        
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>{{count($allcourses)}}</h3>
            
                          <p>Courses</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-file-text-o"></i>
                        </div>
                        
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>{{count($males)}}</h3>
            
                          <p>Males</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-male"></i>
                        </div>
                        
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>{{count($females)}}</h3>
            
                          <p>Females</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-female"></i>
                        </div>
                        
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>

          <div class="box-body table-responsive">

                
      
          </div>
      
      </div>


@endsection


