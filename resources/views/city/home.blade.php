@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <form action="{{ route('city.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="cityName">City Name </label>
                                    <input type="text" name="cityName" id="cityName" class="form-control"
                                           placeholder="City Name"
                                           aria-describedby="cityName">
                                    <small id="cityName" class="text-muted">Provide the city name.</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="postalcode">Postal Code </label>
                                    <input type="text" name="postalcode" id="postalcode" class="form-control"
                                           placeholder="Postal Code"
                                           aria-describedby="postalcode">
                                    <small id="postalcode" class="text-muted">Provide the Postal Code.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6" >
                                    <label for="insee">INSEE Code </label>
                                    <input type="text" name="insee" id="insee" class="form-control"
                                           placeholder="Insee Code"
                                           aria-describedby="insee">
                                    <small id="insee" class="text-muted">Provide the Insee Code.</small>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-outline-primary">Add City</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-12 py-4">
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-inverse">
                                    <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Postal Code</th>
                                        <th>INSEE Code</th>
                                        <td colspan="2"></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\City::all() as $city)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $city->city }}</td>
                                            <td>{{ $city->postalcode }}</td>
                                            <td>{{ $city->insee }}</td>
                                            <td>
                                                <button class="btn btn-outline-danger btn-sm text-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm ">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </td>
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
@endsection
