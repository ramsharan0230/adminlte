@extends('layouts.auth.master')
@section('title','Auth  | Login')
@push('stylesheets')

@endpush
@section('auth-content')
<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Login</b> Aa24Inspect</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form action="{{ route('login') }}" method="POST">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <div class="social-auth-links text-center mb-3 mt-3">
            <div class="row">
                <div class="col-sm-6">
                    <a href="forgot-password.html" style="">I forgot my password</a>
                </div>
                <div class="col-sm-6">
                    <a href="register.html" class="text-center">Register</a>
                </div>
            </div>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection

@push('scripts')

<script type="text/javascript"> 
    
</script>
@endpush
