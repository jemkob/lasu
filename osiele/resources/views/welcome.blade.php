<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FCE OSIELE</title>

        <!-- Fonts -->
        <!-- Latest compiled and minified CSS -->
        <script src="{{asset('jscss/jquery.min.js')}}"></script>
        <script src="{{asset('jscss/bootstrap.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('jscss/googlefont.css')}}?family=Raleway:100,600">

<link rel="stylesheet" href="{{asset('jscss/bootstrap-theme.min.css')}}">
<link rel="stylesheet" href="{{asset('jscss/bootstrap.min.css')}}">


<!-- Optional theme -->


<!-- Latest compiled and minified JavaScript -->
<script src="{{asset('jscss/bootstrap.min.js')}}"></script>

        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background: url("images/school-background-image.jpg") repeat-x;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        {{-- <a href="{{ route('login') }}">Login</a> --}}
                        
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="font-size: 39px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LAGOS STATE UNIVERSITY,
                     SCHOOL PORTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

            <div class="row">
                        <div class="col-6 col-lg-4 bg-warning animate-in-down animate-in-done">
                          <a href="{{URL::current()}}/students/login">
                            <h3 class="m-b-md"><b class="text-dark">Student Login</b></h3>
                          </a>
                        </div>
                        <div class="col-6 col-lg-4 bg-info animate-in-down animate-in-done">
                            <a href="{{URL::current()}}/lecturers/login">
                            <h3 class="m-b-md"><b>Lecturer Login</b></h3>
                          </a>
                        </div>
                        <div class="col-6 col-lg-4 bg-danger animate-in-down animate-in-done">
                            <a href="{{URL::current()}}/login">
                            <h3 class="m-b-md"><b>Admin Login</b></h3>
                          </a>
                        </div>
                        
                      </div>
                      
                      <br>

                      <div class="row">
                        <div class="col-6 col-lg-4 bg-warning animate-in-down animate-in-done">
                          <a href="https://lasuextra.fceportal.com:4443/students/login">
                            <h3 class="m-b-md"><b class="text-dark">Extra Year Student Login</b></h3>
                          </a>
                        </div>
                        
                        
                      </div>

                
                
            </div>
        </div>
    </body>
</html>
