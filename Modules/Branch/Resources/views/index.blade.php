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
              <li class="breadcrumb-item active">Branches</li>
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
              <h3 class="card-title">All Branches</h3>
                <a href="{{ route('senioroperationmanager.branch.create') }}" class="btn btn-primary btn-sm float-right" 
                    data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Add</a>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>SN.</th>
                    <th>Branch Name</th>
                    <th>Main Office</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Fax</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($branches as $key=>$branch)
                <tr>
                    <?php //dd($branch->mainOffice->name) ?>

                    <td>{{ $key+1 }} <strong style="color:green;"><i class="fa fa-check-double"></i></strong></td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->mainOffice->name }}</td>
                    <td>{{ $branch->address }}</td>
                    <td>{{ $branch->phone }}</td>
                    <td>{{ $branch->email }}</td>
                    <td>{{ $branch->fax }}</td>
                    <td>
                        @if($branch->status==1)
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Disapproved</span>
                        @endif
                    </td>
                    <td>
                        @if($branch->status ==1)
                        <a href="{{ route('senioroperationmanager.branch.disapprove', $branch->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-times-circle"></i> Disapprove</a>
                        @else
                        <a href="{{ route('senioroperationmanager.branch.approve', $branch->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Approve</a>
                        @endif

                        <a href="#" class="btn btn-primary btn-sm editBranch" data-id="{{ $branch->id }}" data-name="{{ $branch->name }}" data-email="{{ $branch->email }}"
                            data-phone="{{ $branch->phone }}" data-address="{{ $branch->address }}" data-main_office_id="{{ $branch->mainOffice->id }}"
                            data-fax="{{ $branch->fax }}" data-toggle="modal" data-target="#modal-edit-branch"><i class="fa fa-edit"></i> Edit</a>
                        
                        <a href="{{ route('senioroperationmanager.branch.detail', $branch->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Detail</a>
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
                  <th>Branch Name</th>
                  <th>Main Office</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Fax</th>
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
    @include('includes.branchModel')
    @include('includes.editBranch')
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
    </script>
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#modal-lg').modal('show');
        @endif
    </script>
    <script>
        $('.editBranch').click(function(){
            $('#editName').val($(this).data('name'))
            $('#editPhone').val($(this).data('phone'))
            $('#editAddress').val($(this).data('address'))
            $('#editEmail').val($(this).data('email'))
            $('#editId').val($(this).data('id'))
            $('#editMainOfficeId').val($(this).data('main_office_id'))
            $('#editEditFax').val($(this).data('fax'))
            debugger
        })
    </script>
  @endpush