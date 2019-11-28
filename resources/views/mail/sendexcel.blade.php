@component('mail::message')
# Hi,
This is a development email.
### Changed
- Order results by square meter price in dashboard and excel report
- Remove results that have a zero as the square meter price
- Schedule a job so as to restart hourly scraping at 12 noon on 28 Nov, 2019

## TODO
- Send an email showing that no new listing has been added if after scraping they are no new results.

Attached finding the listing report for {{ today()->toFormattedDateString() }} at {{ date('h:m') }}

@component('mail::table')
    | Zip Code       | p/m2         | m2  |  URL  |
    | ------------- |:-------------:| --------:| --------:|
    @foreach(\App\Results::where('squareMeterPrice', '>', 0)->where('squareMeterPrice', '<', 3000)->whereDate('created_at',date('Y-m-d'))->orderBy('squareMeterPrice')->take(15)->get()  as $listing)
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
