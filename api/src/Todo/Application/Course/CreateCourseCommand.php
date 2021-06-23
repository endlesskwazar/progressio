<?php

namespace App\Todo\Application\Course;

class CreateCourseCommand
{
    public string $title;
    public ?string $body;
    public ?string $due;
    public ?bool $done;
    public ?int $steps;
    public ?int $step;

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
