@component('mail::message')
# {{ config('app.name') }} | Administration Invite

We want you to be one of our system officials.
All you need to do click the button below and complete the registration process


@component('mail::button', ['url' => AdminUrl('register/'. $data['token'].'/'.$data['email'])])
Register
@endcomponent

<b style="color: rgb(241 88 88);"> This invitation is valid for {{Config::get('myApp.invitationValidity', 24 )}} hours from the date it was sent.</b>

Thanks,<br>
{{ Auth::guard('admin')->user()->name }}
@endcomponent
