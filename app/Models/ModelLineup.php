<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLineup extends Model
{
    use HasFactory;

    protected $table = "model_lineups";

    protected $guarded = [
        'id'
    ];
}
