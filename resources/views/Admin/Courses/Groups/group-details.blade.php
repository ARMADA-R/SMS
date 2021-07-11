@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title">{{ trans('app.title.group-details')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- checkbox -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <h3>{{ $group->name }}</h3>
                                    <p>{{ $group->season }}</p>
                                </div>
                                <div class="col">
                                    <p>{{ $group->teacher }}</p>

                                    <p>
                                        {{ $group->day .' : '.  $group->start .' - '. $group->end }}
                                    </p>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.created-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $group->created_at ))->format('Y-m-d H:i')}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.updated-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $group->updated_at ))->format('Y-m-d H:i')}}
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-sm-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">{{ trans('app.courses.group.students')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped datatable table-hover responsive dataTable  no-footer dtr-inline" id="course-group-table" role="grid" aria-describedby="course-group-table_info">
                    <thead>
                        <tr role="row">
                            <th class="text-center" title="#">#</th>
                            <th title="first_name">first_name</th>
                            <th title="last_name">last_name</th>
                            <th title="father_name">father_name</th>
                            <th title="level">level</th>
                            <th class="text-center" title="action">action</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->




@push('scripts')

<script src="{{ url('/design/AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/js/datatables/dataTables.buttons.min.js"></script>
<script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/design/AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> -->
<script>
    $(function() {
        $('#course-group-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            dom: 'lBfrtip',
            buttons: [{
                text: '<i class=\"fas fa-plus-circle\"><\/i> Add students',
                className: "btn-info",
                action: function(e, dt, node, config) {
                    window.location.href = "{{ route('admin.course.group.student.add-students', $group->id ) }}";
                },
            }, {
                "extend": "print",
                "className": "btn-info",
                "text": " <i class=\"fas fa-print\"><\/i> Print"
            }, {
                "extend": "reset",
                "className": "btn-info",
                "text": " <i class=\"fas fa-redo\"><\/i> Reset"
            }, {
                "extend": "reload",
                "className": "btn-info",
                "text": " <i class=\"fas fa-sync-alt\"><\/i> Reload"
            }],
            "order": [
                [1, 'asc'],
                [2, 'asc']
            ],
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "All"]
            ],
            ajax: "{{ route('admin.course.group.students', $group->id) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                    title: '{{ trans("app.students.fname")}}'
                },
                {
                    data: 'last_name',
                    name: 'last_name',
                    title: '{{ trans("app.students.lname")}}'
                },
                {
                    data: 'father_name',
                    name: 'father_name',
                    title: '{{ trans("app.students.father-name")}}'
                },
                {
                    data: 'level',
                    name: 'level',
                    title: '{{ trans("app.levels.level")}}'
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    printable: false
                }
            ],
            "language": {
                "sEmptyTable": "{{trans('app.datatable.sEmptyTable')}}",
                "sInfo": "{{trans('app.datatable.sInfo')}}",
                "sInfoEmpty": "{{trans('app.datatable.sInfoEmpty')}}",
                "sInfoFiltered": "{{trans('app.datatable.sInfoFiltered')}}",
                "sInfoPostFix": "{{trans('app.datatable.sInfoPostFix')}}",
                "sInfoThousands": "{{trans('app.datatable.sInfoThousands')}}",
                "sLengthMenu": "{{trans('app.datatable.sLengthMenu')}}",
                "sLoadingRecords": "{{trans('app.datatable.sLoadingRecords')}}",
                "sProcessing": "{{trans('app.datatable.sProcessing')}}",
                "sSearch": "{{trans('app.datatable.sSearch')}}",
                "sZeroRecords": "{{trans('app.datatable.sZeroRecords')}}",
                "sFirst": "{{trans('app.datatable.sFirst')}}",
                "sLast": "{{trans('app.datatable.sLast')}}",
                "sNext": "{{trans('app.datatable.sNext')}}",
                "sPrevious": "{{trans('app.datatable.sPrevious')}}",
                "sSortAscending": "{{trans('app.datatable.sSortAscending')}}",
                "sSortDescending": "{{trans('app.datatable.sSortDescending')}}"
            }

        });
    });



    // $(function() {
    //     window.LaravelDataTables = window.LaravelDataTables || {};
    //     window.LaravelDataTables["roles-table"] = $("#roles-table").DataTable({
    //         "serverSide": true,
    //         "processing": true,
    //         "ajax": {
    //             "url": "http:\/\/127.0.0.1:8080\/manager\/roles",
    //             "type": "GET",
    //             "data": function(data) {
    //                 for (var i = 0, len = data.columns.length; i < len; i++) {
    //                     if (!data.columns[i].search.value) delete data.columns[i].search;
    //                     if (data.columns[i].searchable === true) delete data.columns[i].searchable;
    //                     if (data.columns[i].orderable === true) delete data.columns[i].orderable;
    //                     if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
    //                 }
    //                 delete data.search.regex;
    //             }
    //         },
    //         "columns": [{
    //             "data": "DT_RowIndex",
    //             "name": "DT_RowIndex",
    //             "title": "#",
    //             "orderable": false,
    //             "searchable": false,
    //             "className": "text-center"
    //         }, {
    //             "data": "name",
    //             "name": "name",
    //             "title": "Role name",
    //             "orderable": true,
    //             "searchable": true
    //         }, {
    //             "data": "description",
    //             "name": "description",
    //             "title": "Role description",
    //             "orderable": true,
    //             "searchable": true
    //         }, {
    //             "data": "created_at",
    //             "name": "created_at",
    //             "title": "Created at",
    //             "orderable": true,
    //             "searchable": true
    //         }, {
    //             "data": "updated_at",
    //             "name": "updated_at",
    //             "title": "Updated at",
    //             "orderable": true,
    //             "searchable": true
    //         }, {
    //             "data": "Action",
    //             "name": "Action",
    //             "title": "Action",
    //             "orderable": false,
    //             "searchable": false,
    //             "className": "text-center"
    //         }],
    //         "dom": "lBfrtip",
    //         "order": [
    //             [1, "desc"]
    //         ],
    //         "buttons": [{
    //             "extend": "create",
    //             "className": "btn-info",
    //             "text": " <i class=\"fas fa-plus-circle\"><\/i> Create Role"
    //         }, {
    //             "extend": "excel",
    //             "className": "btn-info",
    //             "text": " <i class=\"far fa-file-excel\"><\/i> Excel"
    //         }, {
    //             "extend": "print",
    //             "className": "btn-info",
    //             "text": " <i class=\"fas fa-print\"><\/i> Print"
    //         }, {
    //             "extend": "reset",
    //             "className": "btn-info",
    //             "text": " <i class=\"fas fa-redo\"><\/i> Reset"
    //         }, {
    //             "extend": "reload",
    //             "className": "btn-info",
    //             "text": " <i class=\"fas fa-sync-alt\"><\/i> Reload"
    //         }],
    //         "responsive": true,
    //         "autoWidth": false,
    //         "lengthMenu": [
    //             [10, 25, 50, 100],
    //             ["10", "25", "50", "100"]
    //         ],
    //         "language": {
    //             "sEmptyTable": {{trans('app.datatable.sEmptyTable')}},
    //             "sInfo": {{trans('app.datatable.sInfo')}},
    //             "sInfoEmpty": {{trans('app.datatable.sInfoEmpty')}},
    //             "sInfoFiltered": {{trans('app.datatable.sInfoFiltered')}},
    //             "sInfoPostFix": {{trans('app.datatable.sInfoPostFix')}},
    //             "sInfoThousands": {{trans('app.datatable.sInfoThousands')}},
    //             "sLengthMenu": {{trans('app.datatable.sLengthMenu')}},
    //             "sLoadingRecords": {{trans('app.datatable.sLoadingRecords')}},
    //             "sProcessing": {{trans('app.datatable.sProcessing')}},
    //             "sSearch": {{trans('app.datatable.sSearch')}},
    //             "sZeroRecords": {{trans('app.datatable.sZeroRecords')}},
    //             "sFirst": {{trans('app.datatable.sFirst')}},
    //             "sLast": {{trans('app.datatable.sLast')}},
    //             "sNext": {{trans('app.datatable.sNext')}},
    //             "sPrevious": {{trans('app.datatable.sPrevious')}},
    //             "sSortAscending": {{trans('app.datatable.sSortAscending')}},
    //             "sSortDescending": {{trans('app.datatable.sSortDescending')}}"
    //         }
    //     });
    // });
</script>
@endpush

@push('style')
<link rel="stylesheet" href="{{url('/')}}/css/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endpush
@endsection