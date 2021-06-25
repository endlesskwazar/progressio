<?php

namespace App\Todo\Application\Media\Command;

class CreateMediaCommand
{
    public string $title;
    public ?string $body = null;
    public ?string $due = null;
    public ?bool $done = null;
    public ?string $duration = null;
    public ?string $pause = null;

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
