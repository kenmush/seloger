@component('mail::message')

This is to test a scheduled job. This job has run at {{ today()->toDateTimeLocalString() }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
