<?php

namespace App\Uploader\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $originalFileName;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $src;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $kind;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private string $mime;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOriginalName(): string
    {
        return $this->originalFileName;
    }

    public function setOriginalFileName(string $originalFileName): void
    {
        $this->originalFileName = $originalFileName;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): void
    {
        $this->kind = $kind;
    }

    public function getMime(): string
    {
        return $this->mime;
    }

    public function setMime(string $mime): void
    {
        $this->mime = $mime;
    }
}
