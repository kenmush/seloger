<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/search', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function () {
    Route::resource('city', 'CityController');
});
