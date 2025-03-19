<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GooglePlaceApi extends Model
{
    use HasFactory;

    protected $table = "google_place_apis";

    protected $guarded = [
        'id',
    ];
}
