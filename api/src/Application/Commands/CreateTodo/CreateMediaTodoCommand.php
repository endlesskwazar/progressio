<?php

namespace App\Application\Commands\CreateTodo;

use App\Application\Utils\AbstractValueObject;
use DateTimeImmutable;

final class CreateMediaTodoCommand extends AbstractValueObject
{
    public string $title;
    public ?string $description;
    public ?DateTimeImmutable $due;
    public ?string $review;
    public ?int $rating;
    public ?string $duration;
    public ?string $pause;

    public function __construct(
        string $title,
        ?string $description,
        ?DateTimeImmutable $due,
        ?string $review,
        ?int $rating,
        ?string $duration,
        ?string $pause
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
        $this->review = $review;
        $this->rating = $rating;
        $this->duration = $duration;
        $this->pause = $pause;
    }
}
