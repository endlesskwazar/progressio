<?php

namespace App\Application\Commands\CreateTodo;

use App\Application\Utils\AbstractValueObject;
use DateTimeImmutable;

final class CreateBaseTodoCommand extends AbstractValueObject
{
    public string $title;
    public ?string $description;
    public ?DateTimeImmutable $due;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
    }
}
