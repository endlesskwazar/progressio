<?php

namespace App\Todo\Application\CommandHandler;

use App\Todo\Application\Command\UpdateTodoCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(UpdateTodoCommand $command): object
    {
        $todo = new Todo();
        $todo->setId($command->id);
        $todo->setTitle($command->title);

        return $this->todoRepository->update($todo);
    }
}
