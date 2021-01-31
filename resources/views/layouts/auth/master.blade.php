<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aa24Inspect - @yield('title')</title>
    <meta name="description" content="Baguatte Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon-precomposed" href="https://baguette-uae.com/wp-content/uploads/2019/12/Baguette_favicon.png">
    <link rel="icon" href="{{ asset('dist/img/avatar.png') }}" type="image/png">

     <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset('fonts.googleapis.com/css610e.css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
    @stack('stylesheets')
</head>
<body class="hold-transition register-page">
    
    @yield('auth-content')
           
    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
