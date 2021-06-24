<?php

namespace App\Todo\Application\Todo\CommandHandler;

use App\Todo\Application\Todo\Command\RemoveTodoCommand;
use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RemoveTodoCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(RemoveTodoCommand $command): void
    {
        $this->todoRepository->remove($command->id);
    }
}
