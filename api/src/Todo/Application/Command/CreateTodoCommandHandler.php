<?php

namespace App\Todo\Application\Command;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateTodoCommandHandler implements MessageHandlerInterface
{
    protected $validator;
    protected TodoRepositoryInterface $repository;

    public function __construct(ValidatorInterface $validator, TodoRepositoryInterface $repository)
    {
        $this->validator = $validator;
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

        return $this->repository->create($todo);
    }
}
