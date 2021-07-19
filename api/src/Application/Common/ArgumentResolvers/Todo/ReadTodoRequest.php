<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Contracts\Entity\TodoInterface;
use App\Domain\Entity\ReadTodo;
use Symfony\Component\HttpFoundation\Request;

class ReadTodoRequest implements TodoRequestInterface
{
    public function supports(string $type): bool
    {
        return ReadTodo::getType() === $type;
    }

    public function getEntityInstance(Request $request): TodoInterface
    {
        // TODO: Implement getEntityInstance() method.
    }

    public function validate(Request $request)
    {
        // TODO: Implement validate() method.
    }
}
