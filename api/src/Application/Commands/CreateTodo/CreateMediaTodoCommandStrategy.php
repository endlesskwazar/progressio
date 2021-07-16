<?php

namespace App\Application\Commands\CreateTodo;

class CreateMediaTodoCommandStrategy implements CreateTodoCommandInterface
{
    public function supports(string $type): bool
    {
        return $type === "media";
    }

    public function createCommand(array $data): object
    {
        return new CreateMediaTodoCommand(
            $data['title'] ?? "",
            $data['description'] ?? null,
            $data['due'] ?? null,
            $data['review'] ?? null,
            $data['rating'] ?? null,
            $data['duration'] ?? null,
            $data['pause'] ?? null
        );
    }
}
