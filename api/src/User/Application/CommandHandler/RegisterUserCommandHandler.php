<?php

namespace App\User\Application\CommandHandler;

use App\User\Application\Command\RegisterUserCommand;
use App\User\Domain\Contract\UserRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterUserCommandHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterUserCommand $command)
    {
        $user = new User();
    }
}
