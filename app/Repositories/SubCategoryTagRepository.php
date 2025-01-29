<?php

namespace App\Repositories;

use App\Models\SubCategoryTag;

class SubCategoryTagRepository
{
    protected $subCategoryTag;

    const DESC = "desc";
    const ASC = "asc";
    
    public function __construct(SubCategoryTag $subCategoryTag)
    {
        $this->subCategoryTag = $subCategoryTag;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->subCategoryTag
            ->newQuery()
            ->where($field, $operator, $value);
    }

    public function relationWithFindBy($field, $operator, $value)
    {
        return $this->subCategoryTag
            ->newQuery()
            ->with('categoryTag')
            ->where($field, $operator, $value);
    }

    public function searchSubCategoryTag($categoryTagId, $name, $status, $sort)
    {
        $subCategoryTags = $this->subCategoryTag->newQuery();
        if($categoryTagId != null) {
            $subCategoryTags = $this->subCategoryTag->where("category_tag_id", $categoryTagId);
        }
        if($name != null)
        {
            $subCategoryTags = $this->subCategoryTag->where("name", $name);
        }
        if($status != null)
        {
            $subCategoryTags = $this->subCategoryTag->where("status", $status);
        }
        if($sort == "降順") {
            return $subCategoryTags
                ->with("categoryTag")
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $subCategoryTags
            ->with("categoryTag")
            ->orderBy("id", self::ASC)
            ->paginate(10);
        }
    }

    public function subCategoryTagEdit($id, $categoryTagId, $name, $status)
    {
        return $this->subCategoryTag
            ->newQuery()
            ->updateOrCreate(
                ["id" => $id],
                [
                    "category_tag_id" => $categoryTagId,
                    "name" => $name,
                    "status" => $status
                ],
            );
    }
}