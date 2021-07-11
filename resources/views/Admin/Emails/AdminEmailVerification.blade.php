@component('mail::message')
<b>Hello {{$data['admin']->name}}</b>

Please click the button below to verify your email address.

@component('mail::button', ['url' => $data['verificationUrl']])
Verify Email Address
@endcomponent
If you did not create an account, no further action is required.

Regards,<br>
{{ config('app.name') }}
@endcomponent
