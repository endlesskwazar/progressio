<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function create(User $entity): User;
    public function findByEmail(string $email): User;
    public function findById(int $id): User;
}
