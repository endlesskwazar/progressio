<?php

namespace App\Todo\Application\CommandHandler;

use App\Todo\Application\Command\CreateTodoCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use DateTime;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateTodoCommandHandler implements MessageHandlerInterface
{
    protected TodoRepositoryInterface $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Creates new project.
     *
     * @param CreateTodoCommand $command
     * @return Todo
     */
    public function __invoke(CreateTodoCommand $command): Todo
    {
        $todo = new Todo();
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

        return $this->repository->create($todo);
    }
}
