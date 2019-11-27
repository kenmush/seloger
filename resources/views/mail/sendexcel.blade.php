@component('mail::message')
# Hi,
Attached finding the listing report for {{ today()->toFormattedDateString() }}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
