<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Entity\BaseTodo;

class TodoRepository extends AbstractRepository implements TodoRepositoryInterface
{
    protected function getClass(): string
    {
        return BaseTodo::class;
    }

    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function save(BaseTodo $todo): BaseTodo
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        return $todo;
    }
}
