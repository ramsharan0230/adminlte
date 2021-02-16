@extends('layouts.admin.master')
@section('title','Inspections')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
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
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Hygienes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>SN.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Phone</th>
                      <th>Current Status</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                    <tr>
                        <td>{{ $key+1 }}. <strong><i class="fa fa-{{  $user->current_status === "approved" ? "check" : ($user->current_status ==="normal" ? "ban":"times") }}"></i></strong></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td><span class="badge badge-{{  $user->current_status === "approved" ? "success" : ($user->current_status ==="normal" ? "warning":"danger") }}"> {{ $user->current_status }}</span> </td>
                        <td>{{ $user->status==1?"Active":"Inactive" }}</td>
                        <td>
                            @if(Auth::user()->id == $user->id)
                                <a href="#" class="btn btn-primary btn-sm editUser" data-toggle="modal" data-target="#editUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" 
                                  data-email="{{ $user->email }}" data-role_id="{{ $user->role->id }}" data-phone="{{ $user->phone }}"
                                  data-status="{{ $user->status }}" data-branch_id="{{ $user->branch_id }}"><i class="fa fa-edit"></i> Edit</a>
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
                      <th>Current Status</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
      <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="editUserModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="form" action="{{ route('hygiene.user.update') }}" method="POST">
              @csrf
              <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12">
                          @if ($errors->any())
                              @foreach ($errors->all() as $error)
                                  <div class="alert alert-danger">{{$error}}</div>
                              @endforeach
                          @endif
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <input type="hidden" name="user_id" id="editUserId">
                              <label for="fullname">Name</label>
                              <input type="text" class="form-control form-control-sm" id="name" name="fullname" placeholder="Name..." value="{{ old('fullname') }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="editRole_id">Roles</label>
                              <select name="role_id" id="editRole_id" class="form-control form-control-sm" >
                                  <option value="" disabled selected> Choose Role</option>
                                  <option value="1"> Hygiene</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="editPhone">Phone</label>
                              <input type="text" id="editPhone" class="form-control form-control-sm" name="phone" placeholder="Phone..." value="{{ old('phone') }}">
                          </div>
                      </div>
  
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="editEmail">Email</label>
                              <input type="text" class="form-control form-control-sm" id="editEmail" name="email" placeholder="Email..." value="{{ old('email') }}">
                          </div>
                      </div>
                  </div>
  
                  <div class="row">
                      <input type="hidden" name="branch_id" id="editBranch_id">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Passwored..." value="{{ old('password') }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="password_confirmation">Conform Password</label>
                              <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Conform Password..." value="{{ old('password_confirmation') }}">
                          </div>
                      </div>
                  </div>
                  
              </div>
              <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
  
    @endsection

  @push('scripts')
  
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    
    <script>
      @if(count($errors)>0)
        $('#editUserModal').modal('show')
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
            'responsive': true
            });
        });

        $('.editUser').click(function(){
          $('#editUserId').val($(this).data('id'))
          $('#name').val($(this).data('name'))
          $('#editRole_id').val($(this).data('role_id'))
          $('#editPhone').val($(this).data('phone'))
          $('#editEmail').val($(this).data('email'))
          $('#editBranch_id').val($(this).data('branch_id'))
        })
    </script>
  @endpush