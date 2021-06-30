<?php

namespace App\Todo\Application\CommandHandler;

use App\Todo\Application\Command\CreateMediaCommand;
use App\Todo\Domain\Contracts\TodoServiceInterface;
use App\Todo\Domain\Entity\MediaTodo;
use App\Todo\Domain\Entity\Todo;
use App\Todo\Domain\Entity\Url;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateMediaCommandHandler implements MessageHandlerInterface
{
    private TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    public function __invoke(CreateMediaCommand $command): Todo
    {
        $todo = (new MediaTodo())
        ->setDuration($command->duration)
        ->setPause($command->pause)
        ->setDone($command->done)
        ->setTitle($command->title)
        ->setBody($command->body);

        // if command have url data convert it to Url entity and add
        if ($command->urls && count($command->urls)) {
            foreach ($command->urls as $url) {
                $todo->addUrl(new Url(
                    $url['src'],
                    $url['description']
                ));
            }
        }

        return $this->todoService->create($todo);
    }
}
