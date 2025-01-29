<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryTag extends Model
{
    use HasFactory;

    protected $table = "sub_category_tags";

    protected $guarded = [
        'id',
    ];

    public function categoryTag()
    {
        return $this->belongsTo(CategoryTag::class);
    }

}
