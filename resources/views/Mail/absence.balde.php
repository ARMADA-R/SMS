@component('mail::message')
# {{ config('app.name') }} | {{ trans('app.attendance.student.absent-alert') }}

{{ trans('app.attendance.student.status-registered-as-absent', $user) }}

@endcomponent
