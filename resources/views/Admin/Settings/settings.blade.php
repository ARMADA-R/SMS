@extends('Admin.index')
@section('content')
<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <form role="form" method="POST" action="{{ route('admin.settings.updateBasics') }}" enctype="multipart/form-data">
        @csrf
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{trans('app.settings.BasicInfo')}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="Appname">{{trans('app.settings.AppName')}}</label>
                            <input name="appName" value="{{ isset($settings->payload['app_name']) ? $settings->payload['app_name'] :'' }}" type="text" class="form-control" id="Appname" placeholder="Enter Application name">
                        </div>
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

                <div class="row ">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="logo">{{trans('app.settings.logo')}}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="logo" type="file" class="form-control" id="logo">
                                    <label class="custom-file-label" id="logo-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                            <p class="help-block">logo size must be less than 512 KB</p>
                        </div>
                        <div class="form-group d-flex justify-content-center ">
                            <img class="img img-responsive" id="img-logo" src="{{ isset($settings->payload['logo']) ? Storage::url($settings->payload['logo']) :'' }}" src="" alt="Photo">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="icon">{{trans('app.settings.favicon')}}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="icon" type="file" class="form-control" id="icon">
                                    <label class="custom-file-label" id="icon-file-label" for="icon">Choose file</label>
                                </div>
                            </div>
                            <p class="help-block">Favicon size must be less than 10 KB</p>
                        </div>
                        <div class="form-group d-flex justify-content-center ">
                            <img class="img img-responsive" id="img-icon" src="{{ isset($settings->payload['icon']) ? Storage::url($settings->payload['icon']) :'' }}" alt="Photo">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ trans('app.save')}}</button>
                <button class="btn" type="reset">{{ trans('app.reset')}}</button>
            </div>
        </div>
        <!-- /.card -->
    </form>
    <!-- /form -->


    <form role="form" action="{{ route('admin.settings.updateOptions') }}" method="post">
        @csrf
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{trans('app.settings.sys-options')}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="/*form-group*/">
                            <div class="custom-control custom-checkbox">
                                <input class="inp-cbx" value="true" name="scheduling_attendance" type="checkbox" style="display: none;" id="scheduling_attendance" {{ isset($settings->payload['scheduling_attendance']) ? ($settings->payload['scheduling_attendance'] == 'true' ? 'checked' : '') :'' }} />
                                <label class="cbx" for="scheduling_attendance">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>{{ trans('app.settings.scheduling-attendance') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ trans('app.save')}}</button>
                <button class="btn" type="reset">{{ trans('app.reset')}}</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </form>
    <!-- /form -->

    <form role="form" action="{{ route('admin.settings.updateMaintenanceMode') }}" method="post">
        @csrf
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{trans('app.settings.maintenance')}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>{{trans('app.settings.status')}}</label>
                            <select name="maintenanceMode" class="form-control">
                                <option value="false" {{ isset($settings->payload['maintenance_status']) ? ($settings->payload['maintenance_status'] == 'false' ? 'selected' : '') :'' }}>{{trans('app.settings.opened')}}</option>
                                <option value="true" {{ isset($settings->payload['maintenance_status']) ? ($settings->payload['maintenance_status'] == 'true' ? 'selected' : '') :'' }}>{{trans('app.settings.closed')}}</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>{{trans('app.settings.closedStatusMessage')}}</label>
                            <textarea name="maintenanceMessage" class="form-control" rows="1" placeholder="be right back">{{ isset($settings->payload['maintenance_message']) ? $settings->payload['maintenance_message'] :'' }}</textarea>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ trans('app.save')}}</button>
                <button class="btn" type="reset">{{ trans('app.reset')}}</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </form>
    <!-- /form -->

</div>

<!-- /.row -->
</section>
<!-- /.content -->

@push('scripts')
<script src="{{url('')}}/design/AdminLTE/plugins/bootstrap-formhelpers/bootstrap-formhelpers.js"></script>
<script></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

<script src="{{url('')}}/design/AdminLTE/plugins/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(function() {
        $('#singleFieldTags2').tagit();
    });
</script>
<script>
    $('#icon').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('#icon-file-label').html(fileName);
        document.getElementById('img-icon').src = window.URL.createObjectURL(this.files[0]);
    })


    $('#logo').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('#logo-file-label').html(fileName);
        document.getElementById('img-logo').src = window.URL.createObjectURL(this.files[0]);
    })
</script>
@endpush
@push('style')

<link href="{{url('')}}/design/AdminLTE/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="{{url('')}}/design/AdminLTE/plugins/tag-it/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{url('')}}/design/AdminLTE/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

<style>
    .img {
        max-width: 100%;
        max-height: 300px;
        height: auto;
        object-fit: 'contain';
    }

    .cbx {
        margin: auto;
        -webkit-user-select: none;
        user-select: none;
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
        background: #3c8dbc;
        border-color: #3c8dbc;
        animation: wave 0.4s ease;
    }

    .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(3.5);
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