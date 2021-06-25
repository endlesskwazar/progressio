<?php

namespace App\Api\V1\TodoStrategy;

use App\Todo\Application\Media\Command\CreateMediaCommand;
use Symfony\Component\HttpFoundation\Request;

class CreateCourseTodoStrategy implements CreateTodoStrategyInterface
{
    public function check(string $type): bool
    {
        return $type === 'course';
    }

    public function handle(Request $request): object
    {
        return new CreateMediaCommand(
            $request->get('title'),
            $request->get('body'),
            $request->get('due'),
            $request->get('done'),
            $request->get('steps'),
            $request->get('step'),
        );
    }
}
