<?php
namespace App\Services;

use App\Repositories\EmailVerificationRepository;

class EmailVerificationService
{
    protected $emailVerificationRepository;

    public function __construct(EmailVerificationRepository $emailVerificationRepository)
    {
        $this->emailVerificationRepository = $emailVerificationRepository;
    }

    public function temporaryRegistration($email, $token)
    {
        return $this->emailVerificationRepository->temporaryRegistration($email, $token);
    }

    public function temporaryMember($email, $token)
    {
        return $this->emailVerificationRepository->temporaryMember($email, $token);
    }

    public function isExistEmail($email)
    {
        return $this->isExistEmail($email);
    }
}
