<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Reset Password </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('/design/adminLTE') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/design/adminLTE') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('/design/adminLTE') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/design/adminLTE') }}/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('/design/adminLTE') }}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        #message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
        }

        #inner-message {
            margin: 0 auto;
        }
    </style>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    @include('admin.message.error')
    @include('admin.message.success')
    @include('admin.message.info')
    @include('admin.message.warning')
    <div class="login-box">
        <div class="login-logo">
            <a><b>Admins</b> Reset Password</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Reset admin account Password</p>
            <form action=" {{ AdminUrl('password/reset') }} " method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="new Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary ">Reset Password</button>

                        <a href="{{ route('admin.login') }}" class="btn btn-secondary  "> {{trans('app.login')}}</a>
                    </div>
                    <!-- /.col -->
                </div>

            </form>
        </div>
        <!-- /.login-box-body -->

    </diSv>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ url('/design/adminLTE') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('/design/adminLTE') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ url('/design/adminLTE') }}/plugins/iCheck/icheck.min.js"></script>
</body>

</html>
