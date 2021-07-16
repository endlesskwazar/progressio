<?php

namespace App\Application\Handlers\Commands;

use App\Application\Commands\Auth\LoginUserCommand;
use App\Domain\Contracts\Repositories\UserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginUserCommandHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;
    private JWTTokenManagerInterface $JWTManager;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        JWTTokenManagerInterface $JWTManager,
        UserPasswordHasherInterface $hasher
    ) {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->JWTManager = $JWTManager;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(LoginUserCommand $command): ?string
    {
        $user = $this->userRepository->findByEmail($command->email);

        if ($user === null) {
            throw new \Exception("asd");
        }

        if (!$this->hasher->isPasswordValid($user, $command->password)) {
            throw new \Exception("qwe");
        }

        $payload = [
            'id' => $user->getId(),
            'name' => $user->getName()
        ];

        return $this->JWTManager->createFromPayload($user, $payload);
    }
}
