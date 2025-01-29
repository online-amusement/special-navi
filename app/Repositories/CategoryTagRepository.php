<?php

namespace App\Repositories;

use App\Models\CategoryTag;

class CategoryTagRepository
{
    protected $categoryTag;
    
    const DESC = "desc";
    const ASC = "asc";

    public function __construct(CategoryTag $categoryTag)
    {
        $this->categoryTag = $categoryTag;
    }

    public function getAll()
    {
        return $this->categoryTag
            ->newQuery()
            ->get();
    }

    public function findBy($field, $operator, $value)
    {
        return $this->categoryTag
            ->newQuery()
            ->where($field, $operator, $value);
    }

    public function searchCategoryTag($name, $status, $sort)
    {
        $categoryTags = $this->categoryTag->newQuery();
    
        if($name != null){
            $categoryTags->where("name", $name);
        }

        if($status != null) {
            $categoryTags->where("status", $status);
        }

        if($sort == "降順") {
            return $categoryTags 
                ->with("subCategoryTags")
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $categoryTags
                ->with("subCategoryTags")
                ->orderBy("id", self::ASC)
                ->paginate(10);
        }
    }

    public function categoryTagEdit($id, $name, $status)
    {
        return $this->categoryTag
            ->newQuery()
            ->updateOrCreate(
                [ "id" => $id ],
                [
                    "name" => $name,
                    "status" => $status
                ]
            );
    }
}