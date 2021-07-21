<?php

namespace App\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_learning_materials_media")
 * @ORM\HasLifecycleCallbacks
 */
class MediaTodo extends LearningMaterialTodo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private ?string $duration;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private ?string $pause;

    private string $type = self::MEDIA_TYPE;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null,
        ?int $duration = null,
        ?int $pause = null
    ) {
        parent::__construct($title, $description, $due, $review, $rating);
        $this->duration = $duration;
        $this->pause = $pause;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     */
    public function setDuration(?string $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return string|null
     */
    public function getPause(): ?string
    {
        return $this->pause;
    }

    /**
     * @param string|null $pause
     */
    public function setPause(?string $pause): void
    {
        $this->pause = $pause;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getProgress(): ?float
    {
        return null;
    }
}
