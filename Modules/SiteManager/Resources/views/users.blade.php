@extends('layouts.admin.master')
@section('title','Site Managers')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Site Managers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Site Managers</li>
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
              <h3 class="card-title">All Site Managers </h3>
              <button class="btn btn-primary btn-sm float-right"><i class="fa fa-home"></i> {{ $branch->name }}</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Phone</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{ $key+1 }}. 
                      <i style="color: {{ $user->current_status=='approved'?'green':($user->current_status=='suspended'?'red':'gray') }}" class="fa fa-{{ $user->current_status=='approved'?'check':($user->current_status=='suspended'?'times':'ban') }}"></span>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                      <span class="badge badge-{{ $user->current_status=='approved'?'success':($user->current_status=='suspended'?'danger':'primary') }}">
                        {{ $user->current_status=='approved'?'Approved':($user->current_status=='suspended'?'Suspended':'Normal') }}</span>
                      @if(Auth::user()->id == $user->id)
                      <a href="" class="btn btn-primary btn-sm userDetail" data-toggle="modal" data-target="#modal-edit-user" 
                        data-user_id="{{ $user->id }}" data-user_name="{{ $user->name }}" data-user_status="{{ $user->status }}" data-user_branch_id="{{ $user->branch_id }}"
                        data-user_email="{{ $user->email }}" data-user_phone="{{ $user->phone }}" data-user_role_id="{{ $user->role_id }}">
                        <i class="fa fa-indent"></i> Edit</a>
                      @endif  
                    </td>
                    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>SN.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Phone</th>
                  <th>Status</th>
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
    @include('includes.branch.editUserModel')
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

        $('.userDetail').click(function(){
            var id = $(this).data('user_id')
            var user_name = $(this).data('user_name')
            var user_status = $(this).data('user_status')
            var user_email = $(this).data('user_email')
            var user_phone = $(this).data('user_phone')
            var user_role_id = $(this).data('user_role_id')
            var user_branch_id = $(this).data('user_branch_id')
            $('#editUserId').val(id)
            $('#name').val(user_name)
            $('#editRole_id').val(user_role_id)
            $('#editPhone').val(user_phone)
            $('#editEmail').val(user_email)
            $('#editBranch_id').val(user_branch_id)
            $('#editStatus').val(user_status)
        })
    </script>
  @endpush