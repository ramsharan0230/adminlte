<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Aa24Inspect - @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{  asset('fonts.googleapis.com/css610e.css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
  @stack('stylesheets')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('includes.navs')
        @include('includes.aside')
        <div class="content-wrapper">
            @yield('content')
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>


        @include('includes.footer')
    </div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
<script>
    $('.slider').click(function(){
          $('#inspection').val($(this).data('id'))

          $.ajax({
            url: '/inspection/picture/slider/'+$(this).data('id'),
            type: "GET",
            dataType: 'json',
            success: function (data) {
              $('.carousel-indicators').empty();
              $('.carousel-inner').empty();
              for(var i=0; i<data.data.length; i++){
                if(i ==0)
                  $('.carousel-indicators').append("<li data-target='#carouselExampleIndicators' data-slide-to="+i+" class='active'></li>")
                else
                  $('.carousel-indicators').append("<li data-target='#carouselExampleIndicators' data-slide-to="+i+"></li>")
              }

              $.each(data.data, function(index, item) {
                  //now you can access properties using dot notation
                  if(index ==0)
                    $('.carousel-inner').append("<div class='carousel-item active'><img class='d-block w-100' src='images/inspection_file/pictures/"+item['name']+"' ></div>")
                  else 
                   $('.carousel-inner').append("<div class='carousel-item'><img class='d-block w-100' src='images/inspection_file/pictures/"+item['name']+"' ></div>")

              });
                // if(data.data.status == 200){
                //   // window.location.href=redirectUrl;
                // }
              },
              error: function(error){
                console.log(error)
              }
            })
        })
</script>
</body>
@stack('scripts')
<!-- Mirrored from adminlte.io/themes/dev/AdminLTE/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Jan 2021 08:54:56 GMT -->
</html>
