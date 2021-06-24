<?php

namespace App\Todo\Application\QueryHandler;

use App\Todo\Application\Query\FindTodoQuery;
use App\Todo\Infrastructure\TodoRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindTodoQueryHandler implements MessageHandlerInterface
{
    private TodoRepository $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(FindTodoQuery $query): object
    {
        return $this->todoRepository->findById($query->id);
    }
}
