<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Services\UserServiceInterface;
use App\Domain\Entity\User;
use App\Infrastructure\Contracts\Auth\AuthServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AuthService implements AuthServiceInterface
{
    private UserServiceInterface $userService;
    private UserPasswordHasherInterface $userPasswordHasher;
    private JWTTokenManagerInterface $JWTManager;

    public function __construct(
        UserServiceInterface $userService,
        UserPasswordHasherInterface $userPasswordHasher,
        JWTTokenManagerInterface $JWTManager
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userService = $userService;
        $this->JWTManager = $JWTManager;
    }

    public function register(User $user): void
    {
        $hashedPassword = $this->userPasswordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        $this->userService->save($user);
    }

    public function getToken(string $email, string $password): string
    {
        $user = $this->userService->findByEmail($email);

        if (!$this->userPasswordHasher->isPasswordValid($user, $password)) {
            throw new \Exception("Password mismatch");
        }

        return $this->JWTManager->createFromPayload($user, [
            'id' => $user->getId(),
            'name' => $user->getName()
        ]);
    }
}
