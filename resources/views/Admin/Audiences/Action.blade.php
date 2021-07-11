<div class="row justify-content-center">

    <!-- view user btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-warning " title="{{trans('app.view')}}" style="margin: 0px;" id="view_{{ $_id }}" href="{{route('admin.audience.view',$_id) }}">
            <i class="far fa-eye"></i>
        </a>
    </div>

    <!-- Edit user btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-info " title="{{trans('app.edit')}}" style="margin: 0px;" id="edit_{{ $_id }}" href="{{route('admin.audience.edit',$_id) }}">
            <i class="far fa-edit"></i>
        </a>
    </div>

    <!-- close account btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-danger " title="{{trans('app.delete')}}" style="margin: 0px;" data-toggle="modal" onclick="{
                        if (confirm('Are you sure you want to delete this Audience?')) {
                            document.getElementById('{{ $_id }}').submit();
                        }
                    }" data-target="#myModal">
            <i class="far fa-trash-alt"></i>
        </a>
    </div>

</div>
<form role="form" id="{{ $_id }}" action="{{ route('admin.audience.delete') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$_id }}">
</form>
