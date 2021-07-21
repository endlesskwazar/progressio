<?php

namespace App\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_learning_materials_read")
 * @ORM\HasLifecycleCallbacks
 */
class ReadTodo extends LearningMaterialTodo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private string $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $pages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $page;

    private string $type = self::READ_TYPE;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null,
        ?int $pages = null,
        ?int $page = null
    ) {
        parent::__construct($title, $description, $due, $review, $rating);
        $this->pages = $pages;
        $this->page = $page;
    }

    /**
     * @return int|null
     */
    public function getPages(): ?int
    {
        return $this->pages;
    }

    /**
     * @param int|null $pages
     */
    public function setPages(?int $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public  function getType(): string
    {
        return $this->type;
    }

    public function getProgress(): ?float
    {
        if ($this->pages === null || $this->page === null) {
            return null;
        }

        $progress = ($this->page / $this->pages ) * 100;

        return number_format((float)$progress, 2, '.', '');
    }
}
