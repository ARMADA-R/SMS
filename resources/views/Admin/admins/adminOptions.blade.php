@extends('Admin.index')
@section('content')
<div style="min-height: 671px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">admin name</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Personal Email: </label>
                                <p class="form-control-static">{{ $user->email}}</p>
                            </div>
                            <div class="form-group">
                                <label>Work Email:</label>
                                <p class="form-control-static">{{ $user->email}}</p>
                            </div>
                            <div class="form-group">
                                <label>Joined in:</label>
                                <p class="form-control-static">{{ $user->created_at}}</p>
                            </div>
                            <div class="form-group">
                                <label>Last Update</label>
                                <p class="form-control-static">{{ $user->updated_at}}</p>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>account status</label>
                                <p class="form-control-static {{ $user->status=='closed'?  'cl-red':''}}" >{{ $user->status}}</p>
                            </div>
                            <form role="form" action="{{ route('admin.UsersAccountView') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id}}" />
                                <div>
                                    <div class="form-group">
                                        <label>{{trans('admin.rules')}}</label>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-lg-6">
                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="super-admin" value="Super admin" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="super-admin">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.superAdmin')}}</span>
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="support" value="Support" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="support">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.support')}}</span>
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="reporter" value="Reporter" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="reporter">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.reporter')}}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="tester" value="Tester" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="tester">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.tester')}}</span>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="app-settings" value="App settings" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="app-settings">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.appSettings')}}</span>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input name="rules[]" class="inp-cbx" id="edit-admins" value="Edit admins" type="checkbox" style="display: none" {{ $user->status=='closed'? "disabled":''}} />
                                                        <label class="cbx" for="edit-admins">
                                                            <span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg>
                                                            </span>
                                                            <span>{{trans('admin.editAdmins')}}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary" {{ $user->status=='closed'? "disabled":''}}>{{trans('admin.save')}}</button>
                                    @if($user->status=='closed')
                                    <p class="form-control-static cl-red" >To modify this account, it must be activated</p>
                                    @endif
                                </div>
                            </form>

                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                    <hr>
                    <div class="form-group " style="display: flex;  justify-content: center;">
                        @if($user->status == 'activated')
                        <button type="button" style=" width: 40%;" class="btn btn-lg btn-outline btn-outline-danger" onclick="closeAccount()">
                            {{trans('admin.closeThisAccount')}}
                        </button>

                        <form id="close-account-form" action="{{ route('admin.closeAccount') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                        </form>
                        @else
                        <button type="button" style=" width: 40%;" class="btn btn-lg btn-success" onclick="activateAccount()">
                            {{trans('admin.activateThisAccount')}}
                        </button>
                        <form id="activate-account-form" action="{{ route('admin.activateAccount') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                        </form>
                        @endif
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
@push('scripts')



<script>
    var rules = <?php print json_encode($rules); ?>;
    if (rules.includes('Super admin')) {
        document.getElementById("super-admin").checked = true;
    }
    if (rules.includes('Edit admins')) {
        document.getElementById("edit-admins").checked = true;
    }
    if (rules.includes('App settings')) {
        document.getElementById("app-settings").checked = true;
    }
    if (rules.includes('Support')) {
        document.getElementById("support").checked = true;
    }
    if (rules.includes('Reporter')) {
        document.getElementById("reporter").checked = true;
    }
    if (rules.includes('Tester')) {
        document.getElementById("tester").checked = true;
    }


    function closeAccount() {
        if (confirm('Are you sure you want to close this account? \nif you press Ok user will not be able to access to the system!')) {
            event.preventDefault();
            document.getElementById('close-account-form').submit();
        }
    }
    function activateAccount() {
        if (confirm('Are you sure you want to activate this account?')) {
            event.preventDefault();
            document.getElementById('activate-account-form').submit();
        }
    }
</script>
@endpush
@push('style')
<style>
    .cl-red {
        color: #ea0101;
    }
    .cbx {
        margin: auto;
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
        background: #506EEC;
        border-color: #506EEC;
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
<style>
    .btn-outline {
        color: inherit;
        background-color: transparent;
        transition: all .5s;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger.focus,
    .btn-outline-danger:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
    }

    .btn-outline-danger.disabled,
    .btn-outline-danger:disabled {
        color: #dc3545;
        background-color: transparent;
    }

    .btn-outline-danger:not(:disabled):not(.disabled).active,
    .btn-outline-danger:not(:disabled):not(.disabled):active,
    .show>.btn-outline-danger.dropdown-toggle {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:not(:disabled):not(.disabled).active:focus,
    .btn-outline-danger:not(:disabled):not(.disabled):active:focus,
    .show>.btn-outline-danger.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
    }
</style>


@endpush
@endsection
