@component('mail::message')
# {{ config('app.name') }} | Reset Password Notification

Hello {{$data['admin']->name}}

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $data['url']])
Rest Password
@endcomponent

If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
<a href=" {{ $data['url'] }}"> {{ $data['url'] }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
