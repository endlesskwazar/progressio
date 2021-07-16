<?php

namespace App\Application\Commands\CreateTodo;

use InvalidArgumentException;

final class CreateTodoCommand
{
    /** @var array $strategies */
    private array $strategies = [];

    public function addStrategy(CreateTodoCommandInterface $createTodoCommand): void
    {
        $this->strategies[] = $createTodoCommand;
    }

    public function createCommand(string $type, array $data): object
    {
        $command = null;

        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($type)) {
                $command = $strategy->createCommand($data);
                break;
            }
        }

        if ($command === null) {
            throw new InvalidArgumentException("Wrong todo type");
        }

        return $command;
    }
}
