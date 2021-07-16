<?php

namespace App\Application\Commands\CreateTodo;

use App\Application\Utils\AbstractValueObject;
use DateTimeImmutable;

class CreateCourseTodoCommand extends AbstractValueObject
{
    public string $title;
    public ?string $description;
    public ?DateTimeImmutable $due;
    public ?string $review;
    public ?int $rating;
    public ?int $steps;
    public ?int $step;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null,
        ?int $steps = null,
        ?int $step = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
        $this->review = $review;
        $this->rating = $rating;
        $this->steps = $steps;
        $this->step = $step;
    }
}
