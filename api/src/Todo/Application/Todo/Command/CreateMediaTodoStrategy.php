<?php

namespace App\Todo\Application\Todo\Command;

use App\Todo\Application\Media\Command\CreateMediaCommand;
use App\Todo\Application\Todo\Command\Contract\CreateTodoStrategyInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateMediaTodoStrategy implements CreateTodoStrategyInterface
{
    public function check(string $type): bool
    {
        return $type === 'media';
    }

    public function handle(Request $request): object
    {
        return new CreateMediaCommand(
            $request->get('title'),
            $request->get('body'),
            $request->get('due'),
            $request->get('done'),
            $request->get('duration'),
            $request->get('pause'),
        );
    }
}
