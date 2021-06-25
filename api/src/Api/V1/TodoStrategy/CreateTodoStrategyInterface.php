<?php

namespace App\Api\V1\TodoStrategy;

use Symfony\Component\HttpFoundation\Request;

interface CreateTodoStrategyInterface
{
    public function check(string $type): bool;
    public function handle(Request $request): object;
}
