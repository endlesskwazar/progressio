<?php

namespace App\Application\Common\ArgumentResolvers\Todo;

use App\Domain\Contracts\Entity\TodoInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class TodoRequest
{
    private array $todoRequests = [];

    public function addTodoRequest(TodoRequestInterface $todoRequest): void
    {
        $this->todoRequests[] = $todoRequest;
    }

    /**
     * @throws Exception
     */
    public function getEntityInstanceIfValid(string $type, Request $request): TodoInterface
    {
        $todo = null;

        foreach ($this->todoRequests as $todoRequest) {
            if ($todoRequest->supports($type)) {
                $todo = $todoRequest->getEntityInstance();
            }
        }

        if ($todo === null) {
            throw new Exception("Todo type not supported");
        }

        return $todo;
    }
}