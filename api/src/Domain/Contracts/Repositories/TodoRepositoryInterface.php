<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\Entity\BaseTodo;

interface TodoRepositoryInterface
{
    public function save(BaseTodo $todo): BaseTodo;

    public function findAll(): array;
}
