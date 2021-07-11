@push('scripts')
@if( Auth::guard("admin")->check())
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>


    var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
        cluster: '{{env("MIX_PUSHER_APP_CLUSTER")}}',
        encrypted: true,
        authEndpoint: '/broadcasting/auth'
    });

    var channel = pusher.subscribe('private-App.Models.User.{{ Auth::guard("admin")->user()->id }}');
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
        checkNotification();
    });
</script>
@endif
@endpush