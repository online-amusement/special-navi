<?php

namespace App\Services;

use App\Repositories\CategoryTagRepository;

class CategoryTagService
{
    protected $categoryTagRepository;

    public function __construct(CategoryTagRepository $categoryTagRepository)
    {
        $this->categoryTagRepository = $categoryTagRepository;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->categoryTagRepository->findBy($field, $operator, $value);
    }

    public function searchCategoryTag($name, $status, $sort)
    {
        return $this->categoryTagRepository->searchCategoryTag($name, $status, $sort);
    }

    public function categoryTagEdit($id, $name, $status)
    {
        return $this->categoryTagRepository->categoryTagEdit($id, $name, $status);
    }
}