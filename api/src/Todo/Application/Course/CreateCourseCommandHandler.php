<?php

namespace App\Todo\Application\Course;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\CourseTodo;
use App\Todo\Domain\Entity\Todo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateCourseCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateCourseCommand $command): Todo
    {
        $todo = new CourseTodo();
        $todo->setTitle($command->title);

        if ($command->body) {
            $todo->setBody($command->body);
        }

        if ($command->done !== null) {
            $todo->setDone($command->done);
        }

        if ($command->due) {
            $dueDate = DateTime::createFromFormat('Y-m-d H:i:s', $command->due);
            $todo->setDue($dueDate);
        }

        if ($command->steps) {
            $todo->setPages($command->steps);
        }

        if ($command->step) {
            $todo->setPage($command->step);
        }

        return $this->todoRepository->create($todo);
    }
}
