<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CHROMA') }}</title>

    <!-- Scripts -->
    <!--  <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
  	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jspdf.min.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/editor.css') }}">
    <script type="text/javascript" src="{{ asset('js/editor.js') }}"></script>
    <script src="{{ asset('js/papaparse.js') }}"></script>


  <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script>
    $(document).ready(function() {
            $("#txtEditor").Editor();
          });
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    body {
      background: #e2e1e0;
      text-align: center;
      font-size: 14px;
      zoom:95%;
    }
    select{
      min-height: 30px;
     font-size: 34px;
    }
    .cardv {
      background: #fff;
      border-radius: 2px;
      display: inline-block;
      min-height: 50px;
      position: relative;
      padding: 10px;
    }
    .card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  margin-bottom: 10px;
      }
      table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
      }

      td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
      }

      tr:nth-child(even) {
          background-color: #dddddd;
      }
      /*
      .card-1:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
      }*/

      .loader {
        border: 4px solid #f3f3f3;
        border-radius: 50%;
        border-top:4px solid #3498db;
        width: 40px;
        height: 40px;
        -webkit-animation: spin 0.4s linear infinite; /* Safari */
        animation: spin 0.4s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .count-input {
      position: relative;
      width: 100%;
      max-width: 165px;
      margin: 10px 0;
    }
    .count-input input {
      width: 100%;
      height: 29.92307692px;
      border: 1px solid #b0b2b4;
      border-radius: 2px;
      background: none;
      text-align: center;
    }
    .count-input input:focus {
      outline: none;
    }
    .count-input .incr-btn {
      display: block;
      position: absolute;
      width: 30px;
      height: 30px;
      font-size: 26px;
      font-weight: 300;
      text-align: center;
      line-height: 30px;
      top: 50%;
      right: 0;
      margin-top: -15px;
      text-decoration:none;
    }
    .count-input .incr-btn:first-child {
      right: auto;
      left: 0;
      top: 46%;
    }
    .count-input.count-input-sm {
      max-width: 125px;
    }
    .count-input.count-input-sm input {
      height: 36px;
    }
    .count-input.count-input-lg {
      max-width: 200px;
    }
    .count-input.count-input-lg input {
      height: 70px;
      border-radius: 3px;
    }

    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{asset('images/logo.png')}}" width='30' > {{ config('app.name', 'chroma') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@yield('script')
</html>
