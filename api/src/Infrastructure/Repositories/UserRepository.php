<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\Entity\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function create(User $entity): User
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function findByEmail(string $email): User
    {
        return $this->getRepository()->findOneBy(array('email' => $email));
    }

    public function findById(int $id): User
    {
        return $this->getRepository()->find($id);
    }

    protected function getClass(): string
    {
        return User::class;
    }
}
