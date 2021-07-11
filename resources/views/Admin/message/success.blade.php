@if(session()->has('success'))
<div id="message">
    @if(is_array(session('success')))
    @foreach (session('success')->all() as $msg)
    <div style="padding: 5px;">
        <div id="inner-message"  data-dismiss="alert"  class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div id="inner-message"  data-dismiss="alert"  class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('success')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('success')}}

@endif
