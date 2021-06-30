<?php

namespace App\Todo\Application\Command;

class CreateBookCommand extends AbstractCreateTodoCommand
{
    public ?int $pages = null;
    public ?int $page = null;
    public ?string $author = null;

    public function __construct(
        string $title,
        ?string $body,
        ?string $due,
        ?bool $done,
        ?array $urls,
        ?int $pages,
        ?int $page,
        ?string $author
    ) {
        parent::__construct($title, $body, $due, $done, $urls);

        $this->pages = $pages;
        $this->page = $page;
        $this->author = $author;
    }
}
