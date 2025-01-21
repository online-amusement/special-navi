<?php

namespace App\Repositories;

use App\Models\Member;

class MemberManagementRepository
{
    protected $member;

    const DESC = "desc";
    const ASC = "asc";

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->member
            ->newQuery()
            ->where($field, $operator, $value);
    }

    public function searchMember($name, $email, $status, $sort)
    {
        $members = $this->member->newQuery();

        if($name != null) {
            $members = $members->where("name", $name);
        }

        if($email != null) {
            $members = $members->where("email", $email);
        }

        if($status != null) {
            $members = $members->where("status", $status);
        }
        
        if($sort == "降順") {
            return $members 
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $members
                ->orderBy("id", self::ASC)
                ->paginate(10);
        }

    }

    public function memberEdit($id, $name, $email, $postalCode, $address, $address2, $address3, $tel, $status)
    {
        return $this->member
            ->newQuery()
            ->updateOrCreate(
                ["id" => $id],
                [
                    "name" => $name,
                    "email" => $email,
                    "postal_code" => $postalCode,
                    "address" => $address,
                    "address2" => $address2,
                    "address3" => $address3,
                    "tel" => $tel,
                    "status" => $status
                ]
            );
    }
}