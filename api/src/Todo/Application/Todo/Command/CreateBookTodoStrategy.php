<?php

namespace App\Todo\Application\Todo\Command;

use App\Todo\Application\Book\Command\CreateBookCommand;
use App\Todo\Application\Todo\Command\Contract\CreateTodoStrategyInterface;
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
