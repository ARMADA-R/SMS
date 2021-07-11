<div class="row justify-content-center">

    <!-- Edit language btn -->
    <div class="col-lg-6">
        <a type="button" class="btn btn-sm btn-info btn-popover" title="{{trans('app.edit')}}" href="{{route('admin.languageEdit',$_id) }}">
            <i class="far fa-edit"></i>
        </a>
    </div>
</div>

@push('script')

@endpush
