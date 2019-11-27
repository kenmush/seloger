@component('mail::message')
# Hi,
Attached finding the listing report for {{ today()->toFormattedDateString() }} at {{ date('h:m') }}

@component('mail::table')
    | Zip Code       | p/m2         | m2  |  URL  |
    | ------------- |:-------------:| --------:| --------:|
    @foreach(\App\Results::where('squareMeterPrice', '<', 3000)->take(15)->get() as $listing)
    | {{ $listing->postcode }}      | {{ $listing->squareMeterPrice }}      | {{ $listing->m2 }}      | [View Listing]({{$listing->url}})
       |
    @endforeach
@endcomponent
@component('mail::button', ['url' => 'http://3.14.251.242/login', 'color' => 'success'])
    View more listings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
