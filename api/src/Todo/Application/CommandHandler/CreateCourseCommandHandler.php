<?php

namespace App\Todo\Application\CommandHandler;

use App\Todo\Application\Command\CreateCourseCommand;
use App\Todo\Domain\Contracts\TodoServiceInterface;
use App\Todo\Domain\Entity\CourseTodo;
use App\Todo\Domain\Entity\Todo;
use App\Todo\Domain\Entity\Url;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateCourseCommandHandler implements MessageHandlerInterface
{
    protected TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    public function __invoke(CreateCourseCommand $command): Todo
    {
        $todo = (new CourseTodo())
            ->setStep($command->step)
            ->setSteps($command->steps)
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
