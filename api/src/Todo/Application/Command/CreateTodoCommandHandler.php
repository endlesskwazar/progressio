<?php

namespace App\Todo\Application\Command;

use App\Todo\Domain\Contracts\TodoRepositoryInterface;
use App\Todo\Domain\Entity\Todo;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateTodoCommandHandler
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
     * @param  CreateTodoCommand $command
     * @throws BadRequestHttpException
     */
    public function handle(CreateTodoCommand $command): Todo
    {
        $violations = $this->validator->validate($command);

        if (count($violations) !== 0) {
            $error = $violations->get(0)->getMessage();
            throw new BadRequestHttpException($error);
        }

        $todo = new Todo();
        $todo->setTitle($command->title);

        return $this->repository->create($todo);
    }
}
