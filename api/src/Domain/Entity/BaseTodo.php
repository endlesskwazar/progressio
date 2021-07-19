<?php

namespace App\Domain\Entity;

use App\Domain\Contracts\Entity\TodoInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity
 * @ORM\Table(name="todos")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({
 *     "base" = "BaseTodo",
 *     "read" = "ReadTodo",
 *     "media" = "MediaTodo",
 *     "course" = "CourseTodo",
 * })
 * @ORM\HasLifecycleCallbacks
 */
class BaseTodo implements TodoInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=1600, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="date_immutable", nullable = true, nullable=true)
     */
    private ?DateTimeImmutable $due;

    public function __construct(string $title, ?string $description = null, ?DateTimeImmutable $due = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDue(): ?DateTimeImmutable
    {
        return $this->due;
    }

    /**
     * @param ?DateTimeImmutable $due
     */
    public function setDue(?DateTimeImmutable $due): void
    {
        $this->due = $due;
    }

    public static function getType(): string
    {
        return self::BASE_TYPE;
    }
}
