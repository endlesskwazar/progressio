<?php

namespace App\Application\Handlers\Commands;

use App\Application\Commands\CreateTodo\CreateReadTodoCommand;
use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Entity\BaseTodo;
use App\Domain\Entity\ReadTodo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateReadTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateReadTodoCommand $command): BaseTodo
    {
        $todo = new ReadTodo(
            $command->title,
            $command->description,
            $command->due,
            $command->review,
            $command->rating,
            $command->pages,
            $command->page
        );

        return $this->todoRepository->save($todo);
    }
}
