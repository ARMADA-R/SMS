@extends('Admin.index')
@section('content')
<div class="mx-5 gutters-sm">
    <div class="">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.users.full-name')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$user->name}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.users.email')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$user->email}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.users.user-name')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$user->username}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.users.role')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{$user->role}}
                    </div>
                </div>
                <hr>
                
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.created-at')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{(new Carbon\Carbon($user->created_at))->format('Y-m-d H:i') }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.updated-at')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{(new Carbon\Carbon($user->updated_at))->format('Y-m-d H:i') }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">{{trans('app.users.account-status')}}</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ json_decode($user->settings)->status}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@push('scripts')


@endpush
@push('style')


@endpush
@endsection
