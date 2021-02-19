@extends('layouts.admin.master')
@section('title','Users | Site Managers')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
              <h3 class="card-title">All Hygienes <button class="btn btn-primary btn-sm"><i class="fa fa-home"></i> {{ $branch->name }}</button></h3>
              <button class="btn btn-primary btn-sm float-right userCreateModal" data-toggle="modal" data-target="#modal-create-user" 
              data-branch_id="{{ $branch->id }}" data-branch_name="{{ $branch->name }}">
                <i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN.</th>
                  <th>Name </th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{ $key+1 }}. <i style="color:{{ $user->current_status=='approved'?'green':($user->current_status=='suspended'?'red':'gray') }}" 
                      class="fa fa-{{ $user->current_status=='approved'?'check':($user->current_status=='suspended'?'times':'ban') }}"></i></td>
                    <td>{{ $user->name }} </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td><span class="badge badge-{{ $user->current_status=='approved'?'success':($user->current_status=='suspended'?'danger':'primary') }}">
                      {{ $user->current_status=='approved'?'Approved':($user->current_status=='suspended'?'Suspended':'Normal') }}</span>
                    </td>
                    <td>
                      @if($user->current_status =='normal')
                      <a href="{{ route('sitemanager.user.approve', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-times"></i> Approve</a>
                      <a href="{{ route('sitemanager.user.disapprove', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Suspend</a>
                      @elseif($user->current_status =='suspended')
                      <a href="{{ route('sitemanager.user.approve', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-times"></i> Approve</a>
                      <a href="{{ route('sitemanager.user.normalize', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> Normalize</a>
                      @else
                      <a href="{{ route('sitemanager.user.disapprove', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Suspend</a>
                      <a href="{{ route('sitemanager.user.normalize', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> Normalize</a>
                      @endif
                      <a href="{{ route('sitemanager.user.delete', $user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                      <a href="" class="btn btn-primary btn-sm userDetail" data-toggle="modal" data-target="#modal-edit-user" 
                        data-user_id="{{ $user->id }}" data-user_name="{{ $user->name }}" data-user_status="{{ $user->status }}" data-user_branch_id="{{ $user->branch_id }}"
                        data-user_email="{{ $user->email }}" data-user_phone="{{ $user->phone }}" data-user_role_id="{{ $user->role_id }}">
                        <i class="fa fa-indent"></i> Edit</a>
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
    
    @include('includes.branch.createUserModel')
    @include('includes.branch.editUserModel')
  @endsection

  @push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    
    <script>
        @if(count($errors) > 0)
            $('#modal-create-user').modal('show');
        @endif
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

        $('.userCreateModal').click(function(){
            $('#branch_id').val($(this).data('branch_id'))
        })

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