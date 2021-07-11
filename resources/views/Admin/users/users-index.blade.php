@extends('Admin.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{trans('app.users.title')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ $dataTable->table([
                    "class" => "table table-striped datatable table-hover responsive",
                    "style" => ""
                        ])
                    }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->



@push('scripts')

{!! $dataTable->scripts() !!}

<script src="{{ url('/design/AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{url('/')}}/js/datatables/dataTables.buttons.min.js"></script>
<script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>

<script>
    // var oTable = $('#users-table').DataTable({
    //     dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
    //         "<'row'<'col-xs-12't>>"+
    //         "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: <?php echo url(''); ?>,
    //         data: function (d) {
    //             d.name = $('input[name=name]').val();
    //             d.email = $('input[name=email]').val();
    //         }
    //     },
    //     columns: [
    //         {data: 'name', name: 'name'},
    //         {data: 'email', name: 'email'},
    //         {data: 'created_at', name: 'created_at'},
    //         {data: 'updated_at', name: 'updated_at'}
    //     ]
    // });

    // $('#search-form').on('submit', function(e) {
    //     oTable.draw();
    //     e.preventDefault();
    // });
</script>

@endpush

@push('style')
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/css/datatables/buttons.dataTables.min.css">

<style>
    /* .custom-clickable-row {
        cursor: pointer;
    } */
</style>
@endpush
@endsection


<!-- <script type="text/javascript">
$(function(){window.LaravelDataTables=window.LaravelDataTables||{};
window.LaravelDataTables["users-table"]=$("#users-table").DataTable({
    "serverSide":true,
    "processing":true,
    "ajax":{"url":"http:\/\/127.0.0.1:8080\/admin\/admins\/management",
        "type":"GET",
        "data":function(data) {
                for (var i = 0, len = data.columns.length; i < len; i++) {
                    if (!data.columns[i].search.value) delete data.columns[i].search;
                    if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                    if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                    if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
                }
                delete data.search.regex;}},
                "columns":[{"data":"action","name":"action","title":"Action",
                    "orderable":false,
                    "searchable":false,
                    "width":60,
                    "className":"text-center"},
                    {"data":"id",
                        "name":"id",
                        "title":"Id",
                        "orderable":true,
                        "searchable":true},

                    {   "data":"email",
                        "name":"email",
                        "title":"Email",
                        "orderable":true,
                        "searchable":true
                    },

                    {   "data":"created_at",
                        "name":"created_at",
                        "title":"Created At",
                        "orderable":true,
                        "searchable":true
                    },
                    {   "data":"updated_at",
                        "name":"updated_at",
                        "title":"Updated At",
                        "orderable":true,
                        "searchable":true}],
                    "dom":"Bfrtip",
                    "order":[[1,
                    "desc"]],
                    "buttons":[{"extend":"create"},
                    {"extend":"export"},
                    {"extend":"print"},
                    {"extend":"reset"},
                    {"extend":"reload"}]});});
    </script> -->
