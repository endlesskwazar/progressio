<?php

namespace App\Todo\Application\Book;

class CreateBookCommand
{
    public string $title;
    public ?string $body;
    public ?string $due;
    public ?bool $done;
    public ?int $pages;
    public ?int $page;
    public ?string $author;

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
