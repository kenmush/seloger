@component('mail::message')
# Hi,
Attached finding the listing report for {{ today()->toFormattedDateString() }} at {{ date('h:m') }}

@component('mail::table')
    | Zip Code       | p/m2         | m2  |  URL  |
    | ------------- |:-------------:| --------:| --------:|
    @foreach(\App\Results::where('squareMeterPrice', '<', 3000)->get() as $listing)
    | {{ $listing->postcode }}      | {{ $listing->squareMeterPrice }}      | {{ $listing->m2 }}      | [View Listing]({{$listing->url}})
       |
    @endforeach
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
