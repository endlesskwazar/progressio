<?php

namespace App\Todo\Application\Todo\Command\Contract;

use Symfony\Component\HttpFoundation\Request;

interface CreateTodoStrategyInterface
{
    public function check(string $type): bool;
    public function handle(Request $request): object;
}
