<?php

namespace App\Todo\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity
 * @ORM\Table(name="todos")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"book" = "BookTodo", "media" = "MediaTodo", "course" = "CourseTodo"})
 * @ORM\HasLifecycleCallbacks
 */
abstract class Todo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private datetime $created;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private ?datetime $updated = null;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    private ?datetime $due = null;

    /**
     * @ORM\Column(type="string",  nullable = true, length=8000)
     */
    private ?string $body = null;

    /**
     * @ORM\Column(type="boolean", length=8000)
     */
    private ?bool $done = false;

    /**
     * @OneToMany(targetEntity="Url", mappedBy="todo")
     */
    private Collection $urls;

    public function __construct()
    {
        $this->urls = new ArrayCollection();
    }

    public function getUrls(): Collection
    {
        return $this->urls;
    }

    public function setUrls(Collection $urls): void
    {
        $this->urls = $urls;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->created = new DateTime("now");
    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate(): void
    {
        $this->updated = new DateTime("now");
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getCreated(): datetime
    {
        return $this->created;
    }

    public function setCreated(datetime $created): void
    {
        $this->created = $created;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): void
    {
        $this->body = $body;
    }

    public function getUpdated(): ?datetime
    {
        return $this->updated;
    }

    public function setUpdated(datetime $updated): void
    {
        $this->updated = $updated;
    }

    public function getDue(): ?datetime
    {
        return $this->due;
    }

    public function setDue(?datetime $due): void
    {
        $this->due = $due;
    }

    public function getDone(): bool
    {
        return $this->done;
    }

    public function setDone(?bool $done): void
    {
        $this->done = $done;
    }
}
