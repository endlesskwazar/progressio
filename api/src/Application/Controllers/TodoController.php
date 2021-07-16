<?php

namespace App\Application\Controllers;

use App\Application\Commands\CreateTodo\CreateTodoCommand;
use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    protected TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @Route("/api/todos", name="todos_list", methods={"GET"})
     */
    public function showAll(TodoRepositoryInterface $t): Response
    {
        dd($t->findAll());
    }

    /**
     * @Route("/api/todos", name="todos_create", methods={"POST"})
     */
    public function create(
        Request $request,
        MessageBusInterface $commandBus,
        CreateTodoCommand $createTodoCommand
    ): Response {
        $type = $request->get('type') ?? "";
        $data = $request->request->all();

        $command = $createTodoCommand->createCommand($type, $data);

        $envelope = $commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);
        $result = $handledStamp->getResult();

        dd($result);

        return $this->json(['qwe' => $title]);
    }
}
