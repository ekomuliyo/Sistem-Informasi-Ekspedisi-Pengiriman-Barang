<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PT Bunga Lintas Cargo | Login</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/blog-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/blog-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/blog-admin/css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="bg-dark" background="/images/background_2.jpg" style="background-size:cover;">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header text-center">
        <img src="/images/logo.jpeg" alt="PT Bunga Lintas Cargo" width="100px" height="100px">
        <h2>PT Bunga Lintas Cargo</h2></div>
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">Alamat E-Mail </label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary btn-block" type="submit">Masuk</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/blog-admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/blog-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/blog-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
</body>

</html>
