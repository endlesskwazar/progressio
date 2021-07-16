<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function create(User $entity): object;
    public function findByEmail(string $email): object;
}
