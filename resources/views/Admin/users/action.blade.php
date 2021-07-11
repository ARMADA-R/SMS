<div class="row justify-content-center" style="    flex-wrap: nowrap;">
    <!-- view user btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-warning " title="{{trans('app.view')}}" style="margin: 0px;" id="view_{{ $id }}" href="{{route('admin.UserAccountDetails',$id) }}">
            <i class="far fa-eye"></i>
        </a>
    </div>

    <!-- Edit user btn -->
    <div class="col-lg-4">
        <a type="button" class="btn btn-sm btn-info " title="{{trans('app.edit')}}" style="margin: 0px;" id="edit_{{ $id }}" href="{{route('admin.UsersAccountEdit',$id) }}">
            <i class="fas fa-user-edit"></i>
        </a>
    </div>

    <div class="col-lg-4">

        @if(json_decode($settings)->status == 'active')
        <form role="form" id="close-account-form-{{$id}}" action="{{ route('admin.CloseUserAccount') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
        </form>
        <div class="form-group">
            <button type="" class="btn btn-sm btn-danger" onclick="closeAccount()"><i class="fas fa-user-times"></i></button>
        </div>
        <script>
            function closeAccount() {
                if (confirm('Are you sure you want to close this account? \nif you press Ok user will not be able to access to the system!')) {
                    event.preventDefault();
                    document.getElementById('close-account-form-{{$id}}').submit();
                }
            }
        </script>
        @else

        <form role="form" id="activate-account-form-{{$id}}" action="{{ route('admin.ActivateUserAccount') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
        </form>
        <div class="form-group">
            <button type="" class="btn btn-sm btn-success" onclick="activateAccount()"><i class="fas fa-user-check"></i></button>
        </div>
        <script>
            function activateAccount() {
                if (confirm('Are you sure you want to activate this account?')) {
                    event.preventDefault();
                    document.getElementById('activate-account-form-{{$id}}').submit();
                }
            }
        </script>
        @endif
    </div>
</div>