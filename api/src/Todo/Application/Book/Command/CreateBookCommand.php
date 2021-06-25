<?php

namespace App\Todo\Application\Book\Command;

class CreateBookCommand
{
    public string $title;
    public ?string $body = null;
    public ?string $due = null;
    public ?bool $done = null;
    public ?int $pages = null;
    public ?int $page = null;
    public ?string $author = null;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?int $pages,
        ?int $page,
        ?string $author
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->due = $due;
        $this->done = $done;
        $this->pages = $pages;
        $this->page = $page;
        $this->author = $author;
    }
}
