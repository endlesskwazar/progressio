<?php

namespace App\Todo\Application\Media;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\MediaTodo;
use App\Todo\Domain\Entity\Todo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateMediaCommandHandler implements MessageHandlerInterface
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateMediaCommand $command): Todo
    {
        $todo = new MediaTodo();
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

        if ($command->duration) {
            $todo->setPages($command->pages);
        }

        if ($command->pause) {
            $todo->setPage($command->page);
        }

        return $this->todoRepository->create($todo);
    }
}
