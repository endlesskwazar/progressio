<?php

namespace App\Todo\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity
 */
class Url
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private string $src;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private ?string $description = null;

    /**
     * @ManyToOne(targetEntity="Todo", inversedBy="urls")
     * @JoinColumn(name="todo_id", referencedColumnName="id", nullable=false)
     */
    private Todo $todo;

    public function __construct(string $src, ?string $description)
    {
        $this->src = $src;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTodo(): Todo
    {
        return $this->todo;
    }

    public function setTodo(Todo $todo): void
    {
        $this->todo = $todo;
    }
}
