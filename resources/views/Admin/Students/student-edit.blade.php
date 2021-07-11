@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-11 /*col-lg-10*/ /*col-xl-8*/ mx-auto">
        <h2 class="h3 mb-4 page-title">{{trans('app.students.students')}}</h2>
        <div class="my-4">
            <!-- <hr class="my-4" /> -->
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title" style="line-height: 2;">{{trans('app.students.edit-student')}}</h5>

                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('admin.student.edit', $student->id ) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <!-- <hr class="my-4" /> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">{{trans('app.students.fname')}}</label>
                                <input value="{{ (null != old('fname')) ? old('fname') :  $student->first_name }}" required type="text" name="fname" id="fname" class="form-control" placeholder="Brown" />
                            </div>

                            <div class="form-group col-md">
                                <label for="lname">{{trans('app.students.lname')}}</label>
                                <input value="{{ (null != old('lname')) ? old('lname') :  $student->last_name }}" required type="text" name="lname" class="form-control" id="lname" placeholder="John" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="father_name">{{trans('app.students.father-name')}}</label>
                                <input value="{{ (null != old('father_name')) ? old('father_name') :  $student->father_name }}" required type="text" class="form-control" name="father_name" id="father_name" placeholder="Bard John" />
                            </div>
                            <div class="form-group col-md">
                                <label for="mother_name">{{trans('app.students.mother-name')}}</label>
                                <input value="{{ (null != old('mother_name')) ? old('mother_name') :  $student->mother_name }}" required type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Maria John" />
                            </div>
                            <div class="form-group col-md">
                                <label for="level">{{trans('app.levels.level')}}</label>
                                <select required name="level" id="level" class="form-control">
                                    <option value="" selected> -- </option>
                                    @foreach($levels as $level)
                                    <option value="{{$level->id}}" {{ (null != old('level')) ? (old('level') ==  $level->id ? 'selected' : '' ): (($student->level_id == $level->id)? 'selected' : '') }}> {{ $level->name .' : '. $level->name }} </option>
                                    @endforeach
                                </select>
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