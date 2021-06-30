<?php

namespace App\Todo\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class MediaTodo extends Todo
{
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    private ?int $duration = null;

    /**
     * @ORM\Column(type="string", nullable = true)
     */
    private ?string $pause = null;

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): MediaTodo
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPause(): ?string
    {
        return $this->pause;
    }

    public function setPause(?string $pause): MediaTodo
    {
        $this->pause = $pause;

        return $this;
    }

}
