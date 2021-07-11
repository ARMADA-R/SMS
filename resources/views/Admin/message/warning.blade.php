@if(session()->has('warning'))
<div id="message">
    @if(is_array(session('warning')))
    @foreach (session('warning')->all() as $msg)
    <div style="padding: 5px;">
        <div id="inner-message"  data-dismiss="alert"  class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div id="inner-message"   data-dismiss="alert" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('warning')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('warning')}}

@endif
