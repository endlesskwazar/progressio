<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use App\Domain\Entity\BaseTodo;

class TodoService implements TodoServiceInterface
{
    protected TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function save(BaseTodo $todo): BaseTodo
    {
        return $this->todoRepository->save($todo);
    }
}
