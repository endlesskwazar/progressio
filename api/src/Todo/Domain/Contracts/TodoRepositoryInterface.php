<?php

namespace App\Todo\Domain\Contracts;

use App\Todo\Domain\Entity\Todo;

interface TodoRepositoryInterface
{
    public function findAll();
    public function findById(int $id): object;
    public function create(Todo $todo): Todo;
    public function update(Todo $todo): object;
    public function remove($id): void;
}
