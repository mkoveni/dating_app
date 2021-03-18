<?php

namespace DatingApp\Backend\Domain\Repositories;

use DatingApp\Backend\Domain\Entities\User;

interface UserRepository
{
    function findById(string $id): ?User;

    function findByEmail(string $email): ?User;

    function save(User $user): bool;
}
