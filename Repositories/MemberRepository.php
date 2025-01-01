<?php

namespace App\Repositories;

use App\Models\Member;
use Illuminate\Support\Str;

class MemberRepository
{
    protected $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->member
            ->newQuery()
            ->where($field, $operator, $value)
            ->first();
    }

    public function updateMember($name, $password, $apiToken, $postalCode, $address, $tel, $status)
    {
        $token = Str::random(80);
        $apiToken = $token;
        return $this->member
            ->newQuery()
            ->update([
                "name" => $name,
                "password" => $password,
                "api_token" => $apiToken,
                "postal_code" => $postalCode,
                "address" => $address,
                "tel" => $tel,
                "status" => $status,
            ]);

    }
}