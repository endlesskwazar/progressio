<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use App\Domain\Contracts\Entity\TodoInterface;
use Symfony\Component\Security\Core\Security;

class TodoService implements TodoServiceInterface
{
    protected TodoRepositoryInterface $todoRepository;
    protected Security $security;

    public function __construct(
        TodoRepositoryInterface $todoRepository,
        Security $security
    ) {
        $this->todoRepository = $todoRepository;
        $this->security = $security;
    }

    public function save(TodoInterface $todo): TodoInterface
    {
        return $this->todoRepository->save($todo);
    }

    public function saveToMe(TodoInterface $todo): TodoInterface
    {
        $todo->setUser($this->security->getUser());
        return  $this->todoRepository->save($todo);
    }
}
