<?php

namespace DatingApp\Backend\Domain\UseCases\User;

use DatingApp\Backend\Domain\Entities\User;
use DatingApp\Backend\Domain\Repositories\UserRepository;

class CreateUserInteractor
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): bool
    {
        $user = new User;

        $user->setEmail("simon@mkoveni.com");
        $user->setName("Simon Hlengani");
        $user->setPassword("password");

        return $this->userRepository->save($user);
    }
}
