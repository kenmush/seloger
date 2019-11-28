@component('mail::message')
# Hi,
Attached find the listing report for ***{{ today()->toFormattedDateString() }}*** at ***{{ date('g:i A') }}***

** Showing listings that are below 3,000/m<sup>2</sup> **

@component('mail::table')
    | Zip Code       | p/m<sup>2</sup>         | m<sup>2</sup>  |  URL  |
    | ------------- |:-------------:| --------:| --------:|
    @foreach(\App\Results::where('squareMeterPrice', '>', 0)->where('squareMeterPrice', '<', 3000)->whereDate('created_at',date('Y-m-d'))->orderBy('squareMeterPrice')->take(15)->get()  as $listing)
    | {{ $listing->postcode }}      | {{ number_format($listing->squareMeterPrice,0) }} €     | {{ $listing->m2 }}      | [View Listing]({{$listing->url}})
       |
    @endforeach
@endcomponent

@component('mail::button', ['url' => 'http://3.14.251.242/login', 'color' => 'success'])
    View more listings
@endcomponent

Thanks,<br>
{{ config('app.name') }} <br>
<em>The timezone used is: ***Europe/Paris*** &nbsp;.</em>
@endcomponent
