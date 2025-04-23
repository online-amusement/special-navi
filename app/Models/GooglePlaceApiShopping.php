<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GooglePlaceApiShopping extends Model
{
    use HasFactory;

    protected $table = "google_place_api_shoppings";

    protected $guarded = [
        'id',
    ];
}
