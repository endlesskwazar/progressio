<?php

namespace App\Todo\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BookTodo extends Todo
{
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    private ?int $pages;

    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    private ?int $page;

    /**
     * @ORM\Column(type="string", nullable = true, length=300)
     */
    private ?string $author;

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
}
