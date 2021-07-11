@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">{{ trans('app.courses.group.add-students')}}</h3>
                <div class="ml-auto">
                    <button class="btn float-left btn-info mx-1" onclick=" document.getElementById('add-students-form').submit();" type="button"><span>{{trans('app.save')}}</span></button>
                    <div class="btn btn-info float-left mx-1" id="selected-students-num" style="cursor: auto;">0</div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" id="add-students-form" action="{{ route('admin.course.group.student.add-students.data', $group) }}" method="POST">
                    @csrf
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
                </form>
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
<script src="{{ url('/') }}/js/datatables/dataTables.buttons.min.js"></script>
<script src="{{ url('/') }}/vendor/datatables/buttons.server-side.js"></script>
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
            "lengthMenu": [
                [20, 50, 100, 500],
                [20, 50, 100, 500]
            ],
            buttons: [{
                text: "{{trans('app.save')}}",
                className: "btn-info",
                action: function(e, dt, node, config) {
                    document.getElementById("add-students-form").submit();
                },
            }],
            "order": [
                [1, 'asc'],
                [2, 'asc']
            ],
            ajax: "{{ route('admin.course.group.student.add-students.data', $group) }}",
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
                    title: `<input class="inp-cbx" id="all_checks" type="checkbox" onclick="checkAndSelect(this)" style="display: none;"/> 
                                    <label class="cbx " for="all_checks">
                                        <span>
                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                            </svg>
                                        </span>
                                    </label>`,
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
</script>

<script>
    let status = false;
    let students_num = -1;

    function checkAndSelect(element) {
        if (element.checked) {
            select();
        } else {
            deSelect();
        }
    }

    function select() {
        var ele = document.getElementsByName('students[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox') {
                ele[i].checked = true;
                updateStudentsNum(ele[i]);
            }
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('students[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox') {
                ele[i].checked = false;
                updateStudentsNum(ele[i]);
            }
        }
    }

    function updateStudentsNum(element) {
        if (element.type == 'checkbox') {
            if (element.checked)
                students_num++;
            else
                students_num--;
        }
        console.log(students_num);
        document.getElementById("selected-students-num").innerHTML = students_num + 1;
    }
</script>

@endpush

@push('style')
<link rel="stylesheet" href="{{url('/')}}/css/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    .cbx {
        margin: auto;
        /* margin-left: 20px; */
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
    }

    .cbx span {
        display: inline-block;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child {
        position: relative;
        width: 18px;
        height: 18px;
        border-radius: 3px;
        transform: scale(1);
        vertical-align: middle;
        border: 1px solid #9098A9;
        transition: all 0.2s ease;
    }

    .cbx span:first-child svg {
        position: absolute;
        top: 3px;
        left: 2px;
        fill: none;
        stroke: #FFFFFF;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 16px;
        stroke-dashoffset: 16px;
        transition: all 0.3s ease;
        transition-delay: 0.1s;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child:before {
        content: "";
        width: 100%;
        height: 100%;
        background: #506EEC;
        display: block;
        transform: scale(0);
        opacity: 1;
        border-radius: 50%;
    }

    .cbx span:last-child {
        padding-left: 8px;
    }

    .cbx:hover span:first-child {
        border-color: #506EEC;
    }

    .inp-cbx:checked+.cbx span:first-child {
        background: #17a2b8;
        border-color: #17a2b8;
        animation: wave 0.4s ease;
    }

    .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(1.5);
        opacity: 0;
        transition: all 0.6s ease;
    }

    @keyframes wave {
        50% {
            transform: scale(0.9);
        }
    }
</style>

@endpush
@endsection