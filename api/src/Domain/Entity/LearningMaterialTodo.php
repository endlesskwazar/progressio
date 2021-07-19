<?php

namespace App\Domain\Entity;

use App\Domain\Contracts\Entity\LearningMaterialProgressInterface;
use BadMethodCallException;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @MappedSuperclass
 * @ORM\Table(name="todo_learning_materials")
 * @ORM\HasLifecycleCallbacks
 */
abstract class LearningMaterialTodo extends BaseTodo implements LearningMaterialProgressInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private ?string $review;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private ?int $rating;

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null
    ) {
        parent::__construct($title, $description, $due);
        $this->review = $review;
        $this->rating = $rating;
    }

    /**
     * @return string|null
     */
    public function getReview(): ?string
    {
        return $this->review;
    }

    /**
     * @param string|null $review
     */
    public function setReview(?string $review): void
    {
        $this->review = $review;
    }

    /**
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int|null $rating
     */
    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @throws BadMethodCallException
     */
    public static function getType(): string
    {
        throw new BadMethodCallException("Todo must implement type");
    }
}
