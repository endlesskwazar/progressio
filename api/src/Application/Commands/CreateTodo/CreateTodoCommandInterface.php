<?php

namespace App\Application\Commands\CreateTodo;

interface CreateTodoCommandInterface
{
    public function supports(string $type): bool;
    public function createCommand(array $data): object;
}
