<?php

namespace App\Application\Handlers\Commands;

use App\Application\Commands\CreateTodo\CreateMediaTodoCommand;
use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Entity\BaseTodo;
use App\Domain\Entity\MediaTodo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateMediaTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateMediaTodoCommand $command): BaseTodo
    {
        $todo = new MediaTodo(
            $command->title,
            $command->description,
            $command->due,
            $command->review,
            $command->rating,
            $command->duration,
            $command->pause
        );

        return $this->todoRepository->save($todo);
    }
}
