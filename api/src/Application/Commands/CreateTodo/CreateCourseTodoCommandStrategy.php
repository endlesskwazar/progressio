<?php

namespace App\Application\Commands\CreateTodo;

class CreateCourseTodoCommandStrategy implements CreateTodoCommandInterface
{
    public function supports(string $type): bool
    {
        return $type === "course";
    }

    public function createCommand(array $data): object
    {
        return new CreateCourseTodoCommand(
            $data['title'] ?? "",
            $data['description'] ?? null,
            $data['due'] ?? null,
            $data['review'] ?? null,
            $data['rating'] ?? null,
            $data['steps'] ?? null,
            $data['step'] ?? null
        );
    }
}
