<?php

namespace App\Todo\Infrastructure;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository implements TodoRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function findAll(): array
    {
        $em = $this->getEntityManager();

        return $em->getRepository(Todo::class)->findAll();
    }

    public function findById(int $id): object
    {
        $em = $this->getEntityManager();

        return $em->getRepository(Todo::class)->find($id);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function create(Todo $todo): Todo
    {
        $em = $this->getEntityManager();

        $em->persist($todo);
        $em->flush();

        return $todo;
    }
}
