<?php

namespace App\Repositories;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

    public function updateMember($name, $password, $token, $postalCode, $address, $address2, $address3, $tel)
    {
        $status = 1;
        return $this->member
            ->newQuery()
            ->where("api_token", "=", $token)
            ->update([
                "name" => $name,
                "password" => Hash::make($password),
                "postal_code" => $postalCode,
                "address" => $address,
                "address2" => $address2,
                "address3" => $address3,
                "tel" => $tel,
                "status" => $status,
            ]);
    }
}