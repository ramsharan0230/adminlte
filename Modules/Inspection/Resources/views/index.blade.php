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
              <h3 class="card-title">Inspection Lists</h3>
              <a href="{{ route('inspection.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>  Add</a>
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
                    
                @forelse($inspections as $key => $inspection)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $inspection->location }}</td>
                    <td>{{ $inspection->start_date }}</td>
                    <td>{{ $inspection->findings }}</td>
                    <td>
                      <?php 
                          $image = count($inspection->pictures)>0?$inspection->pictures[0]->name:"photo1.png";
                        ?>
                        <button type="button" class="btn btn-default slider" data-toggle="modal" data-target="#modal-default" data-id="{{ $inspection->id }}">
                          <img src="{{ asset('images/inspection_file/pictures').'/'.$image }}" width="100" alt="">
                        </button>
                    </td>
                    <td>{{ $inspection->pca }}</td>
                    <td>{{ $inspection->accountibility }}</td>
                    <td>{{ $inspection->status==1?"Open":"Close" }}</td>
                    <td>{{ $inspection->closing_date }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="9">No inspection found!!</td>
                </tr>
                @endforelse
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
            <form action="{{ route('inspection.picture.add') }}" method="GET">
              <div class="modal-header">
                <h4 class="modal-title">Pictures</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="inspection" name="inspection_id">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators"></ol>
                      <div class="carousel-inner"> </div>
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Picture</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  @endsection

  @push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    
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
        //href="{{ route('inspection.picture.add', 1) }}"
    </script>
  @endpush