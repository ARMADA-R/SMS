@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-11 /*col-lg-10*/ /*col-xl-8*/ mx-auto">
        <h2 class="h3 mb-4 page-title">{{trans('app.teachers.teachers')}}</h2>
        <div class="my-4">
            <!-- <hr class="my-4" /> -->
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title" style="line-height: 2;">{{trans('app.teachers.edit-teacher')}}</h5>

                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('admin.teacher.edit', $teacher->id ) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $teacher->id }}">
                        <!-- <hr class="my-4" /> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{trans('app.teachers.name')}}</label>
                                <input value="{{ (null != old('name')) ? old('name') :  $teacher->name }}" required type="text" name="name" id="name" class="form-control" placeholder="Brown" />
                            </div>

                            <div class="form-group col-md">
                                <label for="degree">{{trans('app.teachers.degree')}}</label>
                                <input value="{{ (null != old('degree')) ? old('degree') :  $teacher->degree }}" required type="text" name="degree" class="form-control" id="degree" placeholder="John" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">{{trans('app.save')}}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{trans('app.reset')}}</button>
                    </form>
                </div>
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