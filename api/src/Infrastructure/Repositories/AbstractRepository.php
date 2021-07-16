<?php

namespace App\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class AbstractRepository
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract protected function getClass(): string;

    protected function getRepository(): ObjectRepository
    {
        return $this->entityManager->getRepository($this->getClass());
    }
}
