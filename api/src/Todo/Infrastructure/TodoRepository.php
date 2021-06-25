<?php

namespace App\Todo\Infrastructure;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;

class TodoRepository implements TodoRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Todo::class)->findAll();
    }

    public function findById(int $id): object
    {
        return $this->entityManager->getRepository(Todo::class)->find($id);
    }

    /**
     */
    public function create(Todo $todo): Todo
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();

        return $todo;
    }

    public function update(Todo $todo): object
    {
        $todoToUpdate = $this->findById($todo->getId());

        $todoToUpdate->setTitle($todo->getTitle());
        $this->entityManager->flush();

        return $todoToUpdate;
    }

    public function remove($id): void
    {
        $todoToRemove = $this->findById($id);

        $this->entityManager->remove($todoToRemove);
        $this->entityManager->flush();
    }
}
