<?php

namespace App\Application\Commands\CreateTodo;

use App\Application\Utils\AbstractValueObject;
use DateTimeImmutable;

final class CreateReadTodoCommand extends AbstractValueObject
{
    public string $title;
    public ?string $description;
    public ?DateTimeImmutable $due;
    public ?string $review;
    public ?int $rating;
    public ?int $pages;
    public ?int $page;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null,
        ?int $pages = null,
        ?int $page = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
        $this->review = $review;
        $this->rating = $rating;
        $this->pages = $pages;
        $this->page = $page;
    }
}