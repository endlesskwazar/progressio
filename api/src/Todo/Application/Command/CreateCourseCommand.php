<?php

namespace App\Todo\Application\Command;

class CreateCourseCommand extends AbstractCreateTodoCommand
{
    public ?int $steps = null;
    public ?int $step = null;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?array $urls,
        ?int $steps,
        ?int $step
    ) {
        parent::__construct($title, $body, $due, $done, $urls);

        $this->steps = $steps;
        $this->step = $step;
    }
}
