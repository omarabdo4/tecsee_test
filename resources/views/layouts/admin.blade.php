<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Tecsee-Test') }}</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="{{asset('css/fa/css/all.min.css')}}">

  <!-- CSS Files -->
  <link href="{{asset('css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />

  @stack('css')
</head>

<body class="">
  <div class="wrapper ">
    @include('partials.sidebar')
    <div class="main-panel">
      @include('partials.navbar')
      <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/material-dashboard.min.js?v=2.1.0')}}" type="text/javascript"></script>
  @stack('js')
</body>

</html>