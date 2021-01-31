@extends('layouts.admin.master')
@section('title','Inspections')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-slider/css/bootstrap-slider.min.css') }}">
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inspections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Inspections</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN.</th>
                  <th>Location</th>
                  <th>Starting Date</th>
                  <th>Findings</th>
                  <th>Pictures</th>
                  <th>Protective Corrective Actions</th>
                  <th>Accountibility</th>
                  <th>Status</th>
                  <th>Closing Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = [0=>1, 1=>1, 2=>1, 3=>1, 4=>1, 5>1, 6=>1, 7=>1, 8=>1, 9=>1, 10=>1, 
                    11=>1, 12=>1 ,13=>1, 14=>1, 15=>1, 16=>1, 18=>1, 19=>1, 20=>1, 21=>1, 22=>1, 23=>1] ?>
                @foreach($i as $key => $p)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>Khalifa Kitchen</td>
                    <td>2021-02-01</td>
                    <td>The Hand climber has been found in the kitchen room . The handle has been broken. watch it and maintain it.</td>
                    <td>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                            <img src="{{ asset('dist/img/photo1.png') }}" width="100" alt="">
                        </button
                    </td>
                    <td>The Hand climber has been found in the kitchen room . The handle has been broken. watch it and maintain it</td>
                    <td>Store</td>
                    <td>Open</td>
                    <td>2021-02-01</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>SN.</th>
                    <th>Location</th>
                    <th>Starting Date</th>
                    <th>Findings</th>
                    <th>Pictures</th>
                    <th>Protective Corrective Actions</th>
                    <th>Accountibility</th>
                    <th>Status</th>
                    <th>Closing Date</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
      <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pictures</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('dist/img/photo1.png') }}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('dist/img/photo2.png') }}" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('dist/img/photo3.jpg') }}" alt="Third slide">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="row">
                    <button type="button" class="btn btn-default float-right pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  @endsection

  @push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!-- Bootstrap slider -->
<script src="{{ asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()

    /* ION SLIDER */
    $('#range_1').ionRangeSlider({
      min     : 0,
      max     : 5000,
      from    : 1000,
      to      : 4000,
      type    : 'double',
      step    : 1,
      prefix  : '$',
      prettify: false,
      hasGrid : true
    })
    $('#range_2').ionRangeSlider()

    $('#range_5').ionRangeSlider({
      min     : 0,
      max     : 10,
      type    : 'single',
      step    : 0.1,
      postfix : ' mm',
      prettify: false,
      hasGrid : true
    })
    $('#range_6').ionRangeSlider({
      min     : -50,
      max     : 50,
      from    : 0,
      type    : 'single',
      step    : 1,
      postfix : '°',
      prettify: false,
      hasGrid : true
    })

    $('#range_4').ionRangeSlider({
      type      : 'single',
      step      : 100,
      postfix   : ' light years',
      from      : 55000,
      hideMinMax: true,
      hideFromTo: false
    })
    $('#range_3').ionRangeSlider({
      type    : 'double',
      postfix : ' miles',
      step    : 10000,
      from    : 25000000,
      to      : 35000000,
      onChange: function (obj) {
        var t = ''
        for (var prop in obj) {
          t += prop + ': ' + obj[prop] + '\r\n'
        }
        $('#result').html(t)
      },
      onLoad  : function (obj) {
        //
      }
    })
  })
</script>
    
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            });
        });
    </script>
  @endpush