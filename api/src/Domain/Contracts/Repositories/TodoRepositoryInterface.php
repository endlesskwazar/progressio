<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Contracts\Entity\TodoInterface;

interface TodoRepositoryInterface
{
    public function save(TodoInterface $todo): TodoInterface;

    public function findAll(): array;
}
