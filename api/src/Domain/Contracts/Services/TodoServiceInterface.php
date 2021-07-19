<?php

namespace App\Domain\Contracts\Services;

use App\Domain\Contracts\Entity\TodoInterface;

interface TodoServiceInterface
{
    public function save(TodoInterface $todo): TodoInterface;
}
