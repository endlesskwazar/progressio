<?php

namespace App\Todo\Application\Command;

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
