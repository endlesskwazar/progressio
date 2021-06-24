<?php

namespace App\Todo\Application\Todo\Command;

use App\Todo\Application\Todo\Command\Contract\CreateTodoStrategyInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateTodoCommandStrategy
{
    /**
     * @var CreateTodoStrategyInterface[]
     */
    private array $strategies = [];

    public function addStrategy(CreateTodoStrategyInterface $strategy): void
    {
        $this->strategies[] = $strategy;
    }

    public function getCommandFromRequest(Request $request)
    {
        $type = $request->get('type');
        $command = null;

        foreach ($this->strategies as $strategy) {
            if ($strategy->check($type)) {
                $command = $strategy->handle($request);
            }
        }

        return $command;
    }
}
