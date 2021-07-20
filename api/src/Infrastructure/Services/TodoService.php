<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Contracts\Services\UserServiceInterface;
use Symfony\Component\Security\Core\Security;

final class TodoService implements TodoServiceInterface
{
    private TodoRepositoryInterface $todoRepository;
    private Security $security;
    private UserServiceInterface $userService;

    public function __construct(
        TodoRepositoryInterface $todoRepository,
        Security $security,
        UserServiceInterface $userService
    ) {
        $this->todoRepository = $todoRepository;
        $this->security = $security;
        $this->userService = $userService;
    }

    public function save(TodoInterface $todo): TodoInterface
    {
        return $this->todoRepository->save($todo);
    }

    public function saveToMe(TodoInterface $todo): TodoInterface
    {
        $user = $this->userService->findById($this->security->getUser()->getUserIdentifier());
        $todo->setUser($user);
        return  $this->todoRepository->save($todo);
    }

    public function findMy(): array
    {
        return $this->todoRepository->findByUserId($this->security->getUser()->getUserIdentifier());
    }
}
