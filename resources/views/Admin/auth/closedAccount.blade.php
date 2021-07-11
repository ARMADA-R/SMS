<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ !empty($title) ? $title : trans('admin.admin') }}</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a><b>This account has been <div style="color: red;">CLOSED</div> </b></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{ Auth::guard('admin')->user()->name }}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ url('/design/adminLTE') }}/dist/img/user1-128x128.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" id="logout-form" action="{{ url('admin/logout') }}" method="POST">
    @csrf
    <button  class="btn-secondary form-control"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <b> {{ trans('general.logout') }}</b>
    </button>

    </form>

    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    <!-- Enter your password to retrieve your session -->
  </div>

  <div class="text-center">
    <a href="{{route('login')}}">Or sign in as a different user</a>
  </div>
  <div class="lockscreen-footer text-center">
    If you think something was wrong you can contact us on <b><a href="{{route('admin.ContactSupport')}}" class="text-black">Support</a></b><br>

  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="{{ url('/design/adminLTE') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('/design/adminLTE') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
