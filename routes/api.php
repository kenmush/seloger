<?php

use Illuminate\Http\Request;


Route::group(['prefix'=>'v1'], function () {
    Route::resource('city', 'CityController');
});
