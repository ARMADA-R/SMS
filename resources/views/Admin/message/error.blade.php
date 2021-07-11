@if(session()->has('errors'))
<div id="message">
    @foreach (session('errors')->all() as $msg)
    <div style="padding: 5px;">
        <div id="inner-message" data-dismiss="alert" class=" alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$msg}}
        </div>
    </div>
    @endforeach
</div>
{{session()->forget('errors')}}
@endif
