@include("Admin.layouts.header")
@include("Admin.layouts.navbar")
@include("Admin.layouts.sidebar")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        @include('admin.message.message')

        @yield('content')


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include("Notifications.admin-notifications-script")
@include("Admin.layouts.footer")
