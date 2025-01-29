<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoryTag;

class CategoryTag extends Model
{
    use HasFactory;

    protected $table = 'category_tags';

    protected $guarded = [
        'id'
    ];

    public function subCategoryTags()
    {
        return $this->hasMany(SubCategoryTag::class);
    }
}
