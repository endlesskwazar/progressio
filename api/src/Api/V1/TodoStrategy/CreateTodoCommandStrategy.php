<?php

namespace App\Api\V1\TodoStrategy;

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

    public function getCommandFromRequest(Request $request): ?object
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
