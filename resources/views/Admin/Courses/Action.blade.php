<div class="row justify-content-center">

    <!-- view btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-warning " title="{{trans('app.view')}}" style="margin: 0px;" id="view_{{ $id }}" href="{{route('admin.courses.details',$id) }}">
            <i class="far fa-eye"></i>
        </a>
    </div>

    <!-- Edit btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-info " title="{{trans('app.edit')}}" style="margin: 0px;" id="edit_{{ $id }}" href="{{route('admin.courses.edit',$id) }}">
            <i class="far fa-edit"></i>
        </a>
    </div>

    <!-- delete btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-danger " title="{{trans('app.delete')}}" style="margin: 0px;" data-toggle="modal" onclick="{
                        if (confirm('Are you sure you want to delete this course?')) {
                            document.getElementById('{{ $id }}').submit();
                        }
                    }" >
            <i class="far fa-trash-alt"></i>
        </a>
    </div>

</div>
<form role="form" id="{{ $id }}" action="{{ route('admin.courses.delete') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
</form>
