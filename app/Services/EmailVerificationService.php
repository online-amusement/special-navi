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

    public function findBy($field, $operator, $value)
    {
        return $this->emailVerificationRepository->findBy($field, $operator, $value);
    }

    public function temporaryRegist($email, $token)
    {
        return $this->emailVerificationRepository->temporaryRegist($email, $token);
    }

    public function temporaryMember($email, $token)
    {
        return $this->emailVerificationRepository->temporaryMember($email, $token);
    }

    public function isExistEmail($email)
    {
        return $this->emailVerificationRepository->isExistEmail($email);
    }
}
