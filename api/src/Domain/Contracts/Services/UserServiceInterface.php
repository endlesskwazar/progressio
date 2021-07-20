<?php

namespace App\Domain\Contracts\Services;

use App\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserServiceInterface
{
    /**
     * Create new user
     *
     * @param User $user User entity
     * @return User Created user entity
     */
    public function save(User $user): User;

    /**
     * Find user by email
     *
     * @param string $email user email
     * @return User Founded user entity
     */
    public function findByEmail(string $email): User;

    /**
     * Find user by id
     *
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;
}
