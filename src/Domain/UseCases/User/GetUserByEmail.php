<?php

namespace DatingApp\Backend\Domain\UseCases\User;

use DatingApp\Backend\Domain\Entities\User;
use DatingApp\Backend\Domain\Repositories\UserRepository;

class GetUserByEmail
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $email): User
    {
        return $this->userRepository->findByEmail($email);
    }
}
