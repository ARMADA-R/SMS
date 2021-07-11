@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.title.role-details')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- checkbox -->
                        <div class="form-group">
                            <h3>{{ $role->name }}</h3>
                            <p>{{ $role->description }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.created-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $role->created_at ))->format('Y-m-d H:i')                                    }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ trans('app.updated-at')}}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{(new Carbon\Carbon( $role->updated_at ))->format('Y-m-d H:i')                                     }}
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
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.role.permissions')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    @foreach($permissions_by_groups as $group => $permissions)
                    <div class="col-md-4">
                        <!-- checkbox -->
                        <div class="form-group">
                            <label for="">{{ $group }}</label>
                            @foreach($permissions as $permission)
                            <div class="custom-control custom-checkbox">
                                <input class="inp-cbx" type="checkbox" style="display: none;" id="per-{{$permission['id']}}" {{$permission['checked']? 'checked' :'' }} disabled />
                                <label class="cbx" for="per-{{$permission['id']}}">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>{{$permission['name']}}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-sm-6 -->
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->




@push('style')
<style>
    .cbx {
        margin: auto;
        margin-left: 20px;
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
