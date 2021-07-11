@extends('Admin.index')
@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <h2 class="h3 mb-4 page-title">{{ trans('app.title.edit-language')}}</h2>
        <hr>
        <div class="my-4">

            <form  role="form" action="{{ route('admin.languageEditPOST') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$lang->_id}}">
                <div class="row mt-5 align-items-center">

                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-1">{{ trans('app.hint')}}</h5>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-muted">
                                {{ trans('app.language.dir-hint')}}
                                <!-- When writing the translation, it must be take consideration not to change the symbols and words expressing the variables (words that start with the colon :), in addition to taking consideration the direction of the language in relation to the variables -->

                                <p>Example: <br> English translate:  The <span style="color: #d81b60;">:attribute</span> is not a valid URL.<br> Arabic translate:  ليست عنوان صفحة ويب صالح  <span style="color: #d81b60;">:attribute</span> القيمة </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="Name">{{ trans('app.language.name')}}</label>
                        <input required name="name" type="text" value="{{$lang->name}}" class="form-control" id="Name" placeholder="English" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Code">{{ trans('app.language.code')}}</label>
                        <input required name="code" type="text" value="{{$lang->code}}" class="form-control" id="Code" placeholder="en" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dir">{{ trans('app.language.direction')}}</label>
                        <select required name="direction" id="dir" class="form-control">
                            <option > --select direction--</option>
                            <option {{$lang->direction=='LTR'?  "selected":'' }} value="LTR">Left to Right</option>
                            <option  {{$lang->direction=='RTL'?  "selected":'' }} value="RTL">Right to Left</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col ">
                        <label for="description">{{ trans('app.language.description')}}</label>
                        <textarea rows="2" name="description" id="description" placeholder="" class="form-control">{{ isset( $lang->description)?$lang->description :''}}</textarea>
                    </div>
                </div>


                @foreach($lang->payload as $key => $value)
                <div id="{{$key}}">
                    <!-- <hr class="mb-8"> -->
                    <div class="mt-8 row align-items-center">
                        <div class="col">
                            <h3 class="">{{ ucfirst($key) }}</h3>
                        </div>
                    </div>
                    <hr>
                    @if(is_array($value))
                    {{ ( langArrayPrintInputsToEdit($value,$key))}}
                    @endif

                </div>
                @endforeach
                <hr class="my-4" />
                <button type="submit" class="btn btn-info">{{ trans('app.save')}}</button>
            </form>
        </div>
    </div>
</div>



@push('scripts')

@endpush
@push('style')



<style>
    body {
        color: #8e9194;
        background-color: #f4f6f9;
    }

    .text-muted {
        color: #ce1123 !important;
    }

    .text-muted {
        font-weight: 300;
    }

    .mb-8 {
        margin-bottom: 5rem !important
    }

    .mt-8 {
        margin-top: 5rem !important
    }
    .ml-4 {
        margin-left: 1.5rem !important
    }

    /* .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
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
    } */
</style>


@endpush
@endsection
