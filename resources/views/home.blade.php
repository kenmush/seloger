@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">Dashboard
                        <p class="float-right">
                            <strong> {{ today()->toFormattedDateString() }}</strong>
                        </p>
                    </div>

                    <div class="card-body">

                        <h4 class="card-title">Listings
                            <small class="float-right">
                                {{--                            <a href="">--}}
                                {{--                                <i class="far fa-file-pdf fa-2x"></i>--}}
                                {{--                            </a>--}}
                                <a href="{{ url('exportxls') }}">
                                    <i class="fas fa-file-excel fa-2x"></i>

                                </a>
                                <a href="{{ url('mail') }}">
                                    <i class="far fa-envelope fa-2x "></i>
                                </a>
                            </small>
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="listingtable">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Website</th>
                                    <th>Postcode</th>
                                    <th>URL</th>
                                    <th>price/m2</th>
                                    <th>Price</th>
                                    <th>price/room</th>
                                    <th>price/bedroom</th>
                                    <th>location</th>
                                    <th>type</th>
                                    <th>m2</th>
                                    <th># of rooms</th>
                                    <th># of bedrooms</th>
                                    <th>Description.</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Results::where('squareMeterPrice', '>', 0)->where('squareMeterPrice', '<', 3000)->whereDate('created_at',date('Y-m-d'))->orderBy('squareMeterPrice')->get() as $result)
                                    <tr>
                                        <td scope="row">{{$loop->iteration }}</td>
                                        <td>{{ $result->website }}</td>
                                        <td>{{ $result->postcode }}</td>
                                        <td><a href="{{ $result->url }}">
                                                {{ \Illuminate\Support\Str::words($result->description,3) }}
                                            </a></td>
                                        <td>{{ number_format($result->squareMeterPrice,0)}} €</td>
                                        <td>{{ number_format($result->price,0) }} €</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $result->location }}</td>
                                        <td>{{ $result->type }}</td>
                                        <td>{{ $result->m2 }}</td>
                                        <td>{{ $result->rooms }}</td>
                                        <td>{{ $result->bedrooms }}</td>
                                        <td>{{ $result->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
