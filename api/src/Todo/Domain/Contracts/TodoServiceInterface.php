<?php

namespace App\Todo\Domain\Contracts;

use App\Todo\Domain\Entity\Todo;

interface TodoServiceInterface
{
    public function create(Todo $todo): Todo;
}
