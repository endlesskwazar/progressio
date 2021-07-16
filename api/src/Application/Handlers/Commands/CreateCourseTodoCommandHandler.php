<?php

namespace App\Application\Handlers\Commands;

use App\Application\Commands\CreateTodo\CreateCourseTodoCommand;
use App\Domain\Contracts\Repositories\TodoRepositoryInterface;
use App\Domain\Entity\BaseTodo;
use App\Domain\Entity\CourseTodo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateCourseTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateCourseTodoCommand $command): BaseTodo
    {
        $todo = new CourseTodo(
            $command->title,
            $command->description,
            $command->due,
            $command->review,
            $command->rating,
            $command->steps,
            $command->step
        );

        return $this->todoRepository->save($todo);
    }
}
