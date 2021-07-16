<?php

namespace App\Application\Commands\CreateTodo;

class CreateBaseTodoCommandStrategy implements CreateTodoCommandInterface
{
    public function supports(string $type): bool
    {
        return $type === "base";
    }

    public function createCommand(array $data): object
    {
        return new CreateBaseTodoCommand(
            $data['title'] ?? "",
            $data['description'] ?? null,
            $data['due'] ?? null
        );
    }
}
