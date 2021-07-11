@extends('Admin.index')
@section('content')

<div class="container-fluid" data-select2-id="32">
    <form>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.audience.information')}}</h3>

                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('app.audience.name')}}</label>
                                <div class="input-group">
                                    <input type="text" id="name" disabled value="{{ old('name') ? old('name') : $audience->name }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('app.audience.description')}}</label>
                                <div class="input-group">
                                    <input type="text" id="tdescription" disabled value="{{ old('description') ? old('description') : $audience->description }}" class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
        <hr>

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default " data-select2-id="31">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.audience.geo-rule.title')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" data-select2-id="30">
                <div class="form-group" data-select2-id="29">
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ trans('app.audience.geo-rule.country')}}</label>
                            <select disabled id="geo-countries" class="form-control bfh-countries" data-country="{{isset($audience->rules['geo'])? $audience->getAttribute('rules.geo.geo-country'):''}}"></select>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <label>{{ trans('app.audience.geo-rule.state')}}</label>
                            <select disabled id="geo-states" class="form-control bfh-states" data-country="geo-countries" data-state="{{isset($audience->rules['geo'])? $audience->getAttribute('rules.geo.geo-state'):''}}">
                            </select>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ trans('app.audience.geo-rule.description')}}
            </div>
        </div>
        <!-- /.card -->

        <div class="card card-default ">
            <div class="card-header" style="justify-content: center;">
                <h3 class="card-title" style="line-height: 1.5;">{{ trans('app.audience.timezone-rule.title')}}</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group" data-select2-id="29">
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ trans('app.audience.timezone-rule.country')}}</label>
                            <select disabled id="timezone-countries" disabled class="form-control bfh-countries" data-country="{{isset($audience->rules['timezone'])? $audience->getAttribute('rules.timezone.timezone-country'):''}}"></select>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <label>{{ trans('app.audience.timezone-rule.state')}}</label>
                            <select disabled id="timezone-state" class="form-control bfh-timezones" data-country="timezone-countries" data-timezone="{{isset($audience->rules['timezone'])? $audience->getAttribute('rules.timezone.timezone-state'):''}}">
                            </select>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
        </div>
    </form>
</div>


@push('scripts')

<script src="{{ url('/design/AdminLTE') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{url('')}}/design/AdminLTE/plugins/bootstrap-formhelpers/dist/js/bootstrap-formhelpers.min.js"></script>

@endpush

@push('style')

<!-- <link href="{{url('')}}/design/AdminLTE/plugins/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css"></link> -->
<style>
    .cbx {
        margin: auto;
        margin-left: 10px;
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
        background: #3c8dbc;
        border-color: #3c8dbc;
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

    .form-control {
        border: 0;
    }

    select.form-control {
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
    }
</style>

@endpush
@endsection
