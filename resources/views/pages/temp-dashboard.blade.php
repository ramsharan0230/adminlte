@extends('layouts.auth.master')
@section('title','Auth  | Register')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
@endpush

@section('auth-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Dashboard') }}</h3>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm float-right">Logout</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="col-md-12">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                          <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
              
                            <p class="text-muted text-center">{{ $user->branch->name }}</p>
              
                            <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                <b>Email</b> <a class="pull-right float-right">{{ $user->email }}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Status</b> <a class="pull-right float-right">{{ ucfirst($user->current_status) }} <i class="fa fa-{{ $user->current_status==="approved"?"check":($user->current_status==="normal"?"ban":"times") }}"></i></a>
                              </li>

                              <li class="list-group-item">
                                <b>Phone</b> <a class="pull-right float-right">{{ ucfirst($user->phone) }} <i class="fa fa-phone"></i></a>
                              </li>
                            </ul>
                          </div>
                          <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript"> 
    
</script>
@endpush