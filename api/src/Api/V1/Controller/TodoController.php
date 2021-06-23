<?php

namespace App\Api\V1\Controller;

use App\Api\V1\Transformer\TodoTransformer;
use App\Todo\Application\Command\CreateTodoCommand;
use App\Todo\Application\Query\FindTodoQuery;
use App\Todo\Application\Query\ListTodosQuery;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;

class TodoController
{
    protected Manager $manager;
    protected TodoTransformer $todoTransformer;

    public function __construct(Manager $manager, TodoTransformer $todoTransformer)
    {
        $this->manager = $manager;
        $this->todoTransformer = $todoTransformer;
    }

    /**
     * @Route  ("/api/v1/todos", methods={"GET"})
     * @param MessageBusInterface $queryBus
     * @return JsonResponse
     */
    public function list(MessageBusInterface $queryBus): JsonResponse
    {
        $envelope = $queryBus->dispatch(new ListTodosQuery());
        $handledStamp = $envelope->last(HandledStamp::class);
        $todos = $handledStamp->getResult();

        $todosCollection = new Collection($todos, $this->todoTransformer);
        $transformedTodos = $this->manager->createData($todosCollection);
        return new JsonResponse($transformedTodos->toArray());
    }


    /**
     * @Route  ("/api/v1/todos/{id}", methods={"GET"})
     * @param integer $id
     * @param MessageBusInterface $queryBus
     * @return JsonResponse
     */
    public function getOne(int $id, MessageBusInterface $queryBus): JsonResponse
    {
        $envelope = $queryBus->dispatch(new FindTodoQuery($id));
        $handledStamp = $envelope->last(HandledStamp::class);
        $queryResult = $handledStamp->getResult();

        $todo = new Item($queryResult, $this->todoTransformer, 'todo');
        $transformedTodo = $this->manager->createData($todo);
        return new JsonResponse($transformedTodo->toArray());
    }

    /**
     * @Route  ("/api/v1/todos", methods={"POST"})
     */
    public function create(Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        $data = $request->request->all();

        $createCommand = new CreateTodoCommand($data['title']);

        $envelope = $commandBus->dispatch($createCommand);
        $handledStamp = $envelope->last(HandledStamp::class);
        $commandResult = $handledStamp->getResult();

        $todo = new Item($commandResult, $this->todoTransformer, 'todo');
        $transformedTodo = $this->manager->createData($todo);
        return new JsonResponse($transformedTodo->toArray());
    }
}
