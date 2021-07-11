@extends('Admin.index')
@section('content')


<div style="height: 600px;">
    <div id="fm"></div>
</div>


@push('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endpush
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush
@endsection
