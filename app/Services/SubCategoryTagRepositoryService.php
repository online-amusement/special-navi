<?php

namespace App\Services;

use App\Repositories\SubCategoryTagRepository;

class SubCategoryTagRepositoryService
{
    protected $subCategoryTagRepository;

    public function __construct(SubCategoryTagRepository $subCategoryTagRepository)
    {
        $this->subCategoryTagRepository = $subCategoryTagRepository;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->subCategoryTagRepository->findBy($field, $operator, $value);
    }

    public function relationWithFindBy($field, $operator, $value)
    {
        return $this->subCategoryTagRepository->relationWithFindBy($field, $operator, $value);
    }

    public function searchSubCategoryTag($categoryTagId, $name, $status, $sort)
    {
        return $this->subCategoryTagRepository->searchSubCategoryTag($categoryTagId, $name, $status, $sort);
    }

    public function subCategoryTagEdit($id, $categoryTagId, $name, $status)
    {
        return $this->subCategoryTagRepository->subCategoryTagEdit($id, $categoryTagId, $name, $status);
    }
}