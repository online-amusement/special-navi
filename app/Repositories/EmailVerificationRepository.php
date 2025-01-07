<?php
namespace App\Repositories;

use App\Models\TemporaryRegistration;
use App\Models\Member;
use Carbon\Carbon;

class EmailVerificationRepository
{
    protected $temporaryRegistration;
    protected $member;

    public function __construct(TemporaryRegistration $temporaryRegistration, Member $member)
    {
        $this->temporaryRegistration = $temporaryRegistration;
        $this->member = $member;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->temporaryRegistration
            ->newQuery()
            ->where($field, $operator, $value)
            ->first();
    }
    //仮登録作成
    public function temporaryRegist($email, $token) 
    {
        //現在日時の30分後(有効期限)
        $expiration = Carbon::now()->addMinutes(30);

        return $this->temporaryRegistration
            ->newQuery()
            ->create([
                "email" => $email,
                "token" => $token,
                "expiration_date" => $expiration
            ]);
    }
    //仮登録の際のmember登録(email,token)
    public function temporaryMember($email, $token)
    {
        return $this->member
            ->newQuery()
            ->create([
                "email" => $email,
                "api_token" => $token,
                "status" => 0
            ]);
    }
    //仮登録の際にmembersテーブルにemailが存在してるか確認
    public function isExistEmail($email) 
    {
        return $this->member
            ->newQuery()
            ->where("email", "=", $email)
            ->exists();
    }
}