<?php

namespace App\Domain\Contracts\Entity;

interface LearningMaterialProgressInterface
{
    public const EMPTY_PROGRESS = 0.0;

    public function getProgress(): ?float;
}
