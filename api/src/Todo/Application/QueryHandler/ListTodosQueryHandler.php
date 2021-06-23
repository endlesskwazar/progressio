<?php

namespace App\Todo\Application\QueryHandler;

use App\Todo\Application\Query\ListTodosQuery;
use App\Todo\Infrastructure\TodoRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ListTodosQueryHandler implements MessageHandlerInterface
{
    private TodoRepository $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(ListTodosQuery $query): array
    {
        return $this->todoRepository->findAll();
    }
}
