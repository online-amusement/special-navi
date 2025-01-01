<?php
namespace App\Repositories;

use App\Models\EmailVerification;
use App\Models\Member;
use Carbon\Carbon;

class EmailVerificationRepository
{
    protected $emailVerification;
    protected $member;

    public function __construct(EmailVerification $emailVerification, Member $member)
    {
        $this->emailVerification = $emailVerification;
        $this->member = $member;
    }
    //仮登録作成
    public function temporaryRegistration($email, $token) 
    {
        //現在日時の30分後(有効期限)
        $expiration = Carbon::now()->addMinutes(30);

        return $this->emailVerification
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
                "api_token" => $token
            ]);
    }
    //仮登録の際にmembersテーブルにemailが存在してるか確認
    public function isExistEmail($email) {
        return $this->member
            ->newQuery()
            ->where("email", $email)
            ->exists();
    }
}