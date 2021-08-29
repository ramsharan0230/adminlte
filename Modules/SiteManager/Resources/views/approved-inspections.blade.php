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
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    
                @forelse($inspections as $key => $inspection)
                <tr>
                    <td>
                      {{ $key+1 }}
                      @if($inspection->approvedBy_siteman==1)
                        <br><i class="fa fa-check" style="color:green"></i>
                      @else
                        <br><i class="fa fa-times-circle" style="color:red" aria-hidden="true"></i>
                      @endif
                    </td>
                    <td>{{ $inspection->location }}</td>
                    <td>{{ $inspection->start_date }}</td>
                    <td>{{ $inspection->findings }}</td>
                    <td>
                      <?php 
                          $image = count($inspection->pictures)>0?$inspection->pictures[0]->name:"photo1.png";
                        ?>
                        <button type="button" class="btn btn-default slider" data-toggle="modal" data-target="#modal-image-slider" data-id="{{ $inspection->id }}">
                          <img src="{{ asset('images/inspection_file/pictures').'/'.$image }}" width="100" alt="">
                        </button>
                    </td>
                    <td>{{ $inspection->pca }}</td>
                    <td>{{ $inspection->accountibility }}</td>
                    <td>{{ $inspection->status==1?"Open":"Close" }}</td>
                    <td>{{ $inspection->closing_date }}</td>
                    <td>
                      @if($inspection->approvedBy_siteman==1)
                        <button class="btn btn-warning btn-sm postReview" data-toggle="modal" data-target="#un-approve-modal" data-id="{{ $inspection->id }}">UnApprove</button>
                      @else
                          <a href="{{ route('sitemanager.approve', $inspection->id) }}" class="btn btn-primary btn-sm"> Approve</a>
                      @endif
                        <button class="btn btn-secondary btn-sm reviewList mt-1" data-toggle="modal" data-target="#review-list-modal" data-id="{{ $inspection->id }}">Reviews  <span class="badge badge-light">{{ count($inspection->reviews) }}</span></button>
                    </td>
                </tr>
                @empty
                <tr>
                  <td colspan="10">No inspection found!!</td>
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
                    <th>Actions</th>
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
    @include('includes.un-approve-modal')
    @include('includes.review-list-modal')
    @include('includes.modal-image-slider')
  @endsection

  @push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('dist/js/moment.min.js') }}"> </script>
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
      $('.postReview').click(function(){
        $('#inspection_id').val($(this).data('id'))
      })

      $('.reviewList').click(function(){
        $.ajax({
            type: 'GET',
            url: '/sitemanager/review-list/'+$(this).data('id'),
            success: function(data){
              $(".reviews").empty()
              if(data.length>0){
                $.each( data, function( key, value ) {
                  $(".reviews").append('\
                    <div class="col-sm-12">\
                      <div class="alert alert-primary" role="alert" style="padding: 10px">\
                        <span>'+value.comments+'</span>\
                        <p class="float-right datatime"> '+formatDate(value.created_at)+'</p>\
                      </div>\
                    </div>')
                });
              }else{
                $(".reviews").append('<p>No Review Found!!</p>')
              }
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
      })

      function formatDate(date){
        let tanggal = moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD MMMM, YYYY');
        return tanggal;
      }
      
    </script>
  @endpush