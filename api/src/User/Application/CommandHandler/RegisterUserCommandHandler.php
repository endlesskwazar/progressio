<?php

namespace App\User\Application\CommandHandler;

use App\User\Application\Command\RegisterUserCommand;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserCommandHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordHasherInterface $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    public function __invoke(RegisterUserCommand $command): object
    {
        $user = new User();
        $user->setEmail($command->email);
        $user->setName($command->name);
        $user->setPassword($command->password);

        $hashedPassword = $this->hasher->hashPassword($user, $command->password);
        $user->setPassword($hashedPassword);

        return $this->userRepository->create($user);
    }
}
