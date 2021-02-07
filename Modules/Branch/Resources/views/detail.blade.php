@extends('layouts.admin.master')
@section('title','Branches')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Branches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Branch</li>
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

              <h3 class="card-title">{{ $branch->name }}</h3>
                <button class="btn btn-primary btn-sm float-right" id="create-new-user"  data-id="{{ $branch->id }}"
                    data-toggle="modal" data-target="#modal-create-user"><i class="fa fa-plus"></i> Add New User</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->get('error'))
                    <div class="alert alert-success">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="row">
                    @include('includes.branch.branch-detail')
                    <div class="col-sm-9">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($branch->users as $key=>$user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm editUser" data-toggle="modal"  
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-branch_id={{ $branch->id }}
                                            data-role_id="{{ $user->role_id }}" data-phone="{{ $user->phone }}" data-current_status="{{ $user->current_status }}"
                                            data-target="#modal-edit-user"><i class="fa fa-user-edit"></i> Edit</a>

                                            @if($user->status ==1)
                                            <a href="{{ route('senioroperationmanager.branch.user.disapprove', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapprove</a>
                                            @else
                                            <a href="{{ route('senioroperationmanager.branch.user.approve', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Approve</a>
                                            @endif
                                            <a href="{{ route('senioroperationmanager.branch.user.delete', $user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"> No Branch Found!!</td>
                                    </tr>
                                @endforelse
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
                    
                </div>
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
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#modal-create-user').modal('show');
        @endif
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

        $('#create-new-user').click(function(){
            var branch_id = $(this).data('id');
            $('#branch_id').val(branch_id)
            var redirectUrl =  'http://127.0.0.1:8000/senioroperationmanager/branch/detail/'+branch_id
            $.ajax({
                url: '/senioroperationmanager/roles',
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $.each(data.data, function (i, item) {
                        $('#role_id').append($('<option>', { 
                            value: item.id,
                            text : item.name 
                        }));
                    });
                },
                error: function(error){
                    console.log(error)
                }
                });
            })
            $('.editUser').click(function(){
                getRoles()
                var id =$(this).data('id');
                var name =$(this).data('name');
                var email =$(this).data('email');
                var phone =$(this).data('phone');
                var role_id =$(this).data('role_id');
                var current_status =$(this).data('current_status');
                var branch_id =$(this).data('branch_id');

                // appending data into inputs fields
                $('#editUserId').val(id)
                $('#name').val(name)
                $('#editEmail').val(email)
                $('#editAddress').val(address)
                $('#editPhone').val(phone)
                $('#editRole_id').val(role_id)
                $('#current_status').val(current_status)
                $('#editBranch_id').val(branch_id)

            })

            function getRoles(){
                $.ajax({
                    url: '/senioroperationmanager/roles',
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        $.each(data.data, function (i, item) {
                            $('#editRole_id').append($('<option>', { 
                                value: item.id,
                                text : item.name 
                            }));
                        });
                    },
                    error: function(error){
                        console.log(error)
                    }
                });
            }
    </script>

  @endpush