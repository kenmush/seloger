<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Results extends Model
{
    protected $casts = [
        'price' => 'integer',
        'squareMeterPrice' => 'integer',
    ];

}
