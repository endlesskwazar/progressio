<?php

namespace App\Todo\Application\Command;

abstract class AbstractCreateTodoCommand
{
    public string $title;
    public ?string $body = null;
    public ?string $due = null;
    public ?bool $done = null;
    public ?array $urls = [];

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?array $urls
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->due = $due;
        $this->done = $done;
        $this->urls = $urls;
    }
}
