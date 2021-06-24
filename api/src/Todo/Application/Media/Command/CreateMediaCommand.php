<?php

namespace App\Todo\Application\Media\Command;

class CreateMediaCommand
{
    public string $title;
    public ?string $body;
    public ?string $due;
    public ?bool $done;
    public ?string $duration;
    public ?string $pause;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?string $duration,
        ?string $pause
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->due = $due;
        $this->done = $done;
        $this->duration = $duration;
        $this->pause = $pause;
    }
}
