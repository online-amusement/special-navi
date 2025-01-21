<?php

namespace App\Services;

use App\Repositories\MemberManagementRepository;

class MemberManagementService
{
    protected $memberManagementRepository;

    public function __construct(MemberManagementRepository $memberManagementRepository)
    {
        $this->memberManagementRepository = $memberManagementRepository;
    }

    public function searchMember($name, $email, $status, $sort)
    {
        return $this->memberManagementRepository->searchMember($name, $email, $status, $sort);
    }

    public function findBy($field, $operator, $value)
    {
        return $this->memberManagementRepository->findBy($field, $operator, $value);
    }

    public function memberEdit($id, $name, $email, $postalCode, $address, $address2, $address3, $tel, $status)
    {
        return $this->memberManagementRepository->memberEdit($id, $name, $email, $postalCode, $address, $address2, $address3, $tel, $status);
    }
}