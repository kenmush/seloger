<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Results extends Model
{
    protected $casts = [
        'price' => 'integer',
    ];

    public function getSquareMeterPriceAttribute($value)
    {
        $values = Str::replaceLast('€', '', $value);
        return preg_replace('/\s/u', '', $values);
    }

}
