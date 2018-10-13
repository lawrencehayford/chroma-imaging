<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CHROMA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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

            @keyframes flickerAnimation {
              0%   { opacity:1; }
              50%  { opacity:0; }
              100% { opacity:1; }
            }
            @-o-keyframes flickerAnimation{
              0%   { opacity:1; }
              50%  { opacity:0; }
              100% { opacity:1; }
            }
            @-moz-keyframes flickerAnimation{
              0%   { opacity:1; }
              50%  { opacity:0; }
              100% { opacity:1; }
            }
            @-webkit-keyframes flickerAnimation{
              0%   { opacity:1; }
              50%  { opacity:0; }
              100% { opacity:1; }
            }

            .animate-flicker {
               -webkit-animation: flickerAnimation 10s infinite;
               -moz-animation: flickerAnimation 10s infinite;
               -o-animation: flickerAnimation 10s infinite;
                animation: flickerAnimation 10s infinite;
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
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
            <div class="animate-flicker"><img src="{{asset('images/logo.png')}}" width='150' ></div>




            </div>
        </div>
    </body>
</html>
