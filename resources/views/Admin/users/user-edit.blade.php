@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <h2 class="h3 mb-4 page-title">{{trans('app.users.editing-account')}}</h2>
        <div class="my-4">

            <hr class="my-4" />
            <form role="form" action="{{ route('admin.updateAccountDetails') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <!-- <hr class="my-4" /> -->
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="inputuser_name4">{{trans('app.users.user-name')}}</label>
                        <input required type="text" value="{{$user->username}}" class="form-control"  id="inputuser_name4" disabled />
                    </div>
                    <div class="form-group col-md">
                        <label for="inputEmail4">{{trans('app.users.email')}}</label>
                        <input required type="email" value="{{$user->email}}" class="form-control" id="inputEmail4" placeholder="brown@asher.me" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">{{trans('app.users.name')}}</label>
                        <input type="text" value="{{$user->name}}" name="name" id="name" class="form-control" placeholder="Brown" />
                    </div>
                    <div class="form-group col-md">
                        <label for="role">{{trans('app.users.role')}}</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value=""> --{{ trans('app.users.select-role') }}-- </option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ ($user->role_id == $role->id)? 'selected' :'' }}> {{ $role->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="inputAddress5">Address</label>
                    <input required type="text" value="" class="form-control" name ="" id="inputAddress5" placeholder="P.O. Box 464, 5975 Eget Avenue" />
                </div> -->
                <button type="submit" class="btn btn-info">{{trans('app.save')}}</button>
                <button type="reset" class="btn  btn-outline-secondary ">{{trans('app.reset')}}</button>
            </form>


            <form role="form" action="{{ route('admin.updateAccountPassword') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <hr class="my-4" />
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPassword5">{{trans('app.users.new-password')}}</label>
                            <input required type="password" name="password" class="form-control" id="inputPassword5" />
                        </div>
                        <div class="form-group">
                            <label for="inputPassword6">{{trans('app.users.confirm-password')}}</label>
                            <input required type="password" name="password_confirmation" class="form-control" id="inputPassword6" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">{{trans('app.users.password-requirements')}}</p>
                        <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Minimum 8 character</li>
                            <li>At least one special character</li>
                            <li>At least one number</li>
                            <li>Can’t be the same as a previous password</li>
                        </ul>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">{{trans('app.users.update-password')}}</button>
                <button type="reset" class="btn btn-outline-secondary">{{trans('app.reset')}}</button>
            </form>
            <hr>

            @if(json_decode($user->settings)->status == 'active')
            <form role="form" id="close-account-form" action="{{ route('admin.CloseUserAccount') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
            </form>
            <div class="form-group">
                <button type="" class="btn btn-block btn-outline-danger btn-lg" onclick="closeAccount()">{{trans('app.users.close-account')}}</button>
            </div>
            @else

            <form role="form" id="activate-account-form" action="{{ route('admin.ActivateUserAccount') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
            </form>
            <div class="form-group">
                <button type="" class="btn btn-block btn-outline-success btn-lg" onclick="activateAccount()">{{trans('app.users.activate-account')}}</button>
            </div>
            @endif
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" id="close-cropper" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>
                    <!-- Below are a series of inputs which allow file selection and interaction with the cropper api -->
                    <input class="btn btn-sm" type="file" id="fileInput" accept="image/*" />
                    <button class="btn float-right m-1 btn-outline-secondary btn-sm" id="btnRestore">Restore</button>
                    <button class="btn float-right m-1 btn-info btn-sm" id="btnCrop">Crop</button>
                </p>
                <div>
                    <canvas style="width: 100%; height: 100%;" id="canvas">
                        Your browser does not support the HTML5 canvas element.
                    </canvas>
                </div>

                <div id="result"></div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="text-danger"> you sould save change after crooping!</div>
                <!-- <button type="button" class="btn float-left btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script>
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
    body {
        color: #8e9194;
        background-color: #f4f6f9;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .text-muted {
        color: #aeb0b4 !important;
        font-weight: 300;
    }

    .form-control {
        display: block;
        width: 100%;
        /* height: calc(1.5em + 0.75rem + 2px); */
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #4d5154;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #eef0f3;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>


@endpush
@endsection