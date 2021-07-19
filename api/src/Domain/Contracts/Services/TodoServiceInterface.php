<?php

namespace App\Domain\Contracts\Services;

use App\Domain\Entity\BaseTodo;

interface TodoServiceInterface
{
    public function save(BaseTodo $todo): BaseTodo;
}
