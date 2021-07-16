<?php

namespace App\Application\Commands\CreateTodo;

class CreateReadTodoCommandStrategy implements CreateTodoCommandInterface
{
    public function supports(string $type): bool
    {
        return $type === "read";
    }

    public function createCommand(array $data): object
    {
        return new CreateReadTodoCommand(
            $data['title'] ?? "",
            $data['description'] ?? null,
            $data['due'] ?? null,
            $data['review'] ?? null,
            $data['rating'] ?? null,
            $data['pages'] ?? null,
            $data['page'] ?? null
        );
    }
}
