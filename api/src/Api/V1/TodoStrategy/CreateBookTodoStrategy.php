<?php

namespace App\Api\V1\TodoStrategy;

use App\Todo\Application\Book\Command\CreateBookCommand;
use Symfony\Component\HttpFoundation\Request;

class CreateBookTodoStrategy implements CreateTodoStrategyInterface
{
    public function check(string $type): bool
    {
        return $type === 'book';
    }

    public function handle(Request $request): object
    {
        return new CreateBookCommand(
            $request->get('title'),
            $request->get('body'),
            $request->get('due'),
            $request->get('done'),
            $request->get('pages'),
            $request->get('page'),
            $request->get('author'),
        );
    }
}
