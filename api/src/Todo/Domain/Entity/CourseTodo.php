<?php

namespace App\Todo\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CourseTodo extends Todo
{
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    private ?int $steps = null;

    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    private ?int $step = null;

    public function getSteps(): ?int
    {
        return $this->steps;
    }

    public function setSteps(?int $steps): CourseTodo
    {
        $this->steps = $steps;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(?int $step): CourseTodo
    {
        $this->step = $step;

        return $this;
    }
}
