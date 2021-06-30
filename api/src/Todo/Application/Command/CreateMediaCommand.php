<?php

namespace App\Todo\Application\Command;

class CreateMediaCommand extends AbstractCreateTodoCommand
{
    public ?string $duration = null;
    public ?string $pause = null;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?array $urls,
        ?string $duration,
        ?string $pause
    ) {
        parent::__construct($title, $body, $due, $done, $urls);

        $this->duration = $duration;
        $this->pause = $pause;
    }
}
