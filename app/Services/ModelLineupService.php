<?php

namespace App\Services;

use App\Repositories\ModelLineupRepository;

class ModelLineupService
{
    protected $modelLineupRepository;

    public function __construct(ModelLineupRepository $modelLineupRepository)
    {
        $this->modelLineupRepository = $modelLineupRepository;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->modelLineupRepository->findBy($field, $operator, $value);
    }

    public function searchModelLineup($name, $amount, $startedAt, $endedAt, $sort)
    {
        return $this->modelLineupRepository->searchModelLineup($name, $amount, $startedAt, $endedAt, $sort);
    }

    public function modelLineupCreateOrUpdate($id, $name, $detail, $amount, $previewFile, $downloadFile)
    {
        return $this->modelLineupRepository->modelLineupCreateOrUpdate($id, $name, $detail, $amount, $previewFile, $downloadFile);
    }
}