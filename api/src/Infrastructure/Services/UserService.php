<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\Contracts\Services\UserServiceInterface;
use App\Domain\Entity\User;

final class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function save(User $user): User
    {
        return $this->userRepository->create($user);
    }

    public function findByEmail(string $email): User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findById(string $id): User
    {
        return $this->userRepository->findById($id);
    }
}