<?php

namespace App\Api\V1\Controller;

use App\Api\V1\TodoStrategy\CreateTodoCommandStrategy;
use App\Api\V1\Transformer\TodoTransformer;
use App\Shared\Application\Exception\TestException;
use App\Todo\Application\Todo\Command\RemoveTodoCommand;
use App\Todo\Application\Todo\Command\UpdateTodoCommand;
use App\Todo\Application\Query\FindTodoQuery;
use App\Todo\Application\Todo\Query\ListTodosQuery;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;

class TodoController extends AbstractController
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
        throw new TestException("qwe");
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
    public function create(
        Request $request,
        MessageBusInterface $commandBus,
        CreateTodoCommandStrategy $createTodoCommandStrategy
    ): JsonResponse {
        $command = $createTodoCommandStrategy->getCommandFromRequest($request);

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $commandResult = $handledStamp->getResult();

        $todo = new Item($commandResult, $this->todoTransformer, 'todo');
        $transformedTodo = $this->manager->createData($todo);
        return new JsonResponse($transformedTodo->toArray());
    }

    /**
     * @Route  ("/api/v1/todos/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        $data = $request->request->all();

        $updateTodoCommand = new UpdateTodoCommand($id, $data['title']);

        $envelope = $commandBus->dispatch($updateTodoCommand);
        $handledStamp = $envelope->last(HandledStamp::class);
        $commandResult = $handledStamp->getResult();

        $todo = new Item($commandResult, $this->todoTransformer, 'todo');
        $transformedTodo = $this->manager->createData($todo);
        return new JsonResponse($transformedTodo->toArray());
    }

    /**
     * @Route  ("/api/v1/todos/{id}", methods={"DELETE"})
     */
    public function remove(int $id, MessageBusInterface $commandBus): JsonResponse
    {
        $removeTodoCommand = new RemoveTodoCommand($id);
        $commandBus->dispatch($removeTodoCommand);
        $response = new JsonResponse();
        $response->setStatusCode(204);
        return $response;
    }
}
