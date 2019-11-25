@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Listings</h4>
                            <div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Website</th>
                                            <th>Postcode</th>
                                            <th>URL</th>
                                            <th>price/m2</th>
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
                                        @foreach(\App\Results::all() as $result)
                                            <tr>
                                                <td scope="row">{{$loop->iteration }}</td>
                                                <td>{{ $result->website }}</td>
                                                <td>{{ $result->postcode }}</td>
                                                <td><a href="{{ $result->url }}">
                                                        {{ \Illuminate\Support\Str::afterLast($result->url,'/') }}
                                                    </a></td>
                                                <td>{{ $result->price }}</td>
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
        </div>
    </div>
@endsection
