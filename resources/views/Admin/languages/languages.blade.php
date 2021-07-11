@extends('Admin.index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.title.system-languages')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ $dataTable->table([
                    "class" => "table table-striped datatable table-hover responsive",
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

@endpush

@push('style')
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/css/datatables/buttons.dataTables.min.css">
@endpush
@endsection
