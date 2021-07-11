<!-- Main Footer -->
<footer class="main-footer">
    <!-- <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div> -->
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ url('/design/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>

<!-- Lazy Load -->
<script src="{{ url('/design/AdminLTE') }}/plugins/lazyload/lazyload.js"></script>

<!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->


<!-- Bootstrap -->
<script src="{{ url('/design/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="{{ url('/design/AdminLTE') }}/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="{{ url('/design/AdminLTE') }}/plugins/chart.js/Chart.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ url('/design/AdminLTE') }}/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ url('/design/AdminLTE') }}/dist/js/pages/dashboard3.js"></script> -->


<script>
    $("img.lazyload").lazyload();
</script>

@stack('scripts')
</body>

</html>
