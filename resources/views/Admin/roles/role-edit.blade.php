@extends('Admin.index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('app.title.edit-role')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" action="{{ route('admin.roleUpdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                            <div class="form-row">

                                <div class="form-group col">
                                    <label for="name">{{ trans('app.role.name')}}</label>
                                    <input type="text" value="{{ $role->name }}" name="name" id="name" class="form-control" placeholder="Brown" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">{{ trans('app.role.description')}}</label>
                                    <textarea rows="2" name="description" id="description" class="form-control">{{ $role->description }}</textarea>
                                </div>
                            </div>

                            <hr>
                            <br>
                            <label for="">{{ trans('app.role.permissions')}}</label>
                            <hr>
                            <div class="row">
                                <input type="button" class="btn" onclick='selects()' value="Select All" />
                                <input type="button" class="btn" onclick='deSelect()' value="Deselect All" />
                            </div>
                            <hr>
                            <div class="row">
                                @foreach($permissions_by_groups as $group => $permissions)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label >{{ $group }}</label>
                                        @foreach($permissions as $permission)
                                        <div class="custom-control">
                                            <input class="inp-cbx" type="checkbox" style="display: none;" name="permissions[]" value="{{$permission['id']}}" id="{{$permission['id']}}" {{$permission['checked']? 'checked' :'' }} />
                                            <label class="cbx" for="{{$permission['id']}}">
                                                <span>
                                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span class="text-secondary">{{$permission['name']}}</span>
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
                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">{{ trans('app.save')}}</button>
                                <button type="reset" class="btn  btn-outline-secondary ">{{ trans('app.reset')}}</button>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.col-sm-6 -->
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



@push('scripts')
<script>
    function selects() {
        var ele = document.getElementsByName('permissions[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('permissions[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;

        }
    }
</script>

@endpush
@push('style')
<style>
    .cbx {
        margin: auto;
        margin-left: 20px;
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
</style>


@endpush
@endsection
