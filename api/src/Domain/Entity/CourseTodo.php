<?php

namespace App\Domain\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_learning_materials_course")
 * @ORM\HasLifecycleCallbacks
 */
class CourseTodo extends LearningMaterialTodo
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
    private ?int $steps;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $step;

    /**
     * @return int|null
     */
    public function getSteps(): ?int
    {
        return $this->steps;
    }

    /**
     * @param int|null $steps
     */
    public function setSteps(?int $steps): void
    {
        $this->steps = $steps;
    }

    /**
     * @return int|null
     */
    public function getStep(): ?int
    {
        return $this->step;
    }

    /**
     * @param int|null $step
     */
    public function setStep(?int $step): void
    {
        $this->step = $step;
    }

    public function __construct(
        string $title,
        ?string $description = null,
        ?DateTimeImmutable $due = null,
        ?string $review = null,
        ?int $rating = null,
        ?int $steps = null,
        ?int $step = null
    ) {
        parent::__construct($title, $description, $due, $review, $rating);
        $this->steps = $steps;
        $this->step = $step;
    }

    public static function getType(): string
    {
        return self::COURSE_TYPE;
    }

    public function getProgress(): ?float
    {
        if ($this->steps === null || $this->step === null) {
            return null;
        }

        $progress = ($this->steps / $this->step) * 100;

        return number_format((float)$progress, 2, '.', '');
    }
}
