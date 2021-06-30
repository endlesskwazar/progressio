<?php

namespace App\Todo\Infrastructure;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Contracts\TodoServiceInterface;
use App\Todo\Domain\Entity\Todo;

class TodoService implements TodoServiceInterface
{
    protected TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function create(Todo $todo): Todo
    {
        return $this->todoRepository->create($todo);
    }
}
