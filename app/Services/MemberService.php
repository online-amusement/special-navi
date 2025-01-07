<?php

namespace App\Services;

use App\Repositories\MemberRepository;

class MemberService
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->memberRepository->findBy($field, $operator, $value);
    }

    public function updateMember($name, $password, $apiToken, $postalCode, $address, $address2, $address3, $tel)
    {
        return $this->memberRepository->updateMember($name, $password, $apiToken, $postalCode, $address, $address2, $address3, $tel);
    }
}