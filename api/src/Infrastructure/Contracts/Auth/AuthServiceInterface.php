<?php

namespace App\Infrastructure\Contracts\Auth;

use App\Domain\Entity\User;

interface AuthServiceInterface
{
    public function register(User $user): void;
    public function getToken(string $email, string $password): TokenInterface;
}