@if(session()->has('info'))
<div id="message">
    @if(is_array(session('info')))
    @foreach (session('info')->all() as $msg)
    <div style="padding: 5px;">
        <div id="inner-message"  data-dismiss="alert" class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div id="inner-message"  data-dismiss="alert"  class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('info')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('info')}}

@endif
