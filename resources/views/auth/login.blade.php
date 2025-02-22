<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex,nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Admin</title>
  <link rel="icon" type="image/x-icon" href="{{asset('ui/images/favicon.png')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('ui/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('ui/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('ui/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page" style="background-image:url('{{asset('ui/images/wallpaper.jpg')}}');background-repeat:no-repeat;background-size:cover;opacity:0.93">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-secondary">
    <div class="card-header text-center">
        <img src="{{asset('ui/images/ironmaidenwide.png')}}" alt="Wide Logo" width="80%" style="opacity: 0.9">
    </div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-secondary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-ban"></i> Error!</h5>
          {{ $errors->first() }}
        </div>
      @endif
      <form action="{{ route('login') }}" method="post" autocomplete=off>
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-secondary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="#">Lupa password</a>
      </p> --}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('ui/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('ui/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('ui/dist/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
      console.log('');
  });
</script>
</body>
</html>
