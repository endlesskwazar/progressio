<?php

namespace App\User\Domain\Contract;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function create(User $entity): object;
    public function findByEmail(string $email): object;
}
