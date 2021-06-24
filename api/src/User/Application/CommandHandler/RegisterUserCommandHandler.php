<?php

namespace App\User\Application\CommandHandler;

use App\User\Application\Command\RegisterUserCommand;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterUserCommandHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterUserCommand $command): object
    {
        $user = new User();
        $user->setEmail($command->email);
        $user->setName($command->name);

        $hashedPassword = password_hash($command->password, PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);

        return $this->userRepository->create($user);
    }
}
