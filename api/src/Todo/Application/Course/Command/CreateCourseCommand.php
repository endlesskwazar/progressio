<?php

namespace App\Todo\Application\Course\Command;

class CreateCourseCommand
{
    public string $title;
    public ?string $body = null;
    public ?string $due = null;
    public ?bool $done = null;
    public ?int $steps = null;
    public ?int $step = null;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?int $steps,
        ?int $step
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->due = $due;
        $this->done = $done;
        $this->steps = $steps;
        $this->step = $step;
    }
}
