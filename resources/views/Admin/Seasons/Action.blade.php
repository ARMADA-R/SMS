<div class="row justify-content-center">

    <!-- Edit user btn -->
    <div class="col-lg-6">
        <a type="button" class="btn btn-sm btn-info " title="{{trans('app.edit')}}" style="margin: 0px;" id="edit_{{ $id }}" href="{{route('admin.seasons.edit',$id) }}">
            <i class="far fa-edit"></i>
        </a>
    </div>

    <!-- close account btn -->
    <div class="col-lg-6">
        <a type="button" class="btn btn-sm btn-danger " title="{{trans('app.delete')}}" style="margin: 0px;" data-toggle="modal" onclick="{
                        if (confirm('Are you sure you want to delete this Season?')) {
                            document.getElementById('{{ $id }}').submit();
                        }
                    }" >
            <i class="far fa-trash-alt"></i>
        </a>
    </div>

</div>
<form role="form" id="{{ $id }}" action="{{ route('admin.seasons.delete') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
</form>
