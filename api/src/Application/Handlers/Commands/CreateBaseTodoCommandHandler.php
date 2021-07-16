<?php

namespace App\Application\Handlers\Commands;

use App\Application\Commands\CreateTodo\CreateBaseTodoCommand;
use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Entity\BaseTodo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateBaseTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateBaseTodoCommand $command): BaseTodo
    {
        $todo = new BaseTodo(
            $command->title,
            $command->description,
            $command->due
        );

        return $this->todoRepository->save($todo);
    }
}
