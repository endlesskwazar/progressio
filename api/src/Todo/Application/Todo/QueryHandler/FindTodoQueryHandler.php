<?php

namespace App\Todo\Application\Todo\QueryHandler;

use App\Todo\Application\Todo\Query\FindTodoQuery;
use App\Todo\Domain\Entity\Todo;
use App\Todo\Infrastructure\TodoRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindTodoQueryHandler implements MessageHandlerInterface
{
    private TodoRepository $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(FindTodoQuery $query): Todo
    {
        /** @var Todo $todo */
        $todo = $this->todoRepository->findById($query->id);

        return $todo;
    }
}
