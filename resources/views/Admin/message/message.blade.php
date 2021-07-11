@if(session()->has('errors'))
<div id="message">
    @foreach (session('errors')->all() as $msg)
    <div style="padding: 5px;">
        <div data-dismiss="alert" class=" alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$msg}}
        </div>
    </div>
    @endforeach
</div>
{{session()->forget('errors')}}
@endif

@if(session()->has('info'))
<div id="message">
    @if(is_array(session('info')))
    @foreach (session('info')->all() as $msg)
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('info')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('info')}}

@endif

@if(session()->has('success'))
<div id="message">
    @if(is_array(session('success')))
    @foreach (session('success')->all() as $msg)
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('success')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('success')}}

@endif


@if(session()->has('warning'))
<div id="message">
    @if(is_array(session('warning')))
    @foreach (session('warning')->all() as $msg)
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$msg}}
        </div>
    </div>
    @endforeach
    @else
    <div style="padding: 5px;">
        <div data-dismiss="alert" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('warning')}}
        </div>
    </div>
    @endif
</div>
{{session()->forget('warning')}}

@endif


@push('scripts')
<script>
    $(".alert").delay(15000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>
@endpush
