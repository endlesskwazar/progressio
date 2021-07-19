<?php

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Contracts\Services\TodoServiceInterface;
use App\Domain\Contracts\Entity\TodoInterface;

class TodoService implements TodoServiceInterface
{
    protected TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function save(TodoInterface $todo): TodoInterface
    {
        return $this->todoRepository->save($todo);
    }
}
